<?php

$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('ftm');
$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('ftm').'Classes/';
return array(

    // Controller
    'CodingMs\Ftm\TemplateManagerController' => $extensionClassesPath.'Controller/TemplateManagerController.php',
    
    // Models
    'CodingMs\Ftm\Domain\Model\Template'               => $extensionClassesPath.'Domain/Model/Template.php',
    'CodingMs\Ftm\Domain\Model\TemplateConfig'         => $extensionClassesPath.'Domain/Model/TemplateConfig.php',
    'CodingMs\Ftm\Domain\Model\TemplateLanguage'       => $extensionClassesPath.'Domain/Model/TemplateLanguage.php',
    'CodingMs\Ftm\Domain\Model\TemplateMeta'           => $extensionClassesPath.'Domain/Model/TemplateMeta.php',
    'CodingMs\Ftm\Domain\Model\TemplateFluid'          => $extensionClassesPath.'Domain/Model/TemplateFluid.php',
    'CodingMs\Ftm\Domain\Model\TemplateMarker'         => $extensionClassesPath.'Domain/Model/TemplateMarker.php',
    'CodingMs\Ftm\Domain\Model\TemplateLessVariable'   => $extensionClassesPath.'Domain/Model/TemplateLessVariable.php',
    
    'CodingMs\Ftm\Domain\Model\TemplateMenuContainer'  => $extensionClassesPath.'Domain/Model/TemplateMenuContainer.php',
    'CodingMs\Ftm\Domain\Model\TemplateMenuObject'     => $extensionClassesPath.'Domain/Model/TemplateMenuObject.php',
    'CodingMs\Ftm\Domain\Model\TemplateMenuState'      => $extensionClassesPath.'Domain/Model/TemplateMenuState.php',
    
    'CodingMs\Ftm\Domain\Model\TemplateExt'            => $extensionClassesPath.'Domain/Model/TemplateExt.php',
    'CodingMs\Ftm\Domain\Model\TemplateExtT3Less'      => $extensionClassesPath.'Domain/Model/TemplateExtT3Less.php',
    'CodingMs\Ftm\Domain\Model\TemplateExtT3LessFiles' => $extensionClassesPath.'Domain/Model/TemplateExtT3LessFiles.php',
    
    'CodingMs\Ftm\Domain\Model\BackendLayout'          => $extensionClassesPath.'Domain/Model/BackendLayout.php',
    'CodingMs\Ftm\Domain\Model\GridLayout'             => $extensionClassesPath.'Domain/Model/GridLayout.php',
    'CodingMs\Ftm\Domain\Model\SysTemplate'            => $extensionClassesPath.'Domain/Model/SysTemplate.php',
    'CodingMs\Ftm\Domain\Model\FrontendUser'           => $extensionClassesPath.'Domain/Model/FrontendUser.php',
    'CodingMs\Ftm\Domain\Model\FrontendUserGroup'      => $extensionClassesPath.'Domain/Model/FrontendUserGroup.php',
    'CodingMs\Ftm\Domain\Model\TtAddress'              => $extensionClassesPath.'Domain/Model/TtAddress.php',
    'CodingMs\Ftm\Domain\Model\TtAddressGroup'         => $extensionClassesPath.'Domain/Model/TtAddressGroup.php',
    
    // Repositories
    'CodingMs\Ftm\Domain\Repository\TemplateRepository'       => $extensionClassesPath.'Domain/Repository/TemplateRepository.php',
    'CodingMs\Ftm\Domain\Repository\TemplateMarkerRepository' => $extensionClassesPath.'Domain/Repository/TemplateMarkerRepository.php',
    'CodingMs\Ftm\Domain\Repository\BackendLayoutRepository'  => $extensionClassesPath.'Domain/Repository/BackendLayoutRepository.php',
    'CodingMs\Ftm\Domain\Repository\GridLayoutRepository'     => $extensionClassesPath.'Domain/Repository/GridLayoutRepository.php',
    'CodingMs\Ftm\Domain\Repository\SysTemplateRepository'    => $extensionClassesPath.'Domain/Repository/SysTemplateRepository.php',
    'CodingMs\Ftm\Domain\Repository\FrontendUserRepository'      => $extensionClassesPath.'Domain/Repository/FrontendUserRepository.php',
    'CodingMs\Ftm\Domain\Repository\FrontendUserGroupRepository' => $extensionClassesPath.'Domain/Repository/FrontendUserGroupRepository.php',
    'CodingMs\Ftm\Domain\Repository\TtAddressRepository'         => $extensionClassesPath.'Domain/Repository/TtAddressRepository.php',
    
    // Session
    'CodingMs\Ftm\Domain\Session\SessionHandler'                 => $extensionClassesPath.'Domain/Session/SessionHandler.php',
    
    // Backend
    'CodingMs\Ftm\Backend\InformationRow'            => $extensionClassesPath.'Backend/InformationRow.php',
    'CodingMs\Ftm\Backend\ImageHoverEffectRow'       => $extensionClassesPath.'Backend/ImageHoverEffectRow.php',
    'CodingMs\Ftm\Backend\GridElementClassesRow'     => $extensionClassesPath.'Backend/GridElementClassesRow.php',
    
    // Hooks
    'CodingMs\Ftm\Hooks\CacheMenu'              => $extensionClassesPath.'Hooks/CacheMenu.php',
    
    // Services
    'CodingMs\Ftm\Service\PluginConnector'      => $extensionClassesPath.'Service/PluginConnector.php',
    'CodingMs\Ftm\Service\PluginService'        => $extensionClassesPath.'Service/PluginService.php',
    'CodingMs\Ftm\Service\TemplateDirectory'    => $extensionClassesPath.'Service/TemplateDirectory.php',
    'CodingMs\Ftm\Service\SysTemplate'          => $extensionClassesPath.'Service/SysTemplate.php',
    'CodingMs\Ftm\Service\Pages'                => $extensionClassesPath.'Service/Pages.php',
    'CodingMs\Ftm\Service\Fluid'                => $extensionClassesPath.'Service/Fluid.php',
    'CodingMs\Ftm\Service\TemplateStructure'          => $extensionClassesPath.'Service/TemplateStructure.php',
    'CodingMs\Ftm\Service\TemplateStructureYaml'      => $extensionClassesPath.'Service/TemplateStructureYaml.php',
    'CodingMs\Ftm\Service\TemplateStructureBootstrap' => $extensionClassesPath.'Service/TemplateStructureBootstrap.php',
    'CodingMs\Ftm\Service\ClearCache'           => $extensionClassesPath.'Service/ClearCache.php',
    'CodingMs\Ftm\Service\Backup'               => $extensionClassesPath.'Service/Backup.php',
    'CodingMs\Ftm\Service\TypoScript'           => $extensionClassesPath.'Service/TypoScript.php',
    
    // Utilities
    'CodingMs\Ftm\Utility\Tools'                => $extensionClassesPath.'Utility/Tools.php',
    'CodingMs\Ftm\Utility\Console'              => $extensionClassesPath.'Utility/Console.php',
    
    // ViewHelper
    'CodingMs\Ftm\ViewHelper\ContentViewHelper'          => $extensionClassesPath.'ViewHelper/ContentViewHelper.php',
    'CodingMs\Ftm\ViewHelper\RenderExternalViewHelper'   => $extensionClassesPath.'ViewHelper/RenderExternalViewHelper.php',
    'CodingMs\Ftm\ViewHelper\FluidRowViewHelper'         => $extensionClassesPath.'ViewHelper/FluidRowViewHelper.php',
    'CodingMs\Ftm\ViewHelper\MarkerRowViewHelper'        => $extensionClassesPath.'ViewHelper/MarkerRowViewHelper.php',
    'CodingMs\Ftm\ViewHelper\LessVariableRowViewHelper'  => $extensionClassesPath.'ViewHelper/LessVariableRowViewHelper.php',
    'CodingMs\Ftm\ViewHelper\LessVariableStaticRowViewHelper' => $extensionClassesPath.'ViewHelper/LessVariableStaticRowViewHelper.php',
    'CodingMs\Ftm\ViewHelper\Be\Buttons\IconViewHelper'       => $extensionClassesPath.'ViewHelper/Be/Buttons/IconViewHelper.php',
    
);
?>