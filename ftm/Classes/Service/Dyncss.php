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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Dyncss Service
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 2.0.0
 */
class Dyncss {

    /**
     * Collected messages
     * @var string
     */
    protected $messages = array();

    /**
     * Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     * @inject
     */
    protected $templateRepository;

    /**
     * Dyncss File Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateDyncssFileRepository
     * @inject
     */
    protected $templateDyncssFileRepository;

    /**
     * Object-Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Persistence-manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    public function __construct() {

        // Create Objects in case of Hook executing
        if(!($this->objectManager instanceof \TYPO3\CMS\Extbase\Object\ObjectManager)) {
            $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        }
        if(!($this->templateDyncssFileRepository instanceof \CodingMs\Ftm\Domain\Repository\TemplateDyncssFileRepository)) {
            $this->templateDyncssFileRepository = $this->objectManager->get('CodingMs\\Ftm\\Domain\\Repository\\TemplateDyncssFileRepository');
        }
        if(!($this->persistenceManager instanceof \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager)) {
            $this->persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        }
        if(!($this->templateRepository instanceof \CodingMs\Ftm\Domain\Repository\TemplateRepository)) {
            $this->templateRepository = $this->objectManager->get('CodingMs\\Ftm\\Domain\\Repository\\TemplateRepository');
        }

    }

    /**
     * Auto-creates datasets for each Dyncss library file
     * @param Template $template
     */
    public function autoCreateDatasets(\CodingMs\Ftm\Domain\Model\Template $template) {
        $this->autoCreateDatasetsByType($template, 'DyncssLibrary', 'Library');
        $this->autoCreateDatasetsByType($template, 'DyncssContentLayouts', 'ContentLayouts');
        $this->autoCreateDatasetsByType($template, 'DyncssGridElementLayouts', 'GridElementLayouts');
    }

    protected function autoCreateDatasetsByType(\CodingMs\Ftm\Domain\Model\Template $template, $directory, $type) {

        // Zuerst pruefen ob es das Template-Verzeichnis gibt
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory($directory, $template->getTemplateDir());
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

        if(file_exists($absPath)) {
            $files = GeneralUtility::getFilesInDir($absPath);
            if(!empty($files)) {
                foreach($files as $filename) {
                    $dyncss = file_get_contents($absPath.$filename);
                    $this->createDataset($template, $filename, $type, $dyncss);
                }
            }
        }
        else {
            throw new \Exception($directory.' directory not found!');
        }

    }

    public function createDataset(\CodingMs\Ftm\Domain\Model\Template $template, $filename='', $type='', $dyncss='', $variables='') {
        if(!$template->getDyncssFileExists($filename, $type)) {
            $dynCssFile = new \CodingMs\Ftm\Domain\Model\TemplateDyncssFile();
            $dynCssFile->setPid($template->getPid());
            $dynCssFile->setName($type.':'.$filename);
            $dynCssFile->setType($type);
            $dynCssFile->setFilename($filename);
            $dynCssFile->setDyncss($dyncss);
            $this->templateDyncssFileRepository->add($dynCssFile);

            // Add new dyncss file to template
            $template->addDyncssFile($dynCssFile);
            $this->templateRepository->update($template);
            $this->persistenceManager->persistAll();

            // Collect message
            $this->messages['success'][] = $type.':'.$filename.' created';
        }
    }

    /**
     * Returns the collected Messages
     * @param string $type
     * @return array
     */
    public function getMessages($type='success') {
        if(isset($this->messages[$type])) {
            return $this->messages[$type];
        }
        return array();
    }

    /**
     * Deletes a dyncss file dataset
     * @param \CodingMs\Ftm\Domain\Model\TemplateDyncssFile $templateDyncssFile
     */
    public function deleteDataset(\CodingMs\Ftm\Domain\Model\TemplateDyncssFile $dynCssFile) {
        $this->templateDyncssFileRepository->remove($dynCssFile);
        $this->persistenceManager->persistAll();
    }

    /**
     * Deletes a dyncss file dataset
     * @param \CodingMs\Ftm\Domain\Model\TemplateDyncssFile $dyncssFile
     */
    public function deleteFile(\CodingMs\Ftm\Domain\Model\TemplateDyncssFile $dyncssFile) {

        $templateService = new \CodingMs\Ftm\Service\Template();
        $template = $templateService->getTemplate($dyncssFile->getPid());

        if($template!==NULL) {
            // Zuerst pruefen ob es das Template-Verzeichnis gibt
            $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory('Dyncss'.$dyncssFile->getType(), $template->getTemplateDir());
            $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

            if(file_exists($absPath.$dyncssFile->getFilename())) {
                return unlink($absPath.$dyncssFile->getFilename());
            }

        }
        else {
            throw new \Exception('Coundn\'t find template of Dyncss file on rootline '.$dyncssFile->getPid());
        }
        return FALSE;
    }

    /**
     * @param $uid
     * @return object
     */
    public function getDatasetByUid($uid) {
        return $this->templateDyncssFileRepository->findByIdentifier($uid);
    }

    /**
     * Generates the dyncss import file
     * @param \CodingMs\Ftm\Domain\Model\Template $template
     * @throws \Exception
     */
    public function generateImportFile(\CodingMs\Ftm\Domain\Model\Template $template) {

        $fileContent = '';

        // Dyncss variables
        $directory = 'DyncssVariables';
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory($directory, $template->getTemplateDir());
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if(file_exists($absPath)) {
            $files = GeneralUtility::getFilesInDir($absPath);
            if(!empty($files)) {
                foreach($files as $filename) {
                    $variables = file_get_contents($absPath.$filename);
                    $fileContent.= "// ".$absPath.$filename."\n";
                    $fileContent.= $variables."\n";
                }
            }
        }
        else {
            throw new \Exception($directory.' directory not found!');
        }


        // Save import file
        $directory = 'Dyncss';
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory($directory, $template->getTemplateDir());
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        return file_put_contents($absPath.'import.less_preview', $fileContent);
    }

}

?>