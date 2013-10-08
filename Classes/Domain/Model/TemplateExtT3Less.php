<?php
namespace CodingMs\Ftm\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Thomas Deuling <typo3@coding.ms>, coding.ms
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @package ftm
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TemplateExtT3Less extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * pathToLessFiles
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $pathToLessFiles;

    /**
     * outputFolder
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $outputFolder;

    /**
     * lessFiles
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles>
     * @since 1.0.0
     */
    protected $lessFiles;

    /**
     * __construct
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct() {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     *
     * @return void
     * @since 1.0.0
     */
    protected function initStorageObjects() {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->lessFiles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the pathToLessFiles
     *
     * @return string $pathToLessFiles
     * @since 1.0.0
     */
    public function getPathToLessFiles() {
        return $this->pathToLessFiles;
    }

    /**
     * Sets the pathToLessFiles
     *
     * @param string $pathToLessFiles
     * @return void
     * @since 1.0.0
     */
    public function setPathToLessFiles($pathToLessFiles) {
        $this->pathToLessFiles = $pathToLessFiles;
    }

    /**
     * Returns the outputFolder
     *
     * @return string $outputFolder
     * @since 1.0.0
     */
    public function getOutputFolder() {
        return $this->outputFolder;
    }

    /**
     * Sets the outputFolder
     *
     * @param string $outputFolder
     * @return void
     * @since 1.0.0
     */
    public function setOutputFolder($outputFolder) {
        $this->outputFolder = $outputFolder;
    }

    /**
     * Adds a TemplateExtT3LessFiles
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles $lessFile
     * @return void
     * @since 1.0.0
     */
    public function addLessFile(\CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles $lessFile) {
        $this->lessFiles->attach($lessFile);
    }

    /**
     * Removes a TemplateExtT3LessFiles
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles $lessFileToRemove The TemplateExtT3LessFiles to be removed
     * @return void
     * @since 1.0.0
     */
    public function removeLessFile(\CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles $lessFileToRemove) {
        $this->lessFiles->detach($lessFileToRemove);
    }

    /**
     * Returns the lessFiles
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles> $lessFiles
     * @since 1.0.0
     */
    public function getLessFiles() {
        return $this->lessFiles;
    }

    /**
     * Sets the lessFiles
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles> $lessFiles
     * @return void
     * @since 1.0.0
     */
    public function setLessFiles(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $lessFiles) {
        $this->lessFiles = $lessFiles;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['pathToLessFiles'] = $this->getPathToLessFiles();
        $data['outputFolder']    = $this->getOutputFolder();
        
        // Less-Dateien
        $lessFilesArray = array();
        $lessFiles = $this->getLessFiles();
        if($lessFiles->count()>0) {
            foreach($lessFiles as $lessFile) {
                $lessFilesArray[$lessFile->getSorting()] = $lessFile->toArray();
            }
        }
        $data['lessFiles'] = $lessFilesArray;
                       
        return $data;
    }

}
?>