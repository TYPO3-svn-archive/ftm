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
class TemplateTypoScriptSnippet extends \CodingMs\Ftm\Domain\Model\PluginCloudBase {

    /**
     * constants
     *
     * @var \string
     * @since 2.0.0
     */
    protected $constants;

    /**
     * setup
     *
     * @var \string
     * @since 2.0.0
     */
    protected $setup;

    /**
     * Returns the constants
     *
     * @return \string $constants
     * @since 2.0.0
     */
    public function getConstants() {
        return $this->constants;
    }

    /**
     * Sets the constants
     *
     * @param \string $constants
     * @return void
     * @since 2.0.0
     */
    public function setConstants($constants) {
        $this->constants = $constants;
    }

    /**
     * Returns the setup
     *
     * @return \string $setup
     * @since 2.0.0
     */
    public function getSetup() {
        return $this->setup;
    }

    /**
     * Sets the setup
     *
     * @param \string $setup
     * @return void
     * @since 2.0.0
     */
    public function setSetup($setup) {
        $this->setup = $setup;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 2.0.0
     */
    public function toArray() {
        $data = parent::toArray();
        $data['constants']   = $this->getConstants();
        $data['setup']       = $this->getSetup();
        return $data;
    }

}
?>