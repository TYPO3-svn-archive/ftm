<?php
namespace CodingMs\Ftm\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
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
class TtAddressGroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    
    /**
     * Title
     * 
     * @var string 
     */
    protected $title;

    /**
     * Description
     * 
     * @var string 
     */
    protected $description;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Gets the hidden-Flag
     *
     * @return void
     */
    public function getHidden() {
        return $this->hidden;
    }

    /**
     * Sets the hidden-Flag
     *
     * @param int $hidden
     * @return void
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

    /**
     * Gets the Page-Id
     * 
     * @return void
     */
    public function getPid() {
        return $this->pid;
    }

    /**
     * Sets the Page-Id
     *
     * @param int $pid
     * @return void
     */
    public function setPid($pid) {
        $this->pid = $pid;
    }

    /**
     * Gets the Unique-Id
     * 
     * @return void
     */
    public function getUid() {
        return $this->uid;
    }

    /**
     * Sets the Unique-Id
     *
     * @param int $pid
     * @return void
     */
    public function setUid($uid) {
        $this->uid = $uid;
    }

    /**
     * Gets the Title
     * 
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets the Title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Gets the Description
     * 
     * @return string
     */
    public function getDescription() {
        return $this->decription;
    }

    /**
     * Sets the Description
     *
     * @param string $decription
     * @return void
     */
    public function setDescription($decription) {
        $this->decription = $decription;
    }

}
?>