<?php
namespace CodingMs\Ftm\Domain\Repository;

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
class TtAddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    
    /**
     * Ruft eine Addresse ab, dessen UID uebereinstimmt
     * die page ist aber egal
     *
     * @param string $uid UID der Adresse
     * @return CodingMs\Ftm\Domain\Model\TtAddress
     */
    public function findOneByUidWithoutPid($uid) {
        $query = $this->createQuery();
        // $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->getQuerySettings()->setRespectEnableFields(FALSE);
        $query->matching($query->equals('uid', $uid));
        return $query->execute()->getFirst();
    }

    /**
     * Ermittelt alle Adressen der uebergebenen Gruppen
     *
     * @param array $addressGroups TtAddress-Groups
     * @return CodingMs\Ftm\Domain\Model\TtAddress
     */
    public function findAllByAddressgroup(array $addressGroups=array()) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectEnableFields(FALSE);
        $query->matching($query->in('addressgroup', $addressGroups));
        return $query->execute();
    }
    
}
?>