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
class LessVariableRowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Less-Variable Row
     *
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  \CodingMs\Ftm\Domain\Model\TemplateLessVariable $lessVariable
     * @dontvalidate $lessVariable
     * 
     * @param  string $lessVariableStatic
     * @author Thomas Deuling <typo3@coding.ms>
     * @return HTML
     * @since  1.0.0
     */
    public function render(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, \CodingMs\Ftm\Domain\Model\TemplateLessVariable $lessVariable, $lessVariableStatic='') {
            
        $tableCells = array();
        $returnHtml = "";
                
                
        // Dateiname und Pfad
        $variableType = $lessVariable->getVariableType();
        $variableName = $lessVariable->getVariableName();
        $imagePath    = "/typo3conf/ext/ftm/Resources/Public/Icons/";
        
        
        // TS-Icon
        $tableCells[] = "<a><img src=\"/typo3conf/ext/ftm/Resources/Public/Icons/lessVariable.png\"></a>";

        
        // Less-Variable Type
        $tableCells[] = $variableType;
        
        
        // Less-Variable Name
        $tableCells[] = "<a title=\"@".$lessVariable->getVariableName()."\">@".$lessVariable->getVariableName()."</a>";
        
        
        // Less-Variable Wert
        if($variableType=='color') {
            $tableCells[] = $lessVariable->getVariableColorSquare().' '.$lessVariable->getVariableColor();
                       
        }
        else if($variableType=='value')  {
            $tableCells[] = $lessVariable->getVariableValue();
        }
        else {
            $tableCells[] = $lessVariable->getVariableString();
        }
        
        
        // Less-Variable Title/Info
        $tableCells[] = $lessVariable->getVariableTitle();
        
        
        // Refresh-Link erstellen
        $uriBuilder = $this->controllerContext->getUriBuilder();
        $lessRefreshUri = $uriBuilder->reset()
                      ->setCreateAbsoluteUri(true)
                      ->uriFor("generateLessVariable", array(), "TemplateManager");
        
        
        // Link im neuen Fenster oeffnen
        $actions = array();
        $actions[] = "<a href=\"#\" onclick=\"window.location.href='alt_doc.php?returnUrl='+T3_THIS_LOCATION+'&amp;edit[tx_ftm_domain_model_templatelessvariable][".$lessVariable->getUid()."]=edit'; return false;\" title=\"" . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_lessvariablerowviewhelper.edit_template", "Ftm") . "\"><img src=\"".$imagePath."lessVariable_edit.png\"></a>";
        // $actions[] = "<a href=\"/".$relPath."\"        title=\"Fluid-".ucfirst($templateType)." (".$filename.") herunterladen\" target=\"_blank\" ><img src=\"".$imagePath."fluid_download.png\"></a>";
        $actions[] = "<a href=\"".$lessRefreshUri."\" title=\"Less-Variablen re/generieren\"><img src=\"".$imagePath."lessVariable_refresh.png\"></a>";
        // $actions[] = "<a href=\"/".$relPath."\"        title=\"Fluid-".ucfirst($templateType)." (".$filename.") Informationen\" target=\"_blank\"><img src=\"".$imagePath."fluid_information.png\"></a>";
        
        // Actions
        $tableCells[] = implode("&nbsp;", $actions);
        
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>