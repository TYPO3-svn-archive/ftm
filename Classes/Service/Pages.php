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
 * Managed alle Aktionen mit den Seiten/Pages
 *
 * @package ftm
 * @subpackage Service
 */
class Pages {

    /**
     * Benoetigte globale Seiten-Struktur
     * @var array
     * @since 1.0.0
     */
    protected $globalPages = array(
        'GlobalStorage'                => array('doktype'=>'254', 'module'=>''), //Hier liegen alle globalen Datensaetze',
        'GlobalStorage/BackendLayouts' => array('doktype'=>'254', 'module'=>''), //Hier liegen alle Backend-Layouts',
        // 'GlobalStorage/GridLayouts'    => array('doktype'=>'254', 'module'=>''), //Hier liegen alle Grid-Layouts',
    );

    /**
     * Benoetigte domain Seiten-Struktur
     * @var array
     * @since 1.0.0
     */
    protected $domainPages = array(
        'DomainStorage'                 => array('doktype'=>'254', 'module'=>''), //Hier liegen alle globalen Datensaetze',
        'DomainStorage/BackendLayouts'  => array('doktype'=>'254', 'module'=>''), //Hier liegen alle Backend-Layouts',
        'DomainStorage/ContentElements' => array('doktype'=>'254', 'module'=>''), //Hier liegen alle Content-Elemente',
        'DomainStorage/FrontendUser'    => array('doktype'=>'254', 'module'=>'fe_users'), //Hier liegen alle Frontend-User',
    );

    /**
     * Pages Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\PagesRepository
     */
    protected $pagesRepository;

    /**
     * Persistence-manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * Object-Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * Meldungen
     *
     * @var string
     */
    protected $messages = "";

    /**
     * injectPagesRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\PagesRepository $pagesRepository
     * @return void
     */
    public function injectPagesRepository(\CodingMs\Ftm\Domain\Repository\PagesRepository $pagesRepository) {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * injectPersistenceManager
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager
     * @return void
     */
    public function injectPersistenceManager(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager) {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * injectObjectManager
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager
     * @return void
     */
    public function injectObjectManager(\TYPO3\CMS\Extbase\Object\ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }
    
    /**
     * Prueft ob alle globalen Seiten vorhanden sind
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @since      22.11.2013
     * 
     * @param integer $ftmPid Page-Id des FTM-Templates
     * @return mixed boolean wenn alles aktuell ist, ansonsten die Meldungens
     */
    public function checkPages($ftmPid=0) {
        
        
        // GlobalStorage
        // Wir starten immer bei Tiefe: 0
        // -------------------------------------------------
        $currentPid = 0;
        $currentPagePath = "";
        
        if(!empty($this->globalPages)) {
            foreach ($this->globalPages as $title => $config) {
                
                /**
                 * @var \CodingMs\Ftm\Domain\Model\Pages
                 */
                $currentPage = $this->getAndCreatePage($currentPagePath, $title, $currentPid, $config);
                if($currentPid==0) {
                    $currentPid  = $currentPage->getUid();
                    $currentPagePath = $currentPage->getTitle()."/";
                }
                
            }
        }
        // -------------------------------------------------
        
        
        // DomainStorage
        // Wir starten immer bei Tiefe: x -> FTM-Seite
        // -------------------------------------------------
        $currentPid = $ftmPid;
        $currentPagePath = "";
        
        if(!empty($this->domainPages)) {
            foreach ($this->domainPages as $title => $config) {
                
                /**
                 * @var \CodingMs\Ftm\Domain\Model\Pages
                 */
                $currentPage = $this->getAndCreatePage($currentPagePath, $title, $currentPid, $config);
                if($currentPid==$ftmPid) {
                    $currentPid  = $currentPage->getUid();
                    $currentPagePath = $currentPage->getTitle()."/";
                }
                
            }
        }
        // -------------------------------------------------
        
        
        // Wenn Seiten erstellt worden sind
        // aktualisiere den Page-Tree
        if(trim($this->messages)!="") {
            \TYPO3\CMS\Backend\Utility\BackendUtility::setUpdateSignal('updatePageTree');
            return $this->messages;
        }
        else {
            return true;
        }
    }
        
    /**
     * Seite auslesen und ggf. erstellen
     * 
     * @param string $title Name der Seite
     * @param integer $pid Pid der Eltern-Seite der Seite
     * @param integer $doktype Typ der Seite, bspw. 254 fuer Container
     * @return \CodingMs\Ftm\Domain\Model\Pages Existierende oder neue Seite
     */
    protected function getAndCreatePage($currentPagePath, $fullTitle, $pid, $config) {
        
        $title = str_replace($currentPagePath, "", $fullTitle);
                
        $rootPage = $this->pagesRepository->findOneByTitleAndPid($title, $pid);
        if(!($rootPage instanceof \CodingMs\Ftm\Domain\Model\Pages)) {
            
            /**
             * @var \CodingMs\Ftm\Domain\Model\Pages
             */
            $rootPage = $this->objectManager->create('CodingMs\Ftm\Domain\Model\Pages');
            $rootPage->setPid($pid);
            $rootPage->setTitle($title);
            $rootPage->setDoktype($config['doktype']);
            $rootPage->setModule($config['module']);
            
            // Seite speichern
            $this->pagesRepository->add($rootPage);
                      
            // und persistieren
            $this->persistenceManager->persistAll();
            
            // Meldung registrieren
            $this->messages.= $fullTitle." wurde erstellt<br />\n";
        }
                    
        return $rootPage;
    } 
    
}

?>
