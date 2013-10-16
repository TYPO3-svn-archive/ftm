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
 * Managed alle Aktionen rund um YAML-Datensaetze
 *
 * @package ftm
 * @subpackage Service
 * @extended   Dieter Brüning <typo3@media-bruening.de>
 */
class TemplateStructureYaml extends TemplateStructure {

    protected $fluidLayouts = array(
        'default'   => 'default.html',
        'empty'     => 'empty.html',
        'startsite' => 'startsite.html',
    );
    
    protected $fluidTemplates = array(
        'c'     => 'c.html',
        'cm'    => 'cm.html',
        'cms'   => 'cms.html',
        'cs'    => 'cs.html',
        'csm'   => 'csm.html',
        'empty' => 'empty.html',
        'mc'    => 'mc.html',
        'mcs'   => 'mcs.html',
        'msc'   => 'msc.html',
        'sc'    => 'sc.html',
        'scm'   => 'scm.html',
        'smc'   => 'smc.html',
        'special'   => 'special.html',
        'startsite' => 'startsite.html',
    );
    
    protected $fluidPartials = array(
        'mainContent' => 'mainContent.html',
        'menuContent' => 'menuContent.html',
        'quickSearch' => 'quickSearch.html',
        'sideContent' => 'sideContent.html',
    );
    
    protected $lessFiles = array(
        'import.less'      => 'import.less',
        
        'Areas/top.less'      => 'Areas/top.less',
        'Areas/header.less'   => 'Areas/header.less',
        'Areas/teaser.less'   => 'Areas/teaser.less',
        'Areas/nav.less'      => 'Areas/nav.less',
        'Areas/main.less'     => 'Areas/main.less',
        'Areas/extended.less' => 'Areas/extended.less',
        'Areas/footer.less'   => 'Areas/footer.less',
        
        'Layouts/default.less'   => 'Layouts/default.less',
        'Layouts/empty.less'     => 'Layouts/empty.less',
        'Layouts/startsite.less' => 'Layouts/startsite.less',
        
        'Templates/c.less'         => 'Templates/c.less',
        'Templates/cm.less'        => 'Templates/cm.less',
        'Templates/cms.less'       => 'Templates/cms.less',
        'Templates/cs.less'        => 'Templates/cs.less',
        'Templates/csm.less'       => 'Templates/csm.less',
        'Templates/empty.less'     => 'Templates/empty.less',
        'Templates/mc.less'        => 'Templates/mc.less',
        'Templates/mcs.less'       => 'Templates/mcs.less',
        'Templates/msc.less'       => 'Templates/msc.less',
        'Templates/sc.less'        => 'Templates/sc.less',
        'Templates/scm.less'       => 'Templates/scm.less',
        'Templates/smc.less'       => 'Templates/smc.less',
        'Templates/special.less'   => 'Templates/special.less',
        'Templates/startsite.less' => 'Templates/startsite.less',
        
        'Partials/mainContent.less' => 'Partials/mainContent.less',
        'Partials/menuContent.less' => 'Partials/menuContent.less',
        'Partials/quickSearch.less' => 'Partials/quickSearch.less',
        'Partials/sideContent.less' => 'Partials/sideContent.less',
        
    );
    
    protected $lessVariables = array(
        array('Basis URL for Images // Grundlegende URL für Bilder',                   'baseUrlImage',                   '', 'string', ' ',                   ' ',                   '@{baseUrlTemplate}Resources/Public/Images/'),
        array('Theme Color',                                                           'themeColor',                     '', 'color',                         ' ',                   '#049cdb'),
    );


    /**
     * TemplateLessVariable Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateLessVariableRepository
     */
    protected $templateLessVariableRepository;

    /**
     * injectTemplateLessVariableRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\TemplateLessVariableRepository $fluidTemplateLessVariableRepository
     * @return void
     */
    public function injectTemplateLessVariableRepository(\CodingMs\Ftm\Domain\Repository\TemplateLessVariableRepository $templateLessVariableRepository) {
        $this->templateLessVariableRepository = $templateLessVariableRepository;
    }
    

    
    /**
     * Prueft alles was Richtung YAML abweicht
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @since      22.11.2013
     * @extended   Dieter Brüning <typo3@media-bruening.de>
     * 
     * @return mixed boolean wenn alles aktuell ist, ansonsten die Meldungens
     */
    public function checkStructure($pid, $fluidTemplate) {
        
        parent::checkStructure($pid, $fluidTemplate);
        
        
        // YAML-Layouts bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureYaml", $fluidTemplate->getTemplateDir())."Layouts/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates",        $fluidTemplate->getTemplateDir())."Layouts/";
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->fluidLayouts)) {
            foreach($this->fluidLayouts as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // YAML-Templates bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureYaml", $fluidTemplate->getTemplateDir())."Templates/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates",        $fluidTemplate->getTemplateDir())."Templates/";
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->fluidTemplates)) {
            foreach($this->fluidTemplates as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // YAML-Partials bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureYaml", $fluidTemplate->getTemplateDir())."Partials/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates",        $fluidTemplate->getTemplateDir())."Partials/";
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->fluidPartials)) {
            foreach($this->fluidPartials as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // Less-Dateien bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureYaml", $fluidTemplate->getTemplateDir())."Less/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("Less",                  $fluidTemplate->getTemplateDir());
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->lessFiles)) {
            foreach($this->lessFiles as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // Less-Variablen bereitstellen
        if(!empty($this->lessVariables)) {
            foreach($this->lessVariables as $variable) {
                
                
                $lessVariable = $this->templateLessVariableRepository->findOneByNameAndPid($variable[1], $pid);
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!($lessVariable instanceof \CodingMs\Ftm\Domain\Model\TemplateLessVariable)) {
                    
                    /**
                     * @var \CodingMs\Ftm\Domain\Model\TemplateLessVariable
                     */
                    $lessVariableObject = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateLessVariable');
                    $lessVariableObject->setPid($pid);
                    $lessVariableObject->setTemplate($fluidTemplate);
                    $lessVariableObject->setVariableTitle( $variable[0]);
                    $lessVariableObject->setVariableName(  $variable[1]);
                    $lessVariableObject->setCategory(      $variable[2]);
                    $lessVariableObject->setVariableType(  $variable[3]);
                    $lessVariableObject->setVariableValue( $variable[4]);
                    $lessVariableObject->setVariableColor( $variable[5]);
                    $lessVariableObject->setVariableString($variable[6]);
                    
                    // Variable speichern
                    $this->templateLessVariableRepository->add($lessVariableObject);
                              
                    // und persistieren
                    $this->persistenceManager->persistAll();
                    
                }
                else {
                    // echo $variable[2]." exists<br>";
                }
                
            }
        }
        
        
    }
    
}

?>
