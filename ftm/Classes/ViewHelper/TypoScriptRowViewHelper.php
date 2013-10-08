<?php
namespace CodingMs\Ftm\ViewHelper;

/**
 * Shows one TypoScript row
 *
 * @package    TYPO3
 * @subpackage ftm
 * @author     Thomas Deuling <typo3@coding.ms>
 * @since      1.0.0
 */
class TypoScriptRowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * TypoScript Row
     *
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  string $typoScriptFile
     * @author Thomas Deuling <typo3@coding.ms>
     * @return HTML
     * @since  1.0.0
     */
    public function render(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, $typoScriptFile) {
        
        
        // Vars
        $md5Hash    = "none";
        $generic    = false;
        $tableCells = array();
        $returnHtml = "";
        
        
        // Pruefen: Ist es eine generierte Datei
        // -> Wenn ja, ermittle den MD5-Hash um zu
        // pruefen ob die Datei erneuert werden muss
        if($typoScriptFile=="setup.ts" || $typoScriptFile=="constants.ts" || $typoScriptFile=="tsConfig.ts") {
            $generic = true;
            
            if($typoScriptFile=="setup.ts") {
                $md5Hash = $fluidTemplate->getMd5HashSetupTs();
            }
            else if($typoScriptFile=="constants.ts") {
                $md5Hash = $fluidTemplate->getMd5HashConstantsTs();
            }
            else {
                $md5Hash = $fluidTemplate->getMd5HashTsConfig();
            }
        }
        
        
        // Dateiname und Pfad
        $filepath  = \CodingMs\Ftm\Utility\Tools::getDirectory("TypoScript", $fluidTemplate->getTemplateDir());
        $relPath   = $filepath.$typoScriptFile;
        $absPath   = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        $imagePath = \CodingMs\Ftm\Utility\Tools::getDirectory("Icons", "ftm");
        $md5Data   = $fluidTemplate->getMd5HashTemplateData();
        
        // TS-Icon
        $tableCells[] = "<a><img src=\"/".$imagePath."ts.png\"></a>";
        
        
        // TS-File
        $tableCells[] = "<a title=\"".$absPath."\">".$typoScriptFile."</a>";
        
        
        // Datei existiert?
        if(file_exists($absPath)) {
            
            
            // Status einsetzen
            if($md5Hash!="none" && $md5Data!=$md5Hash) {
                $tableCells[] = "<span style=\"color: orange\" title=\"".$md5Data."/Data!=File/".$md5Hash."\">" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_typoscriptrowviewhelper.file_exists_and_not_up_to_date", "Ftm") . "</span>";
            }
            else {
                $tableCells[] = "<span style=\"color: green\">" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_typoscriptrowviewhelper.file_exists", "Ftm") . "</span>";
            }
            
            
            // Refresh-Link erstellen
            $uriBuilder = $this->controllerContext->getUriBuilder();
            $arg = array('tx_ftm_web_ftmftm' => array(
                'typoScriptFile'    => $typoScriptFile
                )
            );
            
            $tsRefreshUri = $uriBuilder->reset()
                          ->setCreateAbsoluteUri(true)
                          ->setArguments($arg)
                          ->uriFor("generateTypoScript", array(), "TemplateManager");
            
            
            // Link im neuen Fenster oeffnen
            $actions = array();
            $actions[] = "<a href=\"/".$relPath."\"     title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_typoscriptrowviewhelper.download_typoscript", "Ftm", array($typoScriptFile)) . "\" target=\"_blank\" ><img src=\"/".$imagePath."ts_download.png\"></a>";
            
            
            // Generierte Datei nicht bearbeiten duerfen
            if($generic) {
                // $actions[] = "<a href=\"".$tsRefreshUri."\" title=\"TypoScript (".$typoScriptFile.") re/generieren\"><img src=\"".$imagePath."ts_refresh.png\"></a>";
                $actions[] = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('empty-empty');
            }
            // Custom-Datei bearbeiten duerfen
            else {
                
                // File-Object erstellen
                $fileObject = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->retrieveFileOrFolderObject($relPath);
                $fullIdentifier = $fileObject->getCombinedIdentifier();
                // Pruefen ob man bearbeiten darf
                // if (is_a($fileObject, 'TYPO3\\CMS\\Core\\Resource\\File') && $fileObject->checkActionPermission('edit') && \TYPO3\CMS\Core\Utility\GeneralUtility::inList($GLOBALS['TYPO3_CONF_VARS']['SYS']['textfile_ext'], $fileObject->getExtension())) {
                if(1) {
                    $editOnClick = 'top.content.list_frame.location.href=top.TS.PATH_typo3+\'file_edit.php?target=' . rawurlencode($fullIdentifier) . '&returnUrl=\'+top.rawurlencode(top.content.list_frame.document.location.pathname+top.content.list_frame.document.location.search);return false;';
                    $actions['edit'] = '<a href="#" onclick="' . $editOnClick . '" title="' . $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.xlf:cm.edit') . '">' . \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-page-open') . '</a>';
                } else {
                    $actions['edit'] = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('empty-empty');
                }
                
            }
            
            // Actions
            $tableCells[] = implode("&nbsp;", $actions);
        }
        else {
            // Fuer den unwahrscheinlichen Fall
            // das die Datei nicht existiert
            $message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_typoscriptrowviewhelper.file_not_found", "Ftm", array($typoScriptFile));
            $tableCells[] = "<span style=\"color: red\">".$message."</span>";
        }
        
        
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>