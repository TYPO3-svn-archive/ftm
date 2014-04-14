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

use \CodingMs\Ftm\Utility\Tools;

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
class Template {

    /**
     * Object-Manager
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Template Repository
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     * @inject
     */
    protected $templateRepository;

    /**
     * Prepare the service
     */
    public function __construct() {

        // Create Objects in case of Hook executing
        if(!($this->objectManager instanceof \TYPO3\CMS\Extbase\Object\ObjectManager)) {
            $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        }
        if(!($this->templateRepository instanceof \CodingMs\Ftm\Domain\Repository\TemplateRepository)) {
            $this->templateRepository = $this->objectManager->get('CodingMs\\Ftm\\Domain\\Repository\\TemplateRepository');
        }
    }

    /**
     * @param $pid
     * @return NULL|\CodingMs\Ftm\Domain\Model\Template
     */
    public function getTemplate($pid) {

        // Ansonsten rekursive die Rootline durchsuchen
        $rootlinePids = Tools::getRootlinePids($pid);
        for($i=0 ; $i<count($rootlinePids) ; $i++) {
            /**
             * @var \CodingMs\Ftm\Domain\Model\Template
             */
            $template = $this->templateRepository->findOneByPid($rootlinePids[$i]);
            if($template instanceof \CodingMs\Ftm\Domain\Model\Template) {
                return $template;
            }
        }
        return NULL;
    }

}

?>