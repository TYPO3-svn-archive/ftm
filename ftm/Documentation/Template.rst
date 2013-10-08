================================
Template-Konfiguration
================================



--------------------------------------------------------------------
Allgemeines
--------------------------------------------------------------------
Hier finden Sie allgemeine Einstellungen zu den Templates.


============================= =====================================================================================================================================================
Feld                          Beschreibung
============================= =====================================================================================================================================================
Webseiten-Name                Hier wird der Name der Website vergeben. Dieser Namen wird u.A. für die Erweiterung des HTML-Titel verwendet.
Production/Development Modus  Das Template kann so konfiguriert werden das es im Production oder Development Mode läuft.
                              
                              1. Development-Mode
                              Der Development-Mode kann während der Entwicklung des Templates verwendet werden.
                              Ist dieser aktiviert, wird:
                              
                              * das Less bei jedem Seitenaufruf kompiliert
                              * das Less nicht komprimiert
                              * die CSS- und JavaScript-Dateien wird nicht gemerged und komprimiert
                              * der TYPO3-Cache deaktiviert
                              * der Meta-Tag Robots auf ``noindex,nofollow`` gesetzt
                              * der Google-Analytics-Code nicht integriert
                              
                              2. Procution-Mode
                              Wenn das Template fertig entwickelt ist und die Seite online geht, sollte das Template auf jeden Fall in den Production-Mode geschaltet werden.
                              Ist dieser aktiviert, wird:
                              
                              * das Less nur noch nach Veränderungen und nach leeren der Caches kompiliert
                              * das Less komprimiert
                              * die CSS- und JavaScript-Dateien werden gemerged und komprimiert
                              * der TYPO3-Cache wieder aktiviert
                              * der Meta-Tag Robots auf den konfigurierten Wert gesetzt
                              * der Google-Analytics-Code integriert
Template-Typ                  YAML oder Bootstrap
                              1. YAML
                              ...
                              2. Twitter Bootstrap 3.0
                              Wenn Twitter Bootstrap aus gewählt wurde, wird:
                              
                              * Die bootstrap.min.js über ein CDN ein gebunden
                              * BackendLayouts mit entsprechender Struktur bereitgestellt
                              * GridLayouts mit entsprechender Strutur bereitgestellt
Template-Name                 **Achtung:** Der Template-Name **muss** mit **ftm_theme_** beginnen.
============================= =====================================================================================================================================================




--------------------------------------------------------------------
Basis-Konfiguration
--------------------------------------------------------------------

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Allgemein
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Sprache und Lokalisierung
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Spam Protect
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Hier kann man die E-Mailadressen der Seite gegen Spambots schützen.

============================= ====================================================================
Feld                          Beschreibung
============================= ====================================================================
Spam Protect Email Addresses  Spam-Schutz aktivieren, ja!?
@-Zeichen ersetzen durch      Das @-Zeichen der E-Mailadresse wird durch diesen Inhalt ersetzt
Letzten Punkt ersetzen durch  Der letzte Punkt der E-Mailadresse wird durch diesen Inhalt ersetzt
============================= ====================================================================

Weitere Tips zu einer erfolgreich Spam-Verhinderung finden Sie hier:
http://typo3blogger.de/e-mail-adresse-gegen-spam-schutzen/





--------------------------------------------------------------------
Meta-Angaben & SEO
--------------------------------------------------------------------
In Sachen Meta-Tag und SEO haben wir versucht eine gewisse Basis schon vor zubereiten.

So werden bspw. Abstract, Keywords, Description, Author und Author E-Mail auf entsprechende Unter-Ebenen vererbt.
Die Vererbung gestaltet sich folgend:
# Im FTM-Template Datensatz wird im Abschnitt Meta-Angaben der absolute Fallback definiert. Ist auf keinen Seiten der Rootline eine solche Angabe angegeben, so wird dieser Wert verwendet.
# Sind auf einer Eltern-Seite bspw. Keywords vergeben, auf der aktuellen Kind-Seite jedoch nicht, so werden die Keywords von der Eltern-Seite verwendet.
# Sind auf der aktuellen Seite Meta-Angaben vorhanden, so werden diese natürlich vorrangig verwendet.

Somit sollte eigentlich sichergestellt sein, das man immer auf allen Seiten zumindest die Standard Meta-Tag vorhanden hat.

**Achtung:**
.. include:: ./Snippets/LocalConfigurationAddRootLineFields.rst


Hier noch einmal eine Übersicht aller Einstellungen aus dem Meta-Angaben & SEO Bereich:

============================= ============= ======================================================================================================================================
Feld                          Standardwert  Beschreibung
============================= ============= ======================================================================================================================================
Abstract                                    Hier werden das Abstract eingetragen, das verwendet wird wenn kein Abstract auf den Seiten der Rootline gefunden werden kann.
Keywords                                    Hier werden die Keywords eingetragen, die verwendet werden wenn keine Keywords auf den Seiten der Rootline gefunden werden können.
Description                                 Hier werden die Description eingetragen, die verwendet wird wenn keine Desccription auf den Seiten der Rootline gefunden werden kann.
Author                                      Hier wird der Standard-Autor definiert. 
                                            Dieser wird automatisch auch in den Meta-Tag Publisher geschrieben.
Copyright                                   Hier wird der Copyright der Seite eingetragen.
Robots                        index,follow  Hier werden die Robots-Anweisungen eingetragen.
                                            **Achtung:** Wenn die Seite sich im Development-Modus befindet wird dieser Wert mit ``noindex,nofollow`` überschrieben.
Revisit                       7 days        Hier wird angegeben, in welchem Zyklus die Suchmaschinen-Bots wieder kommen sollen.
Canonical-Tag verwenden       Ja            Hier kann selektiert werden, ob der Canonical-Tag verwendet werden soll.
============================= ============= ======================================================================================================================================




Standardmäßig wird auch:
Meta-Tag Last-Modified, aus dem Datensatz der Seite auslesen
und in einen ``<meta name=\"Last-Modified\" content=\"|\" />`` verpackt

Andere Felder werden aus der Rootline übernommen, wichtig ist das $TYPO3_CONF_VARS['FE']['addRootLineFields'] = 'abstract,keywords,description,author,author_email';
gesetzt ist; AChtung verketten, bereitsvorhandene felder nicht entfernen.

CODE:
    'FE' => array(
        'addRootLineFields' => 'abstract,keywords,description,author,author_email',
    ),
/CODE

--> Vielleicht eine Extra Section irgendwo mit allen LocalConfiguration.php Änderungen

-> Durch die Vererbung muss man als erstes nur noch auf der Root-Seite die Meta-Angaben machen alle anderen werden Vererbt

- Der Website-Name wird automatisch mit dem HTML-Title verbunden


.. include:: ./Snippets/PoweredBy.rst


