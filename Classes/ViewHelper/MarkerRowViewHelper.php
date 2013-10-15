<?php
namespace CodingMs\Ftm\ViewHelper;

/**
 * Shows one Marker row
 *
 * @package    TYPO3
 * @subpackage ftm
 * @author     Thomas Deuling <typo3@coding.ms>
 * @since      1.0.0
 */
class MarkerRowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Marker Row
     *
     * @param  \CodingMs\Ftm\Domain\Model\Template $fluidTemplate
     * @param  \CodingMs\Ftm\Domain\Model\TemplateMarker $marker
     * @author Thomas Deuling <typo3@coding.ms>
     * @return HTML
     * @since  1.0.0
     */
    public function render(\CodingMs\Ftm\Domain\Model\Template $fluidTemplate, \CodingMs\Ftm\Domain\Model\TemplateMarker $marker) {
            
        $tableCells = array();
        $returnHtml = '';
                
                
        // Marker-Daten
        $markerType = $marker->getMarkerType();
        $markerName = $marker->getMarkerName();
        $markerDesc = $marker->getMarkerDescription();
        $imagePath  = "/typo3conf/ext/ftm/Resources/Public/Icons/";
        
        
        // TS-Icon
        $tableCells[] = "<a><img src=\"/typo3conf/ext/ftm/Resources/Public/Icons/marker.png\"></a>";

        
        // Marker-Name
        $tableCells[] = "lib.".$markerName;
        
        
        // Marker-Typ
        $tableCells[] = $markerType;
        
        
        // Marker-Description
        $tableCells[] = $markerDesc;
   
      
        // Link im neuen Fenster oeffnen
        $actions = array();
        
        $title = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_ftm_viewhelper_be_markerrowviewhelper.edit_marker", "Ftm"); //Marker bearbeiten
        $icon  = 'actions-document-open';
        $actions[] = "<a href=\"#\" onclick=\"window.location.href='alt_doc.php?returnUrl='+T3_THIS_LOCATION+'&amp;edit[tx_ftm_domain_model_templatemarker][".$marker->getUid()."]=edit'; return false;\">".\TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon($icon, array('title' => $title))."</a>";
        
        // Actions
        $tableCells[] = implode("&nbsp;", $actions);
        
   
        
        
        return '<td>'.implode('</td><td>', $tableCells).'</td>';
    }

}
?>