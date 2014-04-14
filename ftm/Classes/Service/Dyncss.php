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
     * Persistence-manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * Auto-creates datasets for each Dyncss library file
     * @param Template $template
     */
    public function autoCreateDatasets(\CodingMs\Ftm\Domain\Model\Template $template) {

        // Zuerst pruefen ob es das Template-Verzeichnis gibt
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("DyncssLibraries", $template->getTemplateDir());
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

        if(file_exists($absPath)) {
            $files = GeneralUtility::getFilesInDir($absPath);
            if(!empty($files)) {
                foreach($files as $filename) {

                    $type = 'Library';
                    $dyncss = file_get_contents($absPath.$filename);

                    $this->createDataset($template, $filename, $type, $dyncss);

                }
            }

        }
        else {
            throw new \Exception('Dyncss library directory not found!');
        }

    }

    public function createDataset(\CodingMs\Ftm\Domain\Model\Template $template, $filename='', $type='', $dyncss='', $variables='') {
        if(!$template->getDyncssFileExists($filename, 'Library')) {
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

    public function getMessages($type='success') {
        return $this->messages['success'];
    }
    
}

?>