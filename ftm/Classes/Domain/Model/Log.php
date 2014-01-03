<?php
namespace CodingMs\Ftm\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Thomas Deuling <typo3@coding.ms>
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
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * action
     *
     * @var string
     */
    protected $action;
    
    /**
     * extensionName
     *
     * @var string
     */
    protected $extensionName;
    
    /**
     * Frontend-user
     *
     * @var Tx_CodingMsBase_Domain_Model_FrontendUser
     */
    protected $frontendUser;

    /**
     * Category
     *
     * @var string
     */
    protected $category;

	/**
	 * remoteAddress
	 *
	 * @var string
	 */
	protected $remoteAddress;

	/**
	 * text
	 *
	 * @var string
	 */
	protected $text;

    /**
     * RequestArguments
     *
     * @var string
     */
    protected $requestArguments;
    
    /**
     * Returns the frontendUser
     *
     * @return \CodingMs\Ftm\Domain\Model\FrontendUser $frontendUser
     */
    public function getFrontendUser() {
        return $this->frontendUser;
    }
    
    /**
     * Sets the frontendUser
     *
     * @param \CodingMs\Ftm\Domain\Model\FrontendUser $frontendUser
     * @return void
     */
    public function setFrontendUser($frontendUser) {
        $this->frontendUser = $frontendUser;
    }

    /**
     * Returns the category
     *
     * @return string $category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Sets the category
     *
     * @param string $category
     * @return void
     */
    public function setCategory($category) {
        $this->category = $category;
    }

	/**
	 * Returns the remoteAddress
	 *
	 * @return string $remoteAddress
	 */
	public function getRemoteAddress() {
		return $this->remoteAddress;
	}

	/**
	 * Sets the remoteAddress
	 *
	 * @param string $remoteAddress
	 * @return void
	 */
	public function setRemoteAddress($remoteAddress) {
		$this->remoteAddress = $remoteAddress;
	}

	/**
	 * Returns the text
	 *
	 * @return string $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Sets the text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Returns the action
	 *
	 * @return string $action
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * Sets the action
	 *
	 * @param string $action
	 * @return void
	 */
	public function setAction($action) {
		$this->action = $action;
	}

    /**
     * Returns the extensionName
     *
     * @return string $extensionName
     */
    public function getExtensionName() {
        return $this->extensionName;
    }
    
    /**
     * Sets the extensionName
     *
     * @param string $extensionName
     * @return void
     */
    public function setExtensionName($extensionName) {
        $this->extensionName = $extensionName;
    }
    
    /**
     * Returns the requestArguments
     *
     * @return string $requestArguments
     */
    public function getRequestArguments() {
        return $this->requestArguments;
    }
    
    /**
     * Sets the requestArguments
     *
     * @param string $requestArguments
     * @return void
     */
    public function setRequestArguments($requestArguments) {
        ob_start();
        var_dump($requestArguments, $_REQUEST);
        $this->requestArguments = html_entity_decode(strip_tags(ob_get_clean()));
    }
    
}
?>