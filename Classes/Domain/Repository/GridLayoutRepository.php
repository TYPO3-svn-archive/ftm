<?php
namespace CodingMs\Ftm\Domain\Repository;

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
class GridLayoutRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    
    
    /**
     * Sucht Seiten anhand der Ober-Seite und dem Namen
     * 
     * @param $title Name der Seite 
     * @param $pid Page-Id der Seite
     * @return 
     */
    public function findOneByTitleAndPid($title, $pid) {
        
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        
        $constraints   = array();
        $constraints[] = $query->equals('pid',   $pid);
        $constraints[] = $query->equals('title', $title);
        
        $query->matching(
            $query->logicalAnd($constraints)
        );
        
        return $query->execute()->getFirst();
    }

    public function findAllWithoutPid() {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        return $query->execute();
    }
    
    
}
?>