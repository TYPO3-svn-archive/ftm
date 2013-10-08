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
class TemplateConfig extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

    /**
     * Legt den DocType des HTML fest
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $doctype;
    
    /**
     * Legt die BaseURL fest
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $baseURL;
    
    /**
     * Legt die Link-Vars fest
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $linkVars;

    /**
     * Verhindert das der Charset-Header (content-type:text/html; charset...) gesendet wird.
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $disableCharsetHeader;

    /**
     * Gibt die Zeichenkodierung für die Ausgabe an. Dieser Wert wird in den Meta-Tag und im HTTP-Header (nur bei config.disableCharsetHeader = 0) verwendet.
     *
     * @var string
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $metaCharset;
    
    /**
     * sys_languag_uid
     *
     * @var integer
     * @validate NotEmpty
     * @since 1.0.0
     */
    protected $languageUid = 0;

    /**
     * Sprachen-Title
     *
     * @var string
     * @since 1.0.0
     */
    protected $languageTitle;

    /**
     * language
     *
     * @var string
     * @since 1.0.0
     */
    protected $language;

    /**
     * localeAll
     *
     * @var string
     * @since 1.0.0
     */
    protected $localeAll;

    /**
     * spamProtectEmailAddresses
     *
     * @var boolean
     * @since 1.0.0
     */
    protected $spamProtectEmailAddresses;

    /**
     * spamProtectEmailAddressesAtSubst
     *
     * @var string
     * @since 1.1.0
     */
    protected $spamProtectEmailAddressesAtSubst;

    /**
     * spamProtectEmailAddressesLastDotSubst
     *
     * @var string
     * @since 1.1.0
     */
    protected $spamProtectEmailAddressesLastDotSubst;

    /**
     * prefixLocalAnchors
     *
     * @var string
     * @since 1.0.1
     */
    protected $prefixLocalAnchors;

    /**
     * speakingPaths
     *
     * @var string
     * @since 1.0.1
     */
    protected $speakingPaths;
    
    /**
     * Use html5.js
     * 
     * @var boolean 
     * @since 1.0.3
     */
    protected $useHtml5Js;
    
    /**
     * Google-Analytics Tracking-Code
     * 
     * @var string 
     * @since 1.0.4
     */
    protected $googleAnalyticsTrackingCode;

    /**
     * Returns the doctype
     *
     * @return string $doctype
     * @since 1.0.0
     */
    public function getDoctype() {
        return $this->doctype;
    }

    /**
     * Sets the doctype
     *
     * @param string $doctype
     * @return void
     * @since 1.0.0
     */
    public function setDoctype($doctype) {
        $this->doctype = $doctype;
    }

    /**
     * Returns the baseURL
     *
     * @return string $baseURL
     * @since 1.0.0
     */
    public function getBaseURL() {
        return $this->baseURL;
    }

    /**
     * Sets the baseURL
     *
     * @param string $baseURL
     * @return void
     * @since 1.0.0
     */
    public function setBaseURL($baseURL) {
        $this->baseURL = $baseURL;
    }

    /**
     * Returns the linkVars
     *
     * @return string $linkVars
     * @since 1.0.0
     */
    public function getLinkVars() {
        return $this->linkVars;
    }

    /**
     * Sets the linkVars
     *
     * @param string $linkVars
     * @return void
     * @since 1.0.0
     */
    public function setLinkVars($linkVars) {
        $this->linkVars = $linkVars;
    }

    /**
     * Returns the disableCharsetHeader
     *
     * @return string $disableCharsetHeader
     * @since 1.0.0
     */
    public function getDisableCharsetHeader() {
        return $this->disableCharsetHeader;
    }

    /**
     * Sets the disableCharsetHeader
     *
     * @param string $disableCharsetHeader
     * @return void
     * @since 1.0.0
     */
    public function setDisableCharsetHeader($disableCharsetHeader) {
        $this->disableCharsetHeader = $disableCharsetHeader;
    }

    /**
     * Returns the metaCharset
     *
     * @return string $metaCharset
     * @since 1.0.0
     */
    public function getMetaCharset() {
        return $this->metaCharset;
    }

    /**
     * Sets the metaCharset
     *
     * @param string $metaCharset
     * @return void
     * @since 1.0.0
     */
    public function setMetaCharset($metaCharset) {
        $this->metaCharset = $metaCharset;
    }

    /**
     * Returns the languageUid
     *
     * @return integer $languageUid
     * @since 1.0.0
     */
    public function getLanguageUid() {
        return $this->languageUid;
    }

    /**
     * Sets the languageUid
     *
     * @param integer $languageUid
     * @return void
     * @since 1.0.0
     * 
     * @throws \InvalidArgumentException
     */
    public function setLanguageUid($languageUid) {
        if($languageUid<0) {
            throw new \InvalidArgumentException(
                '$languageUid must be greater then zero'
            );
        }
        $this->languageUid = $languageUid;
    }

    /**
     * Returns the languageTitle
     *
     * @return string $languageTitle
     * @since 1.0.0
     */
    public function getLanguageTitle() {
        return $this->languageTitle;
    }

    /**
     * Sets the languageTitle
     *
     * @param string $languageTitle
     * @return void
     * @since 1.0.0
     */
    public function setLanguageTitle($languageTitle) {
        $this->languageTitle = $languageTitle;
    }

    /**
     * Returns the language
     *
     * @return string $language
     * @since 1.0.0
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param string $language
     * @return void
     * @since 1.0.0
     */
    public function setLanguage($language) {
        $this->language = $language;
    }

    /**
     * Returns the localeAll
     *
     * @return string $localeAll
     * @since 1.0.0
     */
    public function getLocaleAll() {
        return $this->localeAll;
    }

    /**
     * Sets the localeAll
     *
     * @param string $localeAll
     * @return void
     * @since 1.0.0
     */
    public function setLocaleAll($localeAll) {
        $this->localeAll = $localeAll;
    }

    /**
     * Returns the spamProtectEmailAddresses
     *
     * @return boolean $spamProtectEmailAddresses
     * @since 1.0.0
     */
    public function getSpamProtectEmailAddresses() {
        return $this->spamProtectEmailAddresses;
    }

    /**
     * Sets the spamProtectEmailAddresses
     *
     * @param boolean $spamProtectEmailAddresses
     * @return void
     * @since 1.0.0
     */
    public function setSpamProtectEmailAddresses($spamProtectEmailAddresses) {
        $this->spamProtectEmailAddresses = $spamProtectEmailAddresses;
    }

    /**
     * Returns the spamProtectEmailAddressesAtSubst
     *
     * @return string $spamProtectEmailAddressesAtSubst
     * @since 1.0.0
     */
    public function getSpamProtectEmailAddressesAtSubst() {
        return $this->spamProtectEmailAddressesAtSubst;
    }

    /**
     * Sets the spamProtectEmailAddressesAtSubst
     *
     * @param string $spamProtectEmailAddressesAtSubst
     * @return void
     * @since 1.0.0
     */
    public function setSpamProtectEmailAddressesAtSubst($spamProtectEmailAddressesAtSubst) {
        $this->spamProtectEmailAddressesAtSubst = $spamProtectEmailAddressesAtSubst;
    }

    /**
     * Returns the spamProtectEmailAddressesLastDotSubst
     *
     * @return string $spamProtectEmailAddressesLastDotSubst
     * @since 1.0.0
     */
    public function getSpamProtectEmailAddressesLastDotSubst() {
        return $this->spamProtectEmailAddressesLastDotSubst;
    }

    /**
     * Sets the spamProtectEmailAddressesLastDotSubst
     *
     * @param string $spamProtectEmailAddressesLastDotSubst
     * @return void
     * @since 1.0.0
     */
    public function setSpamProtectEmailAddressesLastDotSubst($spamProtectEmailAddressesLastDotSubst) {
        $this->spamProtectEmailAddressesLastDotSubst = $spamProtectEmailAddressesLastDotSubst;
    }

    /**
     * Returns the prefixLocalAnchors
     *
     * @return string $prefixLocalAnchors
     * @since 1.0.1
     */
    public function getPrefixLocalAnchors() {
        return $this->prefixLocalAnchors;
    }

    /**
     * Sets the prefixLocalAnchors
     *
     * @param string $prefixLocalAnchors
     * @return void
     * @since 1.0.1
     */
    public function setPrefixLocalAnchors($prefixLocalAnchors) {
        $this->prefixLocalAnchors = $prefixLocalAnchors;
    }

    /**
     * Returns the speakingPaths
     *
     * @return string $speakingPaths
     * @since 1.0.1
     */
    public function getSpeakingPaths() {
        return $this->speakingPaths;
    }

    /**
     * Sets the speakingPaths
     *
     * @param string $speakingPaths
     * @return void
     * @since 1.0.1
     */
    public function setSpeakingPaths($speakingPaths) {
        $this->speakingPaths = $speakingPaths;
    }

    /**
     * Returns the useHtml5Js
     *
     * @return boolean $useHtml5Js
     * @since 1.0.3
     */
    public function getUseHtml5Js() {
        return $this->useHtml5Js;
    }

    /**
     * Sets the useHtml5Js
     *
     * @param boolean $useHtml5Js
     * @return void
     * @since 1.0.3
     */
    public function setUseHtml5Js($useHtml5Js) {
        $this->useHtml5Js = $useHtml5Js;
    }

    /**
     * Returns the boolean state of useHtml5Js
     *
     * @return boolean
     * @since 1.0.3
     */
    public function isUseHtml5Js() {
        return $this->getUseHtml5Js();
    }

    /**
     * Returns the googleAnalyticsTrackingCode
     *
     * @return string $googleAnalyticsTrackingCode
     * @since 1.0.4
     */
    public function getGoogleAnalyticsTrackingCode() {
        return $this->googleAnalyticsTrackingCode;
    }

    /**
     * Sets the googleAnalyticsTrackingCode
     *
     * @param string $googleAnalyticsTrackingCode
     * @return void
     * @since 1.0.4
     */
    public function setGoogleAnalyticsTrackingCode($googleAnalyticsTrackingCode) {
        $this->googleAnalyticsTrackingCode = $googleAnalyticsTrackingCode;
    }


    /**
     * Sets the default values
     *
     * @return void
     * @since 1.0.0
     */
    public function setDefaults() {
        $this->setMetaCharset('UTF-8');
        $this->setLinkVars('L');
        $this->setLanguageUid(0);
        $this->setLanguage('en');
        $this->setLocaleAll('en_US.UTF-8');
        $this->setPrefixLocalAnchors('all');
        $this->setSpeakingPaths('none');
    } 

    /**
     * Returns the data as array
     * @return array
     * @since 1.0.0
     */
    public function toArray() {
        
        $data = array();
        $data['doctype']                   = $this->getDoctype();
        $data['baseURL']                   = $this->getBaseURL();
        $data['linkVars']                  = $this->getLinkVars();
        $data['disableCharsetHeader']      = $this->getDisableCharsetHeader();
        $data['metaCharset']               = $this->getMetaCharset();
        $data['languageUid']               = $this->getLanguageUid();
        $data['languageTitle']             = $this->getLanguageTitle();
        $data['language']                  = $this->getLanguage();
        $data['localeAll']                 = $this->getLocaleAll();
        $data['spamProtectEmailAddresses']             = $this->getSpamProtectEmailAddresses();
        $data['spamProtectEmailAddressesAtSubst']      = $this->getSpamProtectEmailAddressesAtSubst();
        $data['spamProtectEmailAddressesLastDotSubst'] = $this->getSpamProtectEmailAddressesLastDotSubst();
        $data['prefixLocalAnchors']        = $this->getPrefixLocalAnchors();
        $data['speakingPaths']             = $this->getSpeakingPaths();
        $data['useHtml5Js']                = $this->getUseHtml5Js();
        $data['googleAnalyticsTrackingCode'] = $this->getGoogleAnalyticsTrackingCode();
                
        return $data;
    }
}
?>