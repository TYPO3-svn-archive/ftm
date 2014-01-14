<?php
namespace CodingMs\Ftm\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
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
 * Fluid Funktionen
 * Sorgt z.B. dafuer, das die Template-Dateien, die nur
 * als Datei existieren als Datensatz erstellt werden
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.0.0
 */
class Template {

    /**
     * Object-Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Template Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateRepository
     */
    protected static $templateRepository;

    /**
     * Prueft ob es fuer diese Seite schon ein Template-Object
     * gibt, wenn nicht wird eins erstellt
     *
     * @return \CodingMs\Ftm\Domain\Model\Template
     */
    public static function getTemplate($pid) {
        
        
        //$tempFluid = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateFluid');
        
        if(!(self::$templateRepository instanceof \CodingMs\Ftm\Domain\Repository\TemplateRepository)) {
            self::$templateRepository = new \CodingMs\Ftm\Domain\Repository\TemplateRepository();
        }
        
        // Template auslesen, falls vorhanden
        $fluidTemplate = self::$templateRepository->findOneByPid($pid);
        
        
        // Wenn es noch keinen gibt, erstelle einen
        if(!($fluidTemplate instanceof \CodingMs\Ftm\Domain\Model\Template)) {


            
            /**
             * @ToDo: Hier sollte geschaut werden ob auf 
             * Eltern-Seiten ein Template existiert
             */
            
            // Template speichern
            // $this->fluidTemplateRepository->add($fluidTemplate);
            return null;
        }
        
        return $fluidTemplate;
    }
   
    
}

?>