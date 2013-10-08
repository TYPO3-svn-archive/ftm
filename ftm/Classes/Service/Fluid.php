<?php
namespace CodingMs\Ftm\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Fluid Funktionen
 * Sorgt z.B. dafuer, das die Template-Dateien, die nur
 * als Datei existieren als Datensatz erstellt werden
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class Fluid {

    /**
     * Object-Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     */
    protected $templateRepository;

    /**
     * Backend-Layout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\BackendLayoutRepository
     */
    protected $backendLayoutRepository;

    /**
     * Pages Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\PagesRepository
     */
    protected $pagesRepository;

    /**
     * Persistence-manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * injectTemplateRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\TemplateRepository $templateRepository
     * @return void
     */
    public function injectTemplateRepository(\CodingMs\Ftm\Domain\Repository\TemplateRepository $templateRepository) {
        $this->templateRepository = $templateRepository;
    }

    /**
     * injectBackendLayoutRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\BackendLayoutRepository $backendLayoutRepository
     * @return void
     */
    public function injectBackendLayoutRepository(\CodingMs\Ftm\Domain\Repository\BackendLayoutRepository $backendLayoutRepository) {
        $this->backendLayoutRepository = $backendLayoutRepository;
    }

    /**
     * injectPagesRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\PagesRepository $pagesRepository
     * @return void
     */
    public function injectPagesRepository(\CodingMs\Ftm\Domain\Repository\PagesRepository $pagesRepository) {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * injectPersistenceManager
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager
     * @return void
     */
    public function injectPersistenceManager(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager) {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * injectObjectManager
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager
     * @return void
     */
    public function injectObjectManager(\TYPO3\CMS\Extbase\Object\ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }
         
    /**
     * Prueft die Templates eines Types
     * 
     * @author Thomas Deuling <typo3@coding.ms>
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  string $fluidType partial/layout/template
     * @return mixed true wenn alle Dateien vorhanden sind, ansonsten ein Array mit den vermissten Dateien
     * @since  1.0.0
     */
    public function checkFiles(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, $fluidType='template') {
        
        $success = true;
        $missingFiles = array();
        
        
        // Zuerst pruefen ob es das Template-Verzeichnis gibt
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $fluidTemplate->getTemplateDir()).ucfirst($fluidType)."s/";
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        //die("test".$absPath); 
        if(is_dir($absPath)) {
            
            
            // Erst alle Dateien holen
            $filesLocal = array();
            if($handle=opendir($absPath)) {
                while($file=readdir($handle)){
                    if(substr($file , 0, 1) != ".") {
                        $filesLocal[] = $file;
                    }
                }
            }
            
            
            // Dann alle bekannten herausloeschen
            $filesDb = array();
            $fluidFiles = $fluidTemplate->getFluid();
            if(!empty($fluidFiles)) {
                foreach($fluidFiles as $fluidFile) {
                    if($fluidFile->getTemplateType()==$fluidType) {
                        $filesDb[] = $fluidFile->getTemplateFile().'.html';
                    }
                }
            }
            
            
            // Ermittelten Werte vergleichen
            $missingFiles = array_diff($filesLocal, $filesDb);
            
        }
        else {
            $success = false;
            throw new \Exception("Template dir '".$absPath."' not found", 1);
        }
        
        
        // Antwort generieren
        if(empty($missingFiles)) {
            return true;
        }
        else {
            return $missingFiles;
        }
    }
    
    public function createFiles(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, $fluidType='template', array $fluidFiles=array()) {
        
        $messages = "";
        
        // Wenn Dateien uebergeben wurden
        if(!empty($fluidFiles)) {
            foreach($fluidFiles as $fluidFile) {
                
                $tempCode = "";
                
                // Zuerst pruefen ob es das Template-Verzeichnis gibt
                $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $fluidTemplate->getTemplateDir()).ucfirst($fluidType)."s/";
                $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
                if(is_dir($absPath)) {
                    if(file_exists($absPath.$fluidFile)) {
                     
                        // Lese den Code aus
                        $tempCode = file_get_contents($absPath.$fluidFile);
                    }
                    else {
                        throw new \Exception("Template file '".$fluidFile."' not found", 1);
                    }
                }
                else {
                    throw new \Exception("Template dir '".$absPath."' not found", 1);
                }
                        
                
                
                /**
                 * @var \CodingMs\Ftm\Domain\Model\TemplateFluid
                 */
                $tempFluid = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateFluid');
                $tempName = str_replace('.html', '', $fluidFile);
                $tempFluid->setTemplateFile($tempName);
                $tempFluid->setTemplateType($fluidType);
                $tempFluid->setTemplateCode($tempCode);
                $tempFluid->setTemplateTitle($tempName." - ".$fluidType);
                $tempFluid->setPid($fluidTemplate->getPid());
                
                // Versuche BackendLayout zuzuweisen
                // ---------------------------------
                $backendLayouts = \CodingMs\Ftm\Service\TemplateStructure::$backendLayouts;
                
                // Erforderlichen Seiten ermitteln
                $globalStoragePage = $this->pagesRepository->findOneByTitleAndPid("GlobalStorage",  0);
                $backendLayoutPage = $this->pagesRepository->findOneByTitleAndPid("BackendLayouts", $globalStoragePage->getUid());
                
                if(!empty($backendLayouts)) {
                    foreach($backendLayouts as $title => $backendLayout) {
                        if($backendLayout['template'] == $fluidFile) {
                            
                            $backendLayoutObject = $this->backendLayoutRepository->findOneByTitleAndPid($title,  $backendLayoutPage->getUid());
                            if($backendLayoutObject instanceof \CodingMs\Ftm\Domain\Model\BackendLayout) {
                                $tempFluid->setBackendLayout($backendLayoutObject->getUid());
                            }

                        }
                    }
                }
                
                // Dann hinzufuegen
                $fluidTemplate->addFluid($tempFluid);
                // ---------------------------------
                
                
                $messages.= $fluidFile." Fluid ".ucfirst($fluidType)." erstellt<br />\n";
                
            }
         
         
            // Aenderungen speichern
            $this->templateRepository->update($fluidTemplate);
                      
            // und persistieren
            $this->persistenceManager->persistAll();
        }
        
        return $messages;
    }
   
    
}

?>