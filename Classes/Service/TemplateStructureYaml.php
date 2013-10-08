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
 * Managed alle Aktionen rund um YAML-Datensaetze
 *
 * @package ftm
 * @subpackage Service
 */
class TemplateStructureYaml extends TemplateStructure {

    /**
     * Benoetigte Grid-Layouts
     * @var array
     * @since 1.0.0
     */
    protected $gridLayouts = array(
        'GridLayout 100' => array(
            'sorting'        => '256', 
            'title'          => 'GridLayout 100', 
            'description'    => 'GridLayout-100', 
            'config'         => 'backend_layout {\r\n   colCount = 1\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = box-content\r\n                  colPos = 10\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_100.jpg'
        ),
        'GridLayout 80-20' => array(
            'sorting'        => '512', 
            'title'          => 'GridLayout 80-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 4\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_80-20.jpg'
        ),
        'GridLayout 75-25' => array(
            'sorting'        => '640', 
            'title'          => 'GridLayout 75-25', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 3\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_75-25.jpg'
        ),
        'GridLayout 66-33' => array(
            'sorting'        => '768', 
            'title'          => 'GridLayout 66-33', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 3\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_66-33.jpg'
        ),
        'GridLayout 62-38' => array(
            'sorting'        => '1024', 
            'title'          => 'GridLayout 62-38', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 3\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_62-38.jpg'
        ),
        'GridLayout 60-40' => array(
            'sorting'        => '1280', 
            'title'          => 'GridLayout 60-40', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 3\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_60-40.jpg'
        ),
        'GridLayout 50-50' => array(
            'sorting'        => '1536', 
            'title'          => 'GridLayout 50-50', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 2\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_50-50.jpg'
        ),
        'GridLayout 40-60' => array(
            'sorting'        => '1664', 
            'title'          => 'GridLayout 40-60', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 2\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 3\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_40-60.jpg'
        ),
        'GridLayout 38-62' => array(
            'sorting'        => '1792', 
            'title'          => 'GridLayout 38-62', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 2\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 3\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_38-62.jpg'
        ),
        'GridLayout 33-66' => array(
            'sorting'        => '1920', 
            'title'          => 'GridLayout 33-66', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 3\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_33-66.jpg'
        ),
        'GridLayout 25-75' => array(
            'sorting'        => '2048', 
            'title'          => 'GridLayout 25-75', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 3\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_25-75.jpg'
        ),
        'GridLayout 20-80' => array(
            'sorting'        => '2944', 
            'title'          => 'GridLayout 20-80', 
            'description'    => 'GridLayout-20-80', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Rechts\r\n                   colspan = 4\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-80.jpg'
        ),
        'GridLayout 33-33-33' => array(
            'sorting'        => '5856', 
            'title'          => 'GridLayout 33-33-33', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 3\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_33-33-33.jpg'
        ),
        'GridLayout 40-40-20' => array(
            'sorting'        => '5120', 
            'title'          => 'GridLayout 40-40-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 2\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colspan = 2\r\n                 colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_40-40-20.jpg'
        ),
        'GridLayout 40-20-40' => array(
            'sorting'        => '5376', 
            'title'          => 'GridLayout 40-20-40', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 2\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_40-20-40.jpg'
        ),
        'GridLayout 20-40-40' => array(
            'sorting'        => '6162', 
            'title'          => 'GridLayout 20-40-40', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colspan = 2\r\n                 colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-40-40.jpg'
        ),
        'GridLayout 60-20-20' => array(
            'sorting'        => '4352', 
            'title'          => 'GridLayout 60-20-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 3\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_60-20-20.jpg'
        ),
        'GridLayout 20-60-20' => array(
            'sorting'        => '6156', 
            'title'          => 'GridLayout 20-60-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colspan = 3\r\n                 colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-60-20.jpg'
        ),
        'GridLayout 20-20-60' => array(
            'sorting'        => '6168', 
            'title'          => 'GridLayout 20-20-60', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colspan = 3\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-20-60.jpg'
        ),
        'GridLayout 50-25-25' => array(
            'sorting'        => '4864', 
            'title'          => 'GridLayout 50-25-25', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 2\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_50-25-25.jpg'
        ),
        'GridLayout 25-50-25' => array(
            'sorting'        => '5904', 
            'title'          => 'GridLayout 25-50-25', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colspan = 2\r\n                 colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_25-50-25.jpg'
        ),
        'GridLayout 25-25-50' => array(
            'sorting'        => '5952', 
            'title'          => 'GridLayout 25-25-50', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               3 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_25-25-50.jpg'
        ),
        'GridLayout 25-25-25-25' => array(
            'sorting'        => '6192', 
            'title'          => 'GridLayout 25-25-25-25', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 4\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Halblinks\r\n                    colPos = 12\r\n             }\r\n               3 {\r\n                 name = Halbrechts\r\n                   colPos = 14\r\n             }\r\n               4 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_25-25-25-25.jpg'
        ),
        'GridLayout 40-20-20-20' => array(
            'sorting'        => '6180', 
            'title'          => 'GridLayout 40-20-20-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colspan = 2\r\n                 colPos = 11\r\n             }\r\n               2 {\r\n                 name = Halblinks\r\n                    colPos = 12\r\n             }\r\n               3 {\r\n                 name = Halbrechts\r\n                   colPos = 14\r\n             }\r\n               4 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_40-20-20-20.jpg'
        ),
        'GridLayout 20-40-20-20' => array(
            'sorting'        => '6360', 
            'title'          => 'GridLayout 20-40-20-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Halblinks\r\n                    colspan = 2\r\n                 colPos = 12\r\n             }\r\n               3 {\r\n                 name = Halbrechts\r\n                   colPos = 14\r\n             }\r\n               4 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-40-20-20.jpg'
        ),
        'GridLayout 20-20-40-20' => array(
            'sorting'        => '6400', 
            'title'          => 'GridLayout 20-20-40-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Halblinks\r\n                    colPos = 12\r\n             }\r\n               3 {\r\n                 name = Halbrechts\r\n                   colspan = 2\r\n                 colPos = 14\r\n             }\r\n               4 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-20-40-20.jpg'
        ),
        'GridLayout 20-20-20-40' => array(
            'sorting'        => '7424', 
            'title'          => 'GridLayout 20-20-20-40', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Halblinks\r\n                    colPos = 12\r\n             }\r\n               3 {\r\n                 name = Halbrechts\r\n                   colPos = 14\r\n             }\r\n               4 {\r\n                 name = Rechts\r\n                   colspan = 2\r\n                 colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-20-20-40.jpg'
        ),
        'GridLayout 20-20-20-20-20' => array(
            'sorting'        => '7680', 
            'title'          => 'GridLayout 20-20-20-20-20', 
            'description'    => '', 
            'config'         => 'backend_layout {\r\n   colCount = 5\r\n    rowCount = 1\r\n    rows {\r\n      1 {\r\n         columns {\r\n               1 {\r\n                 name = Links\r\n                    colPos = 11\r\n             }\r\n               2 {\r\n                 name = Halblinks\r\n                    colPos = 12\r\n             }\r\n               3 {\r\n                 name = Mitte\r\n                    colPos = 13\r\n             }\r\n               4 {\r\n                 name = Halbrechts\r\n                   colPos = 14\r\n             }\r\n               5 {\r\n                 name = Rechts\r\n                   colPos = 15\r\n             }\r\n           }\r\n       }\r\n   }\r\n}\r\n', 
            'pi_flexform_ds' => 'FILE:typo3conf/ext/ftm/res/template/ext/gridelements/flexFormTyaml.xml', 
            'icon'           => 'GridLayout_20-20-20-20-20.jpg'
        )
    );
    

    
    /**
     * Prueft alles was Richtung YAML abweicht
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @since      22.11.2013
     * 
     * @return mixed boolean wenn alles aktuell ist, ansonsten die Meldungens
     */
    public function checkStructure($pid, $fluidTemplate) {
        
        parent::checkStructure($pid, $fluidTemplate);
        
    }
    
}

?>
