================================
Installation & Konfiguration
================================
`Fluid-Template-Manager.de <http://www.fluid-template-manager.de>`_ / `Dokumentation <http://www.fluid-template-manager.de/documentation>`_ / `Installation & Konfiguration <http://fluid-template-manager.de/documentation/Installation.html>`_


Hier finden Sie alle Informationen zur Installation und Konfiguration des FTM. 

Herunterladen können Sie den Fluid-Template-Manager im TER oder über die TYPO3-Seite:

`http://typo3.org/extensions/repository/view/ftm <http://typo3.org/extensions/repository/view/ftm>`_


--------------------------------------------------------------------
Installation
--------------------------------------------------------------------

.. note:: Dieser Abschnitt wird gerade überarbeitet.

.. TODO:
    @todo: Aus Wiki überführen
    
    
    


--------------------------------------------------------------------
TYPO3 Konfiguration
--------------------------------------------------------------------
Damit der FTM alle Funktionen voll nutzen kann, müssen Sie einige Einstellungen an der TYPO3-Konfiguration vornehmen.

~~~~~~~~~~~~~~~~~~~~~~~
Vererbbare Felder
~~~~~~~~~~~~~~~~~~~~~~~
.. include:: ./Snippets/LocalConfigurationAddRootLineFields.rst


~~~~~~~~~~~~~~~~~~~~~~~
Erlaubte Dateitypen
~~~~~~~~~~~~~~~~~~~~~~~
.. include:: ./Snippets/LocalConfigurationAllowedFiles.rst



--------------------------------------------------------------------
Konfiguration der Extension
--------------------------------------------------------------------
Über den Extension-Manager kann der FTM, wie auch jede andere Extension, konfiguriert werden.

.. include:: ./Snippets/TypoScriptWebServiceMessage.rst

.. TODO:
    @todo: Bild einsetzen

In diesem Bereich finden Sie die folgenden Einstellungen:

================================================================================================================= =================== ====================================================================================================================================================================================
Einstellung                                                                                                       Standardwert        Beschreibung                                            
================================================================================================================= =================== ====================================================================================================================================================================================
Host of the PluginCloud-Webservices [basic.pluginCloudHost]                                                       ``plugincloud.de``  Hier wird die URL des PluginCloud-WebServices angegeben

PluginCloud-Key [basic.pcKey]                                                                                     ``public``          Hier wird der PluginCloud-Key (auch Schlüssel genannt) angegeben.
                                                                                                                                      Standardmäßig wird ein offener Zugang (public) verwendet.
                                                                                                                                      Dies bedeutet aber nicht das das System offen oder ungeschützt ist, sondern lediglich das keine zusätzlichen Funktionen durch einen personalisierten Schlüssel zugeschaltet werden. 
PluginCloud-Username [basic.user]                                                                                 ``noUser``          Hier wird im Falle eines nicht public-Keys der Username eingetragen.
PluginCloud-Userpassword [basic.password]                                                                         ``noPassword``      Hier wird im Falle eines nicht public-Keys das Password eingetragen.
Allow PluginCloud to log requests in order to help the development-team to improve the services [basic.allowLog]  ``false``           Ist der Haken gesetzt, erlauben Sie der PluginCloud Ihre Anfragen in einem Log zu speichern.
                                                                                                                                      Wenn Sie dem FTM-Entwicklungsteam bei der Optimierung und Wartung der WebServices helfen wollen, aktivieren Sie gerne diesen Haken.
                                                                                                                                      Die geloggten Daten werden dann ausschließlich für Optimierung und Wartung verwendet!.
================================================================================================================= =================== ====================================================================================================================================================================================

 
 








.. include:: ./Snippets/PoweredBy.rst