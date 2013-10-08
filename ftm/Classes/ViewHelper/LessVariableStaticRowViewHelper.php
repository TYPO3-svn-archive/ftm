<?php
namespace CodingMs\Ftm\ViewHelper;

/**
 * Shows one Less-Variable row
 *
 * @package    TYPO3
 * @subpackage ftm
 * @author     Thomas Deuling <typo3@coding.ms>
 * @since      1.0.0
 */
class LessVariableStaticRowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Less-Variable Row
     *
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  string $lessVariableStatic
     * @author Thomas Deuling <typo3@coding.ms>
     * @return HTML
     * @since  1.0.0
     */
    public function render(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, $lessVariableName='') {
            
        $tableCells = array();
        $returnHtml = "";
                
                
        // Dateiname und Pfad
        $imagePath    = "/typo3conf/ext/ftm/Resources/Public/Icons/";
        
        
        // TS-Icon
        $tableCells[] = "<a><img src=\"/typo3conf/ext/ftm/Resources/Public/Icons/lessVariable.png\"></a>";

        
       
        if($lessVariableName=='baseUrl') {

            // Less-Variable Type
            $tableCells[] = "string";
            
            // Less-Variable Name
            $tableCells[] = "<a title=\"@".$lessVariableName."\">@".$lessVariableName."</a>";            

            // Less-Variablen Wert
            $tableCells[] = $fluidTemplate->getConfig()->getBaseURL();
        
            // Less-Variable Title/Info
            $tableCells[] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_lessvariablestaticrowviewhelper.col_base_url_as_string", "Ftm"); //Base-URL als String (automatisch generiert)
            
        }
        else if($lessVariableName=='baseUrlTemplate') {
            
            // Less-Variable Type
            $tableCells[] = "string";
            
            // Less-Variable Name
            $tableCells[] = "<a title=\"@".$lessVariableName."\">@".$lessVariableName."</a>";   
            
            // Less-Variablen Wert
            $tableCells[] = $fluidTemplate->getConfig()->getBaseUrl()."typo3conf/ext/".$fluidTemplate->getTemplateDir()."/";
        
            // Less-Variable Title/Info
            $tableCells[] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_lessvariablestaticrowviewhelper.col_path_to_template_files", "Ftm"); //Pfad zum den Template-Dateien (automatisch generiert)
            
        }
        else if($lessVariableName=='templateDir') {
            
            // Less-Variable Type
            $tableCells[] = "string";
            
            // Less-Variable Name
            $tableCells[] = "<a title=\"@".$lessVariableName."\">@".$lessVariableName."</a>";   
            
            // Less-Variablen Wert
            $tableCells[] = $fluidTemplate->getTemplateDir();
        
            // Less-Variable Title/Info
            $tableCells[] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_lessvariablestaticrowviewhelper.col_dir_name", "Ftm"); //Verzeichnis-Name im Template-Verzeichnis (automatisch generiert)
            
        }
        
       
        
        
        
        // Refresh-Link erstellen
        $uriBuilder = $this->controllerContext->getUriBuilder();
        $lessRefreshUri = $uriBuilder->reset()
                      ->setCreateAbsoluteUri(true)
                      ->uriFor("generateLessVariable", array(), "TemplateManager");
        
        
        // Link im neuen Fenster oeffnen
        $actions = array();
        // $actions[] = "<a href=\"#\" onclick=\"window.location.href='alt_doc.php?returnUrl='+T3_THIS_LOCATION+'&amp;edit[tx_ftm_domain_model_templatelessvariable][".$lessVariable->getUid()."]=edit'; return false;\" title=\"Template bearbeiten\"><img src=\"".$imagePath."lessVariable_edit.png\"></a>";
        // $actions[] = "<a href=\"/".$relPath."\"        title=\"Fluid-".ucfirst($templateType)." (".$filename.") herunterladen\" target=\"_blank\" ><img src=\"".$imagePath."fluid_download.png\"></a>";
        //  $actions[] = "<a href=\"".$lessRefreshUri."\" title=\"Less-Variablen re/generieren\"><img src=\"".$imagePath."lessVariable_refresh.png\"></a>";
        // $actions[] = "<a href=\"/".$relPath."\"        title=\"Fluid-".ucfirst($templateType)." (".$filename.") Informationen\" target=\"_blank\"><img src=\"".$imagePath."fluid_information.png\"></a>";
        
        // Actions
        $tableCells[] = implode("&nbsp;", $actions);
        
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>