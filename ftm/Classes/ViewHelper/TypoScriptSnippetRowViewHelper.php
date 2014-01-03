<?php
namespace CodingMs\Ftm\ViewHelper;

/**
 * Shows one TypoScriptSnippet row
 *
 * @package    TYPO3
 * @subpackage ftm
 * @author     Thomas Deuling <typo3@coding.ms>
 * @since      1.0.0
 */
class TypoScriptSnippetRowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * TypoScriptSnippet Row
     *
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  \CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $snippet
     * @author Thomas Deuling <typo3@coding.ms>
     * @return HTML
     * @since  1.0.0
     */
    public function render(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, \CodingMs\Ftm\Domain\Model\TemplateTypoScriptSnippet $snippet) {
            
        $tableCells = array();
        $returnHtml = '';
                
                
        // Snippet-Daten
        $snippetType = $snippet->getType();
        $snippetName = $snippet->getName();
        $snippetDesc = substr(html_entity_decode(strip_tags($snippet->getDescription())), 0, 40);
        if(strlen($snippetDesc)==40) {
            $snippetDesc.= '...';
        }
        $imagePath  = "/typo3conf/ext/ftm/Resources/Public/Icons/";
        
        
        // TS-Icon
        $tableCells[] = "<a><img src=\"/typo3conf/ext/ftm/Resources/Public/Icons/typoscript_snippet.png\"></a>";

        
        // Snippet-Name
        $tableCells[] = $snippetName;
        
        
        // Snippet-Typ
        $tableCells[] = $snippetType;
        
        
        // Snippet-Description
        $tableCells[] = $snippetDesc;
   
      
        // Link im neuen Fenster oeffnen
        $actions = array();
        
        $title = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_typoscriptsnippetrowviewhelper.edit_typoscript_snippet", "Ftm");
        $icon  = 'actions-document-open';
        
        
        $editOnClick = \TYPO3\CMS\Backend\Utility\BackendUtility::editOnClick("&edit[tx_ftm_domain_model_templatetyposcriptsnippet][".$snippet->getUid()."]=edit");
        
        
        $actions[] = "<a href=\"#\" onclick=\"".$editOnClick."\">".\TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon($icon, array('title' => $title))."</a>";
        
        // Actions
        $tableCells[] = implode("&nbsp;", $actions);
        
   
        
        
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>