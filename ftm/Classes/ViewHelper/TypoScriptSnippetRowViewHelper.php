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
        $uid     = $snippet->getUid();
        $nextUid = $snippet->getNextListUid();
        $prevUid = $snippet->getPreviousListUid();
        $table   = 'tx_ftm_domain_model_templatetyposcriptsnippet';
        $spaceIcon = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('empty-empty', array('style' => 'background-position: 0 10px;'));
        
        
        $title = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_typoscriptsnippetrowviewhelper.edit_typoscript_snippet", "Ftm");


        // Bearbeiten
        $editIcon = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-document-open');
        $editOnClick = \TYPO3\CMS\Backend\Utility\BackendUtility::editOnClick('&edit['.$table.']['.$uid.']=edit');
        $actions[] = '<a href="#" onclick="'.$editOnClick.'" title="'.$title.'">'.$editIcon.'</a>';
        
        
        // Move-Up
        if ($prevUid) {
            $params = '&cmd['.$table.']['.$prevUid.'][move]=-'.$uid;
            $moveUpIcon = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-move-up');
            $moveUpTitle = $GLOBALS['LANG']->getLL('moveUp', TRUE);
            $moveUpOnClick = htmlspecialchars(('return jumpToUrl(\''.$GLOBALS['SOBE']->doc->issueCommand($params, -1).'\');'));
            $actions['moveUp'] = '<a href="#" onclick="'.$moveUpOnClick.'" title="'.$moveUpTitle.'">'.$moveUpIcon.'</a>';
        } 
        else {
            $actions['moveUp'] = $spaceIcon;
        }

        // Move-Down
        if ($nextUid) {
            $params = '&cmd['.$table.']['.$uid.'][move]=-' . $nextUid;
            $moveDownIcon = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-move-down');
            $moveDownTitle = $GLOBALS['LANG']->getLL('moveDown', TRUE);
            $moveDownOnClick = htmlspecialchars(('return jumpToUrl(\''.$GLOBALS['SOBE']->doc->issueCommand($params, -1).'\');'));
            $actions['moveDown'] = '<a href="#" onclick="'.$moveDownOnClick.'" title="'.$moveDownTitle.'">'.$moveDownIcon.'</a>';
        } else {
            $actions['moveDown'] = $spaceIcon;
        }
        
        // "Hide/Unhide" links:
        // if ($snippet->getHidden()) {
            // $params = '&data[' . $table . '][' . $uid . '][hidden]=0';
            // $actions['hide'] = '<a href="#" onclick="' . htmlspecialchars(('return jumpToUrl(\'' . $GLOBALS['SOBE']->doc->issueCommand($params, -1) . '\');')) . '" title="' . $GLOBALS['LANG']->getLL(('unHide' . ($table == 'pages' ? 'Page' : '')), TRUE) . '">' . \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-edit-unhide') . '</a>';
        // } 
        // else {
            // $params = '&data[' . $table . '][' . $uid . '][hidden]=1';
            // $actions['hide'] = '<a href="#" onclick="' . htmlspecialchars(('return jumpToUrl(\'' . $GLOBALS['SOBE']->doc->issueCommand($params, -1) . '\');')) . '" title="' . $GLOBALS['LANG']->getLL(('hide' . ($table == 'pages' ? 'Page' : '')), TRUE) . '">' . \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-edit-hide') . '</a>';
        // }
        
        // Delete
        $titleOrig = $snippet->getName(); //\TYPO3\CMS\Backend\Utility\BackendUtility::getRecordTitle($table, $row, FALSE, TRUE);
        $title = \TYPO3\CMS\Core\Utility\GeneralUtility::slashJS(\TYPO3\CMS\Core\Utility\GeneralUtility::fixed_lgd_cs($titleOrig, 10), 1);
        $params = '&cmd['.$table.']['.$uid.'][delete]=1';
        
        // \TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList.php
        $refCount = 1; //$this->getReferenceCount($table, $uid);
        
        $refCountMsg = \TYPO3\CMS\Backend\Utility\BackendUtility::referenceCount(
            $table, 
            $uid, 
            (' ' . $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.xlf:labels.referencesToRecord')), 
            $refCount
        );
        $refCountMsg.= \TYPO3\CMS\Backend\Utility\BackendUtility::translationCount(
                $table, 
                $uid, 
                (' ' . $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.xlf:labels.translationsOfRecord')
            )
        );

        // Löschen-Icon/Link
        $deleteOnClickQuestion = $GLOBALS['LANG']->getLL('deleteWarning').' "'.$title.'" '.$refCountMsg;
        $deleteOnClickQuestion = $GLOBALS['LANG']->JScharCode($deleteOnClickQuestion);
        $deleteOnClick = htmlspecialchars(('if (confirm('.$deleteOnClickQuestion.')) {jumpToUrl(\''.$GLOBALS['SOBE']->doc->issueCommand($params, -1).'\');} return false;'));
        $deleteTitle = $GLOBALS['LANG']->getLL('delete', TRUE);
        $deleteIcon = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('actions-edit-delete');
        $actions['delete'] = '<a href="#" onclick="'.$deleteOnClick.'" title="'.$deleteTitle.'">'.$deleteIcon.'</a>';
                
        
        
        
        // Actions
        $tableCells[] = implode("&nbsp;", $actions);
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>