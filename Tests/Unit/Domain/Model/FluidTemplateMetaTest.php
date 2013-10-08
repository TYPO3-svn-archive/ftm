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
 * Test case for class \CodingMs\Ftm\Domain\Model\TemplateMeta.
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
class \CodingMs\Ftm\Domain\Model\TemplateMetaTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
    /**
     * @var \CodingMs\Ftm\Domain\Model\TemplateMeta
     */
    protected $fixture;

    public function setUp() {
        $this->fixture = new \CodingMs\Ftm\Domain\Model\TemplateMeta();
    }

    public function tearDown() {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getAuthorReturnsInitialValueForString() { }

    /**
     * @test
     */
    public function setAuthorForStringSetsAuthor() { 
        $this->fixture->setAuthor('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getAuthor()
        );
    }
    
    /**
     * @test
     */
    public function getCopyrightReturnsInitialValueForString() { }

    /**
     * @test
     */
    public function setCopyrightForStringSetsCopyright() { 
        $this->fixture->setCopyright('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getCopyright()
        );
    }
    
    /**
     * @test
     */
    public function getRobotsReturnsInitialValueForString() { }

    /**
     * @test
     */
    public function setRobotsForStringSetsRobots() { 
        $this->fixture->setRobots('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getRobots()
        );
    }
    
}
?>