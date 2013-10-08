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
 * Test case for class \CodingMs\Ftm\Domain\Model\Template.
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
class \CodingMs\Ftm\Domain\Model\TemplateTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
    
    
    /**
     * @var \CodingMs\Ftm\Domain\Model\Template
     */
    protected $fixture = null;

    public function setUp() {
        $this->fixture = new \CodingMs\Ftm\Domain\Model\Template();
    }

    public function tearDown() {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getTemplateDirReturnsInitialValueForString() {
        $this->assertSame(
            '',
            $this->fixture->getTemplateDir()
        );
    }

    /**
     * @test
     */
    public function setTemplateDirForStringSetsTemplateDir() {
        $testString = "TheTestSting";
        $this->fixture->setTemplateDir($testString);

        $this->assertSame(
            $testString,
            $this->fixture->getTemplateDir()
        );
    }
    
    
}
?>