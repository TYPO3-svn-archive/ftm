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
     * Dyncss File Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateDyncssFileRepository
     * @inject
     */
    protected $templateDyncssFileRepository;

    /**
     * Auto-creates datasets for each Dyncss library file
     * @param Template $template
     */
    public static function autoCreateDatasets(\CodingMs\Ftm\Domain\Model\Template $template) {

        // Zuerst pruefen ob es das Template-Verzeichnis gibt
        $relPath = \CodingMs\Ftm\Utility\Tools::getDirectory("DynCssLibraries", $template->getTemplateDir());
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);

        if(file_exists($absPath)) {
            $files = GeneralUtility::getFilesInDir($absPath);
            if(!empty($files)) {
                foreach($files as $file) {
                    var_dump($file);
                }
            }

        }
        else {
            throw new \Exception('Dyncss library directory not found!');
        }

    }

    public static function dyncssDatasetExists($filename='', $type='') {

    }
    
}

?>