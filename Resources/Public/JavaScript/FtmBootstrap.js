/**type
 * FTM Bootstrap-Objekt
 * Thomas Deuling <typo3@Coding.ms>
 * 2013-10-05 - Muenster/Germany
 */

var FtmBootstrap = function() {

    var alertCount = 0;

    /**
     * Object initiieren
     */
    this.initialize = function() {
        
        
    };
    
    /**
     * Displays a Bootstrap Alert
     * 
     * Types: success, info, warning, danger
     */
    this.displayAlert = function(message, alertType) {
        
        if(typeof(alertType) == 'undefined') {
            alertType = "info";
        }
        
        alertCount++;
        $('#alerts').html($('#alerts').html()+'<div class="alert alert-'+alertType+'" id="alert-'+alertCount+'"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>');
        setTimeout('ftm_bootstrap.fadeOutAlert('+alertCount+')', 5000);
    };
    
    this.fadeOutAlert = function(alertNo) {
        $('#alert-'+alertNo).fadeOut(2000);
    };

};

// JavaScript-Objekt erstellen
var ftm_bootstrap = new FtmBootstrap();

$(document).ready(function() {
   ftm_bootstrap.initialize();
});