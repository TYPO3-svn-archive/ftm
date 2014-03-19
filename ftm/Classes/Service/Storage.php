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
 * Prueft ob es Updates gibt
 *
 * @package ftm
 * @subpackage Service
 * 
 * @author Thomas Deuling <typo3@coding.ms>
 * @since 1.1.0
 */
class Storage {

    /**
     * Storage Repository
     *
     * @var \TYPO3\CMS\Core\Resource\StorageRepository
     */
    protected $storageRepository;

    /**
     * injectStorageRepository
     *
     * @param \TYPO3\CMS\Core\Resource\StorageRepository $storageRepository
     * @return void
     */
    public function injectSorageRepository(\TYPO3\CMS\Core\Resource\StorageRepository $storageRepository) {
        $this->storageRepository = $storageRepository;
    }
    
    /**
     * Backuped eine Datei
     *
     * @return  void
     */
    public function checkAndCreate($extensionDirectory='') {
        
        // Pfad muss es geben
        // Pfad darf nur Buchstaben und Unterstriche enthalten
        $relPath = 'typo3conf/ext/'.$extensionDirectory.'/';
        $absPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        if($extensionDirectory=="" || !preg_match('/^[a-zA-Z0-9_]*$/', $extensionDirectory) || !file_exists($absPath)) {
            throw new \Exception('Invalid template path \''.$extensionDirectory.'\'', 1);
        } 
        
        // Pruefen ob es das Sorage schon gibt
        $storageUid = 0;
        $storages = $this->storageRepository->findAll();
        if(!empty($storages)) {
            foreach($storages as $storage) {
                $storageConfiguration = $storage->getConfiguration();
                if($storageConfiguration['basePath'] == $relPath) {
                    $storageUid = $storage->getUid();
                }
            }
        }
        
        // Wenn es das Storage noch nicht gibt, erstelle es
        if($storageUid==0) {
            $storageUid = $this->storageRepository->createLocalStorage($relPath, $relPath, 'relative', 'Template-Storage for '.$extensionDirectory);
            return "created";
        }
        return "alreadyAvailable";
    }
    
}

?>