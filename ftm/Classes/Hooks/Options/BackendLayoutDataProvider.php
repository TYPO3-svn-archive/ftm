<?php
namespace CodingMs\Ftm\Hooks\Options;

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


use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayout;
use \TYPO3\CMS\Backend\View\BackendLayout\DataProviderContext;
use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayoutCollection;
use \TYPO3\CMS\Backend\Utility\BackendUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Provides Backend-Layouts
 *
 * @package ftm
 * @subpackage Hooks
 *
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 2.0.0
 */
class BackendLayoutDataProvider implements \TYPO3\CMS\Backend\View\BackendLayout\DataProviderInterface {

    /**
     * Default Backend Layouts for Theme
     *
     * @var array
     */
    protected $backendLayouts = array();

    public function __construct() {

        // Extension-Konfiguration auslesen
        $extConf = \CodingMs\Ftm\Service\ExtensionConfiguration::getConfiguration();

        $default = 'MenuContentSidebar';
        if(isset($extConf['backendLayoutDefault'])) {
            $default = $extConf['backendLayoutDefault'];
        }

        $path = GeneralUtility::getFileAbsFileName('EXT:ftm/Resources/Private/BackendLayouts/');
        $filesOfDirectory = GeneralUtility::getFilesInDir($path, 'ts', TRUE, 1);
        foreach ($filesOfDirectory as $file) {

            $name = basename($file, ".ts");
            $key = GeneralUtility::camelCaseToLowerCaseUnderscored($name);

            if(isset($extConf['backendLayoutDisable'.$name]) && (int)$extConf['backendLayoutDisable'.$name]===0) {
                $tempArray = array();
                $tempArray['title'] = 'LLL:EXT:ftm/Resources/Private/Language/BackendLayouts.xlf:'.$key;
                $tempArray['config'] = file_get_contents($file);
                $tempArray['icon'] = 'EXT:ftm/Resources/Public/Icons/BackendLayouts/'.$name.'.jpg';
                $this->backendLayouts[$key] = $tempArray;
            }

            if($name==$default) {
                if(isset($extConf['backendLayoutDisableDefault']) && (int)$extConf['backendLayoutDisableDefault']===0) {
                    $key = 'default';
                    $tempArray = array();
                    $tempArray['title'] = 'LLL:EXT:ftm/Resources/Private/Language/BackendLayouts.xlf:'.$key;
                    $tempArray['config'] = file_get_contents($file);
                    $tempArray['icon'] = 'EXT:ftm/Resources/Public/Icons/BackendLayouts/Default.jpg';
                    $this->backendLayouts[$key] = $tempArray;
                }
            }
        }
    }

    /**
     * @param DataProviderContext $dataProviderContext
     * @param BackendLayoutCollection $backendLayoutCollection
     * @return void
     */
    public function addBackendLayouts(DataProviderContext $dataProviderContext, BackendLayoutCollection $backendLayoutCollection) {
        foreach ($this->backendLayouts as $key => $data) {
            $data['uid'] = $key;
            $backendLayout = $this->createBackendLayout($data);
            $backendLayoutCollection->add($backendLayout);
        }
    }

    /**
     * Gets a backend layout by (regular) identifier.
     *
     * @param string $identifier
     * @param integer $pageId
     * @return NULL|BackendLayout
     */
    public function getBackendLayout($identifier, $pageId){
        $backendLayout = NULL;
        if(array_key_exists($identifier,$this->backendLayouts)) {
            return $this->createBackendLayout($this->backendLayouts[$identifier]);
        }
        return $backendLayout;
    }

    /**
     * Creates a new backend layout using the given record data.
     *
     * @param array $data
     * @return BackendLayout
     */
    protected function createBackendLayout(array $data) {
        $backendLayout = BackendLayout::create($data['uid'], $data['title'], $data['config']);
        $backendLayout->setIconPath($this->getIconPath($data['icon']));
        $backendLayout->setData($data);
        return $backendLayout;
    }

    /**
     * Gets and sanitizes the icon path.
     *
     * @param string $icon Name of the icon file
     * @return string
     */
    protected function getIconPath($icon) {
        $iconPath = '';
        if (!empty($icon)) {
            $iconPath = $icon;
        }
        return $iconPath;
    }

}