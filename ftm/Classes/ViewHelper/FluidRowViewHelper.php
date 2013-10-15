<?php
namespace CodingMs\Ftm\ViewHelper;

/**
 * Shows one Fluid-Template row
 *
 * @package    TYPO3
 * @subpackage ftm
 * @author     Thomas Deuling <typo3@coding.ms>
 * @since      1.0.0
 */
class FluidRowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Fluid-Template/Layout/Partial Row
     *
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  \CodingMs\Ftm\Domain\Model\TemplateFluid $template
     * @author Thomas Deuling <typo3@coding.ms>
     * @return HTML
     * @since  1.0.0
     */
    public function render(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, \CodingMs\Ftm\Domain\Model\TemplateFluid $template) {
            
        $tableCells = array();
        $returnHtml = '';
                
                
        // Dateiname und Pfad
        $templateType = $template->getTemplateType();
        $templateFile = $template->getTemplateFile();
        $filepath     = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $fluidTemplate->getTemplateDir()).ucfirst($templateType)."s/";
        $filename     = $templateFile.".html";
        $relPath      = $filepath.$filename;
        $absPath      = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($relPath);
        $imagePath    = \CodingMs\Ftm\Utility\Tools::getDirectory("Icons", "ftm");
        
        
        // Spalte: TS-Icon
        $tableCells[] = "<a><img src=\"/".$imagePath."fluid.png\"></a>";

        
        // Spalte: Template-Typ
        $tableCells[] = $templateType;
        
        
        // Spalte: Template-File
        $tableCells[] = "<a title=\"".$absPath."\">".$filename."</a>";
        
        
        // Wenn die Datei existiert:
        // -------------------------------------------------
        if(file_exists($absPath)) {
            
            
            /**
             * Spalte: Backend-Layout
             * 
             * Pruefen ob im Template auch ein 
             * Backend-Layout zugewiesen ist
             * 
             * @var \CodingMs\Ftm\Domain\Model\BackendLayout
             */
            $backendLayout = $template->getBackendLayout();
            
            if($templateType=='template' && !($backendLayout instanceof \CodingMs\Ftm\Domain\Model\BackendLayout)) {
                $tableCells[] = "<span style=\"color: red\">" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.no_backend_layout_linked", "Ftm") . "</span>";
            }
            else if($templateType=='template') {
                $backendLayoutEditLink = "<a href=\"#\" onclick=\"window.location.href='alt_doc.php?returnUrl='+T3_THIS_LOCATION+'&amp;edit[backend_layout][".$backendLayout->getUid()."]=edit'; return false;\" title=\"" .\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.edit_backend_layout", "Ftm") . "\"><img src=\"/".$imagePath."edit.png\"></a>";
                $tableCells[] = $backendLayoutEditLink.' '.$backendLayout->getTitle();
            }
            else {
                $tableCells[] = '&nbsp;';
            }
            // ---------------------------------------------
            
            
            // Spalte: Info
            // Ist Datei und Datensatz-Code identisch!?
            // ---------------------------------------------
            $fileContent = file_get_contents($absPath);
            if($fileContent==$template->getTemplateCode()) {
                $message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.file_exists_and_up_to_date", "Ftm"); //File exists and is up-to-date
                $tableCells[] = "<span style=\"color: green\">".$message."</span>";
            }
            else {
                $message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.file_exists_and_not_up_to_date", "Ftm"); //File exists but isn't up-to-date
                $tableCells[] = "<span style=\"color: orange\">".$message."</span>";
            }
            // ---------------------------------------------
            
           
            // FileToDb/DbToFile-Link erstellen
            $uriBuilder = $this->controllerContext->getUriBuilder();
            $arg = array('tx_ftm_web_ftmftm' => array(
                'templateFile' => $templateFile,
                'templateType' => $templateType
                )
            );
            $fluidFileToDbUri = $uriBuilder->reset()
                              ->setCreateAbsoluteUri(true)
                              ->setArguments($arg)
                              ->uriFor("generateFluid", array("copy"=>"fileToDb"), "TemplateManager");
            $fluidDbToFileUri = $uriBuilder->reset()
                              ->setCreateAbsoluteUri(true)
                              ->setArguments($arg)
                              ->uriFor("generateFluid", array("copy"=>"dbToFile"), "TemplateManager");
            
            
            // Actions sammeln
            // ---------------------------------------------
            $actions = array();
            
            // Template-Datensatz bearbeiten
            // -----------------------------
            $actions[] = "<a href=\"#\" onclick=\"window.location.href='alt_doc.php?returnUrl='+T3_THIS_LOCATION+'&amp;edit[tx_ftm_domain_model_templatefluid][".$template->getUid()."]=edit'; return false;\" title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.edit_template_record", "Ftm") . "\"><img src=\"/".$imagePath."fluid_edit.png\"></a>";
            
            
            // Template-Datei bearbeiten
            // -----------------------------
            // File-Object erstellen
            $fileObject = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->retrieveFileOrFolderObject($relPath);
            $fullIdentifier = $fileObject->getCombinedIdentifier();
            // Pruefen ob man bearbeiten darf
            // if (is_a($fileObject, 'TYPO3\\CMS\\Core\\Resource\\File') && $fileObject->checkActionPermission('edit') && \TYPO3\CMS\Core\Utility\GeneralUtility::inList($GLOBALS['TYPO3_CONF_VARS']['SYS']['textfile_ext'], $fileObject->getExtension())) {
            if(1) {
                $editOnClick = 'top.content.list_frame.location.href=top.TS.PATH_typo3+\'file_edit.php?target=' . rawurlencode($fullIdentifier) . '&returnUrl=\'+top.rawurlencode(top.content.list_frame.document.location.pathname+top.content.list_frame.document.location.search);return false;';
                $actions['edit'] = '<a href="#" onclick="' . $editOnClick . '" title="' . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.edit_template_file", "Ftm") .'">' . \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-page-open') . '</a>';
            }
            
            // FileToDb/DbToFile verschieben
            // -----------------------------
            $actions[] = "<a href=\"".$fluidDbToFileUri."\" title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.write_template_record_to_file", "Ftm", array(ucfirst($templateType), $filename)) . "\"><img src=\"/".$imagePath."fluid_db_to_file.png\"></a>";
            $actions[] = "<a href=\"".$fluidFileToDbUri."\" title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.write_template_file_to_record", "Ftm", array(ucfirst($templateType), $filename)) . "\"><img src=\"/".$imagePath."fluid_file_to_db.png\"></a>";
            
            
            // Actions
            $tableCells[] = "<nobr>".implode("&nbsp;", $actions)."&nbsp;</nobr>";
            
        }

        // Wenn die Datei nicht existiert:
        // -------------------------------------------------
        else {
            
            // Spalte: Backend-Layout
            $tableCells[] = '&nbsp;';
            
            // Spalte Info: Status einsetzen
            $message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.file_not_exists", "Ftm");
            $tableCells[] = "<span style=\"color: red\">".$message."</span>";
            
            
            // Refresh-Link erstellen
            $uriBuilder = $this->controllerContext->getUriBuilder();
            $arg = array('tx_ftm_web_ftmftm' => array(
                'templateFile' => $templateFile,
                'templateType' => $templateType
                )
            );
            
            $fluidRefreshUri = $uriBuilder->reset()
                          ->setCreateAbsoluteUri(true)
                          ->setArguments($arg)
                          ->uriFor("generateFluid", array(), "TemplateManager");
            
            
            // Link im neuen Fenster oeffnen
            $actions = array();
            $actions[] = "<a><img src=\"/".$imagePath."empty.png\"></a>";
            $actions[] = "<a><img src=\"/".$imagePath."empty.png\"></a>";
            $actions[] = "<a href=\"".$fluidRefreshUri."\" title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_fluidrowviewhelper.generate_file", "Ftm", array(ucfirst($templateType), $filename)) . "\"><img src=\"/".$imagePath."fluid_refresh.png\"></a>";
            $actions[] = "<a><img src=\"/".$imagePath."empty.png\"></a>";
            
            // Spalte Actions
            $tableCells[] = implode("&nbsp;", $actions);
            
        }
        
        // Spalten zusammensetzen und zurueckgeben
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>