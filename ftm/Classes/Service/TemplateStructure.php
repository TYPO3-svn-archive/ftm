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
 * Managed alle Aktionen rund um TYAML-Datensaetze
 *
 * @package ftm
 * @subpackage Service
 */
class TemplateStructure {
    

    /**
     * Benoetigte Verzeichnis Struktur
     * @var array
     * @since 1.0.0
     */
    public static $directories = array(
        'uploads/media'           => 'Hier liegen die Bilder der Backend-Layouts'
    );

    /**
     * Benoetigte Backend-Layouts
     * @var array
     * @since 1.0.0
     */
    public static $backendLayouts = array(
        'BackendLayout C - Startsite' => array(
            'template'    => 'startsite.html', 
            'sorting'     => '128', 
            'title'       => 'BackendLayout C - Startsite', 
            'description' => 'Content (Startsite)', 
            'config'      => 'backend_layout {\r\n colCount = 3\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 3\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 3\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_C-Startsite.jpg'
        ),
        'BackendLayout MCS' => array(
            'template'    => 'mcs.html', 
            'sorting'     => '256', 
            'title'       => 'BackendLayout MCS', 
            'description' => 'Menu - Content - Side', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               3 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_MCS.jpg'
        ),
        'BackendLayout SCM' => array(
            'template'    => 'scm.html', 
            'sorting'     => '512', 
            'title'       => 'BackendLayout SCM', 
            'description' => 'Side - Content - Menu', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               3 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_SCM.jpg'
        ),
        'BackendLayout MSC' => array(
            'template'    => 'msc.html', 
            'sorting'     => '768', 
            'title'       => 'BackendLayout MSC', 
            'description' => 'Menu - Side - Content', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               2 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               3 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_MSC.jpg'
        ),
        'BackendLayout SMC' => array(
            'template'    => 'smc.html', 
            'sorting'     => '1024', 
            'title'       => 'BackendLayout SMC', 
            'description' => 'Side - Menu -Content', 
            'config'      => 'backend_layout {\r\n    colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               2 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               3 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_SMC.jpg'
        ),
        'BackendLayout CSM' => array(
            'template'    => 'csm.html', 
            'sorting'     => '1280', 
            'title'       => 'BackendLayout CSM', 
            'description' => 'Content - Side - Menu', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               3 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_CSM.jpg'
        ),
        'BackendLayout CMS' => array(
            'template'    => 'cms.html', 
            'sorting'     => '1536', 
            'title'       => 'BackendLayout CMS', 
            'description' => 'Content - Menu - Side', 
            'config'      => 'backend_layout {\r\n    colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               3 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_CMS.jpg'
        ),
        'BackendLayout MC' => array(
            'template'    => 'mc.html', 
            'sorting'     => '1792', 
            'title'       => 'BackendLayout MC', 
            'description' => 'Menu - Content', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_MC.jpg'
        ),
        'BackendLayout SC' => array(
            'template'    => 'sc.html', 
            'sorting'     => '2048', 
            'title'       => 'BackendLayout SC', 
            'description' => 'Side - Content', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_SC.jpg'
        ),
        'BackendLayout CM' => array(
            'template'    => 'cm.html', 
            'sorting'     => '2304', 
            'title'       => 'BackendLayout CM', 
            'description' => 'Content - Menu', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_CM.jpg'
        ),
        'BackendLayout CS' => array(
            'template'    => 'cs.html', 
            'sorting'     => '2560', 
            'title'       => 'BackendLayout CS', 
            'description' => 'Content - Side', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_CS.jpg'
        ),
        'BackendLayout C' => array(
            'template'    => 'c.html', 
            'sorting'     => '2816', 
            'title'       => 'BackendLayout C', 
            'description' => 'Content', 
            'config'      => 'backend_layout {\r\n colCount = 3\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 3\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 3\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_C.jpg'
        ),
        'BackendLayout C - Empty' => array(
            'template'    => 'empty.html', 
            'sorting'     => '3072', 
            'title'       => 'BackendLayout C - Empty', 
            'description' => 'Content (with empty layout)', 
            'config'      => 'backend_layout {\r\n   colCount = 1\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colPos = 0\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_C-Empty.jpg'
        ),
        'BackendLayout C - Special' => array(
            'template'    => 'special.html', 
            'sorting'     => '3328', 
            'title'       => 'BackendLayout C - Special', 
            'description' => 'Content (special)', 
            'config'      => 'backend_layout {\r\n   colCount = 1\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colPos = 0\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_C-Special.jpg'
        ) 
    );


    /**
     * Grid-Layout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\GridLayoutRepository
     */
    protected $gridLayoutRepository;

    /**
     * Backend-Layout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\BackendLayoutRepository
     */
    protected $backendLayoutRepository;

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
     * injectGridLayoutRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\GridLayoutRepository $gridLayoutRepository
     * @return void
     */
    public function injectGridLayoutRepository(\CodingMs\Ftm\Domain\Repository\GridLayoutRepository $gridLayoutRepository) {
        $this->gridLayoutRepository = $gridLayoutRepository;
    }

    /**
     * injectBackendLayoutRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\BackendLayoutRepository $backendLayoutRepository
     * @return void
     */
    public function injectBackendLayoutRepository(\CodingMs\Ftm\Domain\Repository\BackendLayoutRepository $backendLayoutRepository) {
        $this->backendLayoutRepository = $backendLayoutRepository;
    }

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
     * Prueft ob das Sys-Template vorhanden ist, und
     * generiert es ggf. neu
     * Dies machen wir ohne Repository, weil wir noch nicht
     * mappen koennen.
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @since      22.11.2013
     * 
     * @return mixed boolean wenn alles aktuell ist, ansonsten die Meldungens
     */
    public function checkStructure($pid, $fluidTemplate) {
        
        
        // Benoetigten Verzeichnisse pruefen
        // $this->checkRequiredDirectories();
        $createdSomething=false;
        
        
        // Erforderlichen Seiten ermitteln
        $globalStoragePage = $this->pagesRepository->findOneByTitleAndPid("GlobalStorage",  0);
        $gridLayoutPage    = $this->pagesRepository->findOneByTitleAndPid("GridLayouts",    $globalStoragePage->getUid());
        $backendLayoutPage = $this->pagesRepository->findOneByTitleAndPid("BackendLayouts", $globalStoragePage->getUid());
        
        
        /**
         * @ToDo: Nachricht uber erstellte Layouts ausgeben
         */
        
        
        if(!empty(self::$backendLayouts)) {
            foreach (self::$backendLayouts as $title => $backendLayout) {
                
                
                // Icon-Verzeichnisse ermitteln und pruefen
                $iconSource = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName("EXT:ftm/Resources/Private/Uploads/Media/");
                $iconTarget = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName("uploads/media/");

                if(!file_exists($iconSource)) {
                    throw new \Exception("Media icon source directory '".$iconSource."' not found", 1);
                }
                if(!file_exists($iconTarget)) {
                    throw new \Exception("Media icon target directory '".$iconTarget."' not found", 1);
                }
                    
                
                // Wenn es das Backend-Layout noch nicht gibt
                // wird es nun erstellt
                $backendLayoutObject = $this->backendLayoutRepository->findOneByTitleAndPid($backendLayout['title'],  $backendLayoutPage->getUid());
                if(!($backendLayoutObject instanceof \CodingMs\Ftm\Domain\Model\BackendLayout)) {
                
                    /**
                     * @var \CodingMs\Ftm\Domain\Model\BackendLayout
                     */
                    $backendLayoutObject = $this->objectManager->create('CodingMs\Ftm\Domain\Model\BackendLayout');
                    $backendLayoutObject->setPid($backendLayoutPage->getUid());
                    $backendLayoutObject->setSorting($backendLayout['sorting']);
                    $backendLayoutObject->setTitle($backendLayout['title']);
                    $backendLayoutObject->setDescription($backendLayout['description']);
                    $backendLayoutObject->setConfig(str_replace('\r\n', "\n", $backendLayout['config']));
                    $backendLayoutObject->setIcon($backendLayout['icon']);
                    
                    // Seite speichern
                    $this->backendLayoutRepository->add($backendLayoutObject);
                              
                    // und persistieren
                    $this->persistenceManager->persistAll();
                    
                    // Merken das wir etwas erstellt haben
                    $createdSomething = true;
                }
                
                // Icon bereitstellen
                if(file_exists($iconSource.$backendLayout['icon'])) {
                    copy($iconSource.$backendLayout['icon'], $iconTarget.$backendLayout['icon']);
                }
                else {
                    throw new \Exception("Media icon '".$iconSource.$backendLayout['icon']."' not found", 1);
                }
                
            }
        }
        
        return $createdSomething;
    }
    
}

?>
