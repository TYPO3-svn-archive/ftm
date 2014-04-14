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
class PluginCloudBase extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * hidden
     *
     * @var \boolean
     */
    protected $hidden;

    /**
     * name
     *
     * @var \string
     * @since 2.0.0
     */
    protected $name;

    /**
     * filename
     *
     * @var \string
     * @since 2.0.0
     */
    protected $filename;

    /**
     * type
     *
     * @var \string
     * @since 2.0.0
     */
    protected $type;

    /**
     * description
     *
     * @var \string
     * @since 2.0.0
     */
    protected $description='';

    /**
     * public readable
     *
     * @var \boolean
     * @since 2.0.0
     */
    protected $publicReadable=FALSE;

    /**
     * public writeable
     *
     * @var \boolean
     * @since 2.0.0
     */
    protected $publicWriteable=FALSE;

    /**
     * next list uid
     * temporär, nicht in db
     * @var int
     * @since 2.0.0
     */
    protected $nextListUid = 0;

    /**
     * previous list uid
     * temporär, nicht in db
     * @var int
     * @since 2.0.0
     */
    protected $previousListUid = 0;

    /**
     * Returns the hidden
     *
     * @return \boolean $hidden
     */
    public function getHidden() {
        return $this->hidden;
    }

    /**
     * Sets the hidden
     *
     * @param \boolean $hidden
     * @return void
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

    /**
     * Returns the name
     *
     * @return \string $name
     * @since 2.0.0
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param \string $name
     * @return void
     * @since 2.0.0
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Returns the filename
     *
     * @return \string $filename
     * @since 2.0.0
     */
    public function getFilename() {
        return $this->filename;
    }

    /**
     * Sets the filename
     *
     * @param \string $filename
     * @return void
     * @since 2.0.0
     */
    public function setFilename($filename) {
        $this->filename = $filename;
    }

    /**
     * Returns the type
     *
     * @return \string $type
     * @since 2.0.0
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param \string $type
     * @return void
     * @since 2.0.0
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * Returns the description
     *
     * @return \string $description
     * @since 2.0.0
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param \string $description
     * @return void
     * @since 2.0.0
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns the nextListUid
     *
     * @return int $nextListUid
     */
    public function getNextListUid() {
        return $this->nextListUid;
    }

    /**
     * Sets the nextListUid
     *
     * @param int $nextListUid
     * @return void
     */
    public function setNextListUid($nextListUid) {
        $this->nextListUid = $nextListUid;
    }

    /**
     * Returns the previousListUid
     *
     * @return int $previousListUid
     */
    public function getPreviousListUid() {
        return $this->previousListUid;
    }

    /**
     * Sets the previousListUid
     *
     * @param int $previousListUid
     * @return void
     */
    public function setPreviousListUid($previousListUid) {
        $this->previousListUid = $previousListUid;
    }

    /**
     * Returns the publicReadable
     *
     * @return \boolean $publicReadable
     * @since 2.0.0
     */
    public function getPublicReadable() {
        return $this->publicReadable;
    }

    /**
     * Sets the publicReadable
     *
     * @param \boolean $publicReadable
     * @return void
     * @since 2.0.0
     */
    public function setPublicReadable($publicReadable) {
        $this->publicReadable = $publicReadable;
    }

    /**
     * Returns the publicWriteable
     *
     * @return \boolean $publicWriteable
     * @since 2.0.0
     */
    public function getPublicWriteable() {
        return $this->publicWriteable;
    }

    /**
     * Sets the publicWriteable
     *
     * @param \boolean $publicWriteable
     * @return void
     * @since 2.0.0
     */
    public function setPublicWriteable($publicWriteable) {
        $this->publicWriteable = $publicWriteable;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 2.0.0
     */
    public function toArray() {
        $data = array();
        $data['type']        = $this->getType();
        $data['name']        = $this->getName();
        $data['filename']        = $this->getFilename();
        $data['description']     = $this->getDescription();
        $data['publicReadable']  = $this->getPublicReadable();
        $data['publicWriteable'] = $this->getPublicWriteable();
        return $data;
    }

}
?>