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
class TemplateDynCssFile extends \CodingMs\Ftm\Domain\Model\PluginCloudBase {

    /**
     * Variablen
     *
     * @var \string
     * @since 2.0.0
     */
    protected $variables;
    /**
     * dynCss
     *
     * @var \string
     * @since 2.0.0
     */
    protected $dynCss;

    /**
     * Returns the variables
     *
     * @return \string $variables
     */
    public function getVariables() {
        return $this->variables;
    }

    /**
     * Sets the variables
     *
     * @param \string $variables
     * @return void
     */
    public function setVariables($variables) {
        $this->variables = $variables;
    }

    /**
     * Returns the dynCss
     *
     * @return \string $dynCss
     */
    public function getDynCss() {
        return $this->dynCss;
    }

    /**
     * Sets the dynCss
     *
     * @param \string $dynCss
     * @return void
     */
    public function setDynCss($dynCss) {
        $this->dynCss = $dynCss;
    }

    /**
     * Returns the data as array
     * @return array
     * @since 2.0.0
     */
    public function toArray() {
        $data = parent::toArray();
        $data['variables'] = $this->getVariables();
        $data['dynCss'] = $this->getDynCss();
        return $data;
    }

}
?>