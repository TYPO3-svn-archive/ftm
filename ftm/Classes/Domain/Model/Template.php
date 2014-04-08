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
class Template extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * Website-Name
     *
     * @var string
     * @validate NotEmpty
     * @since 1.1.0
     */
    protected $siteName = '';

    /**
     * Directory where the Templates-Files are located
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $templateDir = '';

    /**
     * Development/Productive Mode
     *
     * @var string
     * @validate NotEmpty
     * @since 1.1.0
     */
    protected $templateMode = 'development';

    /**
     * Directory where the Templates-Files are located
     *
     * @var string
     * @validate NotEmpty
     * @since 1.1.0
     */
    protected $templateType = '';

    /**
     * MD5-Hash of the setup.ts
     *
     * @var string
     * @since 1.0.0
     */
    protected $md5HashSetupTs;

    /**
     * MD5-Hash of the constants.ts
     *
     * @var string
     * @since 1.0.0
     */
    protected $md5HashConstantsTs;

    /**
     * MD5-Hash of the tsConfig.ts
     *
     * @var string
     * @since 1.0.4
     */
    protected $md5HashTsConfig;

    /**
     * MD5-Hash of the Template-Data
     *
     * @var string
     * @since 1.0.0
     */
    protected $md5HashTemplateData;

    /**
     * Warnungen gelesen!?
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $disclaimerAccepted;

    /**
     * config
     *
     * @var \CodingMs\Ftm\Domain\Model\TemplateConfig
     * @since 1.0.0
     */
    protected $config;

    /**
     * meta
     *
     * @var \CodingMs\Ftm\Domain\Model\TemplateMeta
     * @since 1.0.0
     */
    protected $meta;

    /**
     * Website-Sprachen
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateLanguage>
     * @since 1.0.0
     */
    protected $language;

    /**
     * Fluid-Templates
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateFluid>
     * @lazy
     * @since 1.0.0
     */
    protected $fluid;

    /**
     * DynCss-Files
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateDynCssFile>
     * @since 1.0.0
     */
    protected $dynCssFile;

    /**
     * Menu-Container
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateMenuContainer>
     * @since 1.0.0
     */
    protected $menuContainer;

    /**
     * TypoScriptSnippet
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet>
     * @since 1.0.0
     */
    protected $typoScriptSnippet;

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
        $this->language      = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->fluid         = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->dynCssFile    = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->menuContainer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->typoScriptSnippet = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the siteName
     *
     * @return string $siteName
     * @since 1.1.0
     */
    public function getSiteName() {
        return $this->siteName;
    }

    /**
     * Sets the siteName
     *
     * @param string $siteName
     * @return void
     * @since 1.1.0
     */
    public function setSiteName($siteName) {
        $this->siteName = $siteName;
    }

    /**
     * Returns the templateDir
     *
     * @return string $templateDir
     * @since 1.0.0
     */
    public function getTemplateDir() {
        return $this->templateDir;
    }

    /**
     * Sets the templateDir
     *
     * @param string $templateDir
     * @return void
     * @since 1.0.0
     */
    public function setTemplateDir($templateDir) {
        $this->templateDir = $templateDir;
    }

    /**
     * Returns the templateMode
     *
     * @return string $templateMode
     * @since 1.1.0
     */
    public function getTemplateMode() {
        return $this->templateMode;
    }

    /**
     * Sets the templateMode
     *
     * @param string $templateMode
     * @return void
     * @since 1.1.0
     */
    public function setTemplateMode($templateMode) {
        $this->templateMode = $templateMode;
    }

    /**
     * Returns the templateType
     *
     * @return string $templateType
     * @since 1.1.0
     */
    public function getTemplateType() {
        return $this->templateType;
    }

    /**
     * Sets the templateType
     *
     * @param string $templateType
     * @return void
     * @since 1.1.0
     */
    public function setTemplateType($templateType) {
        $this->templateType = $templateType;
    }

    /**
     * Returns the md5HashSetupTs
     *
     * @return string $md5HashSetupTs
     * @since 1.0.0
     */
    public function getMd5HashSetupTs() {
        return $this->md5HashSetupTs;
    }

    /**
     * Sets the md5HashSetupTs
     *
     * @param string $md5HashSetupTs
     * @return void
     * @since 1.0.0
     */
    public function setMd5HashSetupTs($md5HashSetupTs) {
        $this->md5HashSetupTs = $md5HashSetupTs;
    }

    /**
     * Returns the md5HashConstantsTs
     *
     * @return string $md5HashConstantsTs
     * @since 1.0.0
     */
    public function getMd5HashConstantsTs() {
        return $this->md5HashConstantsTs;
    }

    /**
     * Sets the md5HashConstantsTs
     *
     * @param string $md5HashConstantsTs
     * @return void
     * @since 1.0.0
     */
    public function setMd5HashConstantsTs($md5HashConstantsTs) {
        $this->md5HashConstantsTs = $md5HashConstantsTs;
    }

    /**
     * Returns the md5HashTsConfig
     *
     * @return string $md5HashTsConfig
     * @since 1.0.4
     */
    public function getMd5HashTsConfig() {
        return $this->md5HashTsConfig;
    }

    /**
     * Sets the md5HashTsConfig
     *
     * @param string $md5HashTsConfig
     * @return void
     * @since 1.0.4
     */
    public function setMd5HashTsConfig($md5HashTsConfig) {
        $this->md5HashTsConfig = $md5HashTsConfig;
    }

    /**
     * Returns the md5HashTemplateData
     *
     * @return string $md5HashTemplateData
     * @since 1.0.0
     */
    public function getMd5HashTemplateData() {
        return $this->md5HashTemplateData;
    }

    /**
     * Sets the md5HashTemplateData
     *
     * @param string $md5HashTemplateData
     * @return void
     * @since 1.0.0
     */
    public function setMd5HashTemplateData($md5HashTemplateData) {
        $this->md5HashTemplateData = $md5HashTemplateData;
    }

    /**
     * Returns the disclaimerAccepted
     *
     * @return boolean $disclaimerAccepted
     * @since 1.0.0
     */
    public function getDisclaimerAccepted() {
        return $this->disclaimerAccepted;
    }

    /**
     * Sets the disclaimerAccepted
     *
     * @param boolean $disclaimerAccepted
     * @return void
     * @since 1.0.0
     */
    public function setDisclaimerAccepted($disclaimerAccepted) {
        $this->disclaimerAccepted = $disclaimerAccepted;
    }

    /**
     * Returns the boolean state of clear
     *
     * @return boolean
     * @since 1.0.0
     */
    public function isDisclaimerAccepted() {
        return $this->getDisclaimerAccepted();
    }

    /**
     * Returns the config
     *
     * @return \CodingMs\Ftm\Domain\Model\TemplateConfig $config
     * @since 1.0.0
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Sets the config
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateConfig $config
     * @return void
     * @since 1.0.0
     */
    public function setConfig(\CodingMs\Ftm\Domain\Model\TemplateConfig $config) {
        $this->config = $config;
    }

    /**
     * Returns the meta
     *
     * @return \CodingMs\Ftm\Domain\Model\TemplateMeta $meta
     * @since 1.0.0
     */
    public function getMeta() {
        return $this->meta;
    }

    /**
     * Sets the meta
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateMeta $meta
     * @return void
     * @since 1.0.0
     */
    public function setMeta(\CodingMs\Ftm\Domain\Model\TemplateMeta $meta) {
        $this->meta = $meta;
    }

    /**
     * Adds a TemplateDynCssFile
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateDynCssFile $dynCssFile
     * @return void
     * @since 2.0.0
     */
    public function addDynCssFile(\CodingMs\Ftm\Domain\Model\TemplateDynCssFile $dynCssFile) {
        $this->dynCssFile->attach($dynCssFile);
    }

    /**
     * Removes a TemplateDynCssFile
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateDynCssFile $dynCssFileToRemove The TemplateDynCssFile to be removed
     * @return void
     * @since 2.0.0
     */
    public function removeDynCssFile(\CodingMs\Ftm\Domain\Model\TemplateDynCssFile $dynCssFileToRemove) {
        $this->dynCssFile->detach($dynCssFileToRemove);
    }

    /**
     * Returns the dynCssFile
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateDynCssFile> $dynCssFile
     * @since 2.0.0
     */
    public function getDynCssFile() {
        return $this->dynCssFile;
    }

    /**
     * Sets the dynCssFile
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateDynCssFile> $dynCssFile
     * @return void
     * @since 2.0.0
     */
    public function setDynCssFile(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dynCssFile) {
        $this->dynCssFile = $dynCssFile;
    }

    /**
     * Adds a TemplateLanguage
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateLanguage $language
     * @return void
     * @since 1.0.0
     */
    public function addLanguage(\CodingMs\Ftm\Domain\Model\TemplateLanguage $language) {
        $this->language->attach($language);
    }

    /**
     * Removes a TemplateLanguage
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateLanguage $languageToRemove The TemplateLanguage to be removed
     * @return void
     * @since 1.0.0
     */
    public function removeLanguage(\CodingMs\Ftm\Domain\Model\TemplateLanguage $languageToRemove) {
        $this->language->detach($languageToRemove);
    }

    /**
     * Returns the language
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateLanguage> $language
     * @since 1.0.0
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateLanguage> $language
     * @return void
     * @since 1.0.0
     */
    public function setLanguage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $language) {
        $this->language = $language;
    
    }

    /**
     * Adds a TemplateFluid
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateFluid $fluid
     * @return void
     * @since 1.0.0
     */
    public function addFluid(\CodingMs\Ftm\Domain\Model\TemplateFluid $fluid) {
        $this->fluid->attach($fluid);
    }

    /**
     * Removes a TemplateFluid
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateFluid $fluidToRemove The TemplateFluid to be removed
     * @return void
     * @since 1.0.0
     */
    public function removeFluid(\CodingMs\Ftm\Domain\Model\TemplateFluid $fluidToRemove) {
        $this->fluid->detach($fluidToRemove);
    }

    /**
     * Returns the fluid
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateFluid> $fluid
     * @since 1.0.0
     */
    public function getFluid() {
        return $this->fluid;
    }

    /**
     * Sets the fluid
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateFluid> $fluid
     * @return void
     * @since 1.0.0
     */
    public function setFluid(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $fluid) {
        $this->fluid = $fluid;
    }

    /**
     * Adds a TemplateMenuContainer
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateMenuContainer $menuContainer
     * @return void
     * @since 1.0.0
     */
    public function addMenuContainer(\CodingMs\Ftm\Domain\Model\TemplateMenuContainer $menuContainer) {
        $this->menuContainer->attach($menuContainer);
    }

    /**
     * Removes a TemplateMenuContainer
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateMenuContainer $menuContainerToRemove The TemplateMenuContainer to be removed
     * @return void
     * @since 1.0.0
     */
    public function removeMenuContainer(\CodingMs\Ftm\Domain\Model\TemplateMenuContainer $menuContainerToRemove) {
        $this->menuContainer->detach($menuContainerToRemove);
    }

    /**
     * Returns the menuContainer
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateMenuContainer> $menuContainer
     * @since 1.0.0
     */
    public function getMenuContainer() {
        return $this->menuContainer;
    }

    /**
     * Sets the menuContainer
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateMenuContainer> $menuContainer
     * @return void
     * @since 1.0.0
     */
    public function setMenuContainer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $menuContainer) {
        $this->menuContainer = $menuContainer;
    }

    /**
     * Adds a TemplateTypoScriptSnippet
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $typoScriptSnippet
     * @return void
     * @since 1.0.0
     */
    public function addTypoScriptSnippet(\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $typoScriptSnippet) {
        $this->typoScriptSnippet->attach($typoScriptSnippet);
    }

    /**
     * Removes a TemplateTypoScriptSnippet
     *
     * @param \CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $typoScriptSnippetToRemove The TemplateTypoScriptSnippet to be removed
     * @return void
     * @since 1.0.0
     */
    public function removeTypoScriptSnippet(\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $typoScriptSnippetToRemove) {
        $this->typoScriptSnippet->detach($typoScriptSnippetToRemove);
    }

    /**
     * Returns the typoScriptSnippet
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet> $typoScriptSnippet
     * @since 1.0.0
     */
    public function getTypoScriptSnippet() {
        
        if($this->typoScriptSnippet->count()>0) {
            // Erst schnell die Uids sammeln
            $uidArray = array();
            foreach($this->typoScriptSnippet as $snippet) {
                $uidArray[] = $snippet->getUid();
            }
            
            $itemCount = 0;
            foreach($this->typoScriptSnippet as $snippet) {
                
                if($itemCount==0) {
                    $snippet->setPreviousListUid(0);
                }
                else {
                    $snippet->setPreviousListUid($uidArray[$itemCount-1]);
                }
                
                if($itemCount<count($uidArray)) {
                    $snippet->setNextListUid($uidArray[$itemCount+1]);
                }
                else {
                    $snippet->setNextListUid(0);
                }
                
                $itemCount++;
            }
        }
        
        return $this->typoScriptSnippet;
    }

    /**
     * Sets the typoScriptSnippet
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet> $typoScriptSnippet
     * @return void
     * @since 1.0.0
     */
    public function setTypoScriptSnippet(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $typoScriptSnippet) {
        $this->typoScriptSnippet = $typoScriptSnippet;
    }

    /**
     * Returns the Less-ContentLayouts
     *
     * @return array $contentLayouts
     * @since 1.0.0
     */
    public function getContentLayouts() {
        $templateDir = \CodingMs\Ftm\Utility\Tools::getDirectory("DynCssContentLayouts", $this->getTemplateDir());
        $directory   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($templateDir);
        $contentLayouts = array();
        if($handleLess=opendir($directory)) {
            while($fileLess=readdir($handleLess)){
                if(substr($fileLess , 0, 1) != ".") {
                    $contentLayouts[] = str_replace(".less", "", $fileLess);
                }
            }
        }
        return $contentLayouts;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        // Achtung: 
        // PluginService mag nur ein-dimensionale Arrays!
        
        $data = array();
        $data['siteName']     = $this->getSiteName();
        $data['templateDir']  = $this->getTemplateDir();
        $data['templateMode'] = $this->getTemplateMode();
        $data['templateType'] = $this->getTemplateType();
        $data['baseUrl']      = $this->config->getBaseURL();
        $data['ftmVersion']   = FTM_VERSION;
        
        // Meta und Config ohne Schleife
        // weil diese immer nur einmal existieren
        $data['config']         = serialize($this->config->toArray());
        $data['meta']           = serialize($this->meta->toArray());
        $data['contentLayouts'] = serialize($this->getContentLayouts());

        // Language
        // ------------------------------
        $tempLanguageArray = array();
        $defaultLanguage   = array();
        $defaultLanguage['languageUid'] = $this->config->getLanguageUid();
        $defaultLanguage['title']       = $this->config->getLanguageTitle();
        $defaultLanguage['language']    = $this->config->getLanguage();
        $defaultLanguage['localeAll']   = $this->config->getLocaleAll();
        $tempLanguageArray[0] = $defaultLanguage;
        if(!empty($this->language)) {
            foreach($this->language as $tempLanguage) {
                $tempLanguageArray[$tempLanguage->getLanguageUid()] = $tempLanguage->toArray();
            }
        }
        $data['language'] = serialize($tempLanguageArray);

        // DynCss
        // ------------------------------
        $tempDynCssArray = array();
        if(!empty($this->dynCssFile)) {
            foreach($this->dynCssFile as $tempDynCssFile) {
                $tempDynCssArray[] = $tempDynCssFile->toArray();
            }
        }
        $data['dynCssFiles'] = serialize($tempDynCssArray);

        // Fluid-Template-Daten
        // ------------------------------
        $tempFluidArray = array();
        if(!empty($this->fluid)) {
            foreach($this->fluid as $tempFluid) {
                $tempFluidArray[$tempFluid->getTemplateType()][] = $tempFluid->toArray();
            }
        }
        $data['fluid'] = serialize($tempFluidArray);

        // TypoScriptSnippet-Daten
        // ------------------------------
        $tempTypoScriptSnippetArray = array();
        if(!empty($this->typoScriptSnippet)) {
            foreach($this->typoScriptSnippet as $tempTypoScriptSnippet) {
                $tempTypoScriptSnippetArray[$tempTypoScriptSnippet->getName()] = $tempTypoScriptSnippet->toArray();
            }
        }
        $data['typoScriptSnippets'] = serialize($tempTypoScriptSnippetArray);

        // Menu-Daten
        // ------------------------------
        $tempMenuArray = array();
        if(!empty($this->menuContainer)) {
            foreach($this->menuContainer as $tempMenu) {
                $tempMenuArray[$tempMenu->getMenuName()] = $tempMenu->toArray();
            }
        }
        $data['menu'] = serialize($tempMenuArray);
        
        return $data;
    }

}
?>