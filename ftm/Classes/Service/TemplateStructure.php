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
        'BackendLayout Startsite' => array(
            'template'    => 'Startsite.html', 
            'sorting'     => '128', 
            'title'       => 'BackendLayout Startsite', 
            'description' => 'Content (Startsite)', 
            'config'      => 'backend_layout {\r\n colCount = 3\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 3\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 3\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_C-Startsite.jpg'
        ),
        'BackendLayout MenuContentSidebar' => array(
            'template'    => 'MenuContentSidebar.html', 
            'sorting'     => '256', 
            'title'       => 'BackendLayout MenuContentSidebar', 
            'description' => 'Menu - Content - Side', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               3 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_MCS.jpg'
        ),
        'BackendLayout SidebarContentMenu' => array(
            'template'    => 'SidebarContentMenu.html', 
            'sorting'     => '512', 
            'title'       => 'BackendLayout SidebarContentMenu', 
            'description' => 'Side - Content - Menu', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               3 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_SCM.jpg'
        ),
        'BackendLayout MenuSidebarContent' => array(
            'template'    => 'MenuSidebarContent.html', 
            'sorting'     => '768', 
            'title'       => 'BackendLayout MenuSidebarContent', 
            'description' => 'Menu - Side - Content', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               2 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               3 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_MSC.jpg'
        ),
        'BackendLayout SidebarMenuContent' => array(
            'template'    => 'SidebarMenuContent.html', 
            'sorting'     => '1024', 
            'title'       => 'BackendLayout SidebarMenuContent', 
            'description' => 'Side - Menu -Content', 
            'config'      => 'backend_layout {\r\n    colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               2 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               3 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_SMC.jpg'
        ),
        'BackendLayout ContentSidebarMenu' => array(
            'template'    => 'ContentSidebarMenu.html', 
            'sorting'     => '1280', 
            'title'       => 'BackendLayout ContentSidebarMenu', 
            'description' => 'Content - Side - Menu', 
            'config'      => 'backend_layout {\r\n colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               3 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_CSM.jpg'
        ),
        'BackendLayout ContentMenuSidebar' => array(
            'template'    => 'ContentMenuSidebar.html', 
            'sorting'     => '1536', 
            'title'       => 'BackendLayout ContentMenuSidebar', 
            'description' => 'Content - Menu - Side', 
            'config'      => 'backend_layout {\r\n    colCount = 5\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 5\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               3 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 5\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_CMS.jpg'
        ),
        'BackendLayout MenuContent' => array(
            'template'    => 'MenuContent.html', 
            'sorting'     => '1792', 
            'title'       => 'BackendLayout MenuContent', 
            'description' => 'Menu - Content', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_MC.jpg'
        ),
        'BackendLayout SidebarContent' => array(
            'template'    => 'SidebarContent.html', 
            'sorting'     => '2048', 
            'title'       => 'BackendLayout SidebarContent', 
            'description' => 'Side - Content', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n               2 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_SC.jpg'
        ),
        'BackendLayout ContentMenu' => array(
            'template'    => 'ContentMenu.html', 
            'sorting'     => '2304', 
            'title'       => 'BackendLayout ContentMenu', 
            'description' => 'Content - Menu', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = MENU\r\n                 rowspan = 3\r\n                 colPos = 1\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_CM.jpg'
        ),
        'BackendLayout ContentSidebar' => array(
            'template'    => 'ContentSidebar.html', 
            'sorting'     => '2560', 
            'title'       => 'BackendLayout ContentSidebar', 
            'description' => 'Content - Side', 
            'config'      => 'backend_layout {\r\n colCount = 4\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 4\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n               2 {\r\n                 name = SIDE\r\n                 rowspan = 3\r\n                 colPos = 2\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 4\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_CS.jpg'
        ),
        'BackendLayout Content' => array(
            'template'    => 'Content.html', 
            'sorting'     => '2816', 
            'title'       => 'BackendLayout Content', 
            'description' => 'Content', 
            'config'      => 'backend_layout {\r\n colCount = 3\r\n    rowCount = 5\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = TEASER\r\n                   colspan = 3\r\n                 colPos = 3\r\n              }\r\n           }\r\n       }\r\n       2 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colspan = 3\r\n                 rowspan = 3\r\n                 colPos = 0\r\n              }\r\n           }\r\n       }\r\n       3 {\r\n         columns {\r\n           }\r\n       }\r\n       4 {\r\n         columns {\r\n           }\r\n       }\r\n       5 {\r\n         columns {\r\n               1 {\r\n                 name = EXTENDED\r\n                 colspan = 3\r\n                 colPos = 4\r\n              }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'icon'        => 'BackendLayout_C.jpg'
        ),
        'BackendLayout Empty' => array(
            'template'    => 'Empty.html', 
            'sorting'     => '3072', 
            'title'       => 'BackendLayout Empty', 
            'description' => 'Content (with empty layout)', 
            'config'      => 'backend_layout {\r\n   colCount = 1\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colPos = 0\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_C-Empty.jpg'
        ),
        'BackendLayout Special' => array(
            'template'    => 'Special.html', 
            'sorting'     => '3328', 
            'title'       => 'BackendLayout Special', 
            'description' => 'Content (special)', 
            'config'      => 'backend_layout {\r\n   colCount = 1\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = CONTENT\r\n                  colPos = 0\r\n              }\r\n           }\r\n       }\r\n   }\r\n}', 
            'icon'        => 'BackendLayout_C-Special.jpg'
        ) 
    );


    /**
     * Grid-Layout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\GridLayoutRepository
     * @inject
     */
    protected $gridLayoutRepository;

    /**
     * Backend-Layout Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\BackendLayoutRepository
     * @inject
     */
    protected $backendLayoutRepository;

    /**
     * Pages Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\PagesRepository
     * @inject
     */
    protected $pagesRepository;

    /**
     * Persistence-manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * Object-Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Meldungen
     *
     * @var string
     */
    protected $messages = '';
    
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
        $createdSomething=FALSE;
        
        
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
                    $createdSomething = TRUE;
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
