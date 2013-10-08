<?php

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

/**
 * Test case for class Tx_Fluid_template_manager_Controller_TemplateController.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Fluid Template Manager
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class Tx_Fluid_template_manager_Controller_TemplateControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
    // /**
     // * @var \CodingMs\Ftm\Domain\Model\Template
     // */
    // protected $fixture;

    public function setUp() {
        // $this->fixture = new \CodingMs\Ftm\Domain\Model\Template();
    }

    public function tearDown() {
        // unset($this->fixture);
    }

    /**
     * @test
     */
    public function dummyMethod() {
        
        // Das hier ist eine Art: ToDo-Methode/Return
        // um zu sagen, der Test hier ist noch nicht
        // ganz aus-implementiert
        $this->markTestIncomplete();
    }

    /**
     * @test
     */
    public function onePusOneIsTwo() {
        $this->assertSame(
            2, 
            1+1
        );
    }

}
?>