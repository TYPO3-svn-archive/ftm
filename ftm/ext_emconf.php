<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "ftm".
 *
 * Auto generated 16-04-2013 17:23
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'FTM - Fluid Template Manager',
	'description' => 'FTM - Fluid Template Manager. Dokumentation: http://www.fluid-template-manager.de/',
	'category' => 'Backend Modules',
	'author' => 'Thomas Deuling - typo3@coding.ms',
	'author_email' => 'typo3@coding.ms',
	'author_company' => 'coding.ms - www.coding.ms',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'version' => '2.0.0',
	'constraints' => array(
		'depends' => array(
			'extbase' => '6.0',
			'fluid' => '6.0',
			'typo3' => '6.0',
            'belayout_fileprovider' => '0.0.1',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>
