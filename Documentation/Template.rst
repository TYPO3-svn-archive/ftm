================================
Template-Konfiguration
================================
Der Template-Konfigurations-Datensatz enthält all die Informationen, wie sich Ihr Template später verhalten soll.


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
Template-Typ                  YAML, Bootstrap oder sonstiges.
                              Je nach Template verhält sich der FTM unterschiedlich.
                              So werden bspw. beim Erstellen eines YAML oder Bootstrap unterschiedliche Template-Strukturen erstellt.
                              1. YAML
                              ...
                              2. Twitter Bootstrap 3.0
                              Wenn Twitter Bootstrap aus gewählt wurde, wird:
                              
                              * Die bootstrap.min.js über ein CDN ein gebunden
                              * BackendLayouts mit entsprechender Struktur bereitgestellt
                              * GridLayouts mit entsprechender Strutur bereitgestellt
Template-Name                 **Achtung:** Der Template-Name **muss** mit **ftm_theme_** beginnen.
                              Dieser Name wird gleichzeitig als Verzeichnis-Name für Ihr Template verwendet.
============================= =====================================================================================================================================================



--------------------------------------------------------------------
Basis-Konfiguration
--------------------------------------------------------------------
Die Basis-Konfiguration stellt im wesentlichen die Konfiguration im *config*-TYPOScript Namensraum dar.
Die Einstellungen wurden in die Bereiche Allgemein, Sprache und Lokalisierung und Spam Protect aufgeteilt.
Natürlich gibt es hier noch viel mehr mögliche Einstellungen im *config*-TYPOScript, aber wir wollen ja auch nur eine gewisse Basis schaffen.


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Allgemein
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Auf dem Tab *Allgemein* finden Sie die folgenden Einstellungen:

.. important:: Die hier angegebenen TYPOScripte sind nur ein Beispiel und können je nach Konfiguration und Entwicklung des Generators abweichen!

================================= =====================================================================================================================================================
Feld                              Beschreibung
================================= =====================================================================================================================================================
HTML-Doctype                      Hier kann festgelegt werden, welchen HTML-Doctype das von TYPO3 generierte HTML haben soll.
                                  Mögliche Werte sind:
                                  
                                  * html5 - HTML 5 (default)
                                  * xhtml_trans - XHTML 1.0 Transitional
                                  * xhtml_frames - XHTML 1.0 Frameset
                                  * xhtml_strict - XHTML 1.0 Strict
                                  * xhtml_11 - XHTML 1.1
                                  * xhtml_20 - XHTML 2.0
                                  * none - kein DOCTYPE (nicht zu empfehlen)
                                  
                                  **Beispiel-TypoScript:**
                                  
                                  .. code-block:: ts
                                      config.doctype = html5
                                  
html5.js über ein CDN einbinden?  Diese Option ist nur möglich, wenn der doctype html5 eingestellt ist.
                                  Wenn diese Option aktiviert ist, wird eine html5.js über ein CDN eingebunden.
                                  
                                  **Beispiel-TypoScript:**
                                  
                                  .. code-block:: ts
                                      page.headerData.10.value (
                                        <!--[if lt IE 9]>
                                          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                                        <![endif]-->
                                      )
                                  
baseUrl                           Die Base-URL wird u.a. zur Erstellung von Links verwendet.
                                  Bspw.: ``http://www.fluid-template-manager.de/``
                                  
                                  **Beispiel-TypoScript:**
                                 
                                  .. code-block:: ts
                                      config.baseURL = http://www.fluid-template-manager.de/
                                  
linkVars                          Sind die Variablen, die beim generieren von neuen Links innerhalb Ihrer Webseite nicht ausgefiltert werden.
                                  Übergeben Sie bspw. bei einem Seitenaufruf die Variable *L* für die Auswahl einer Sprache, so fügt TYPO3 diese Variable automatisch an alle in der Seite enthaltenen Links, so dass die Sprache auch für alle Folgeseiten gilt.
                                  Als Standardwert wird hier auch schon die Variable ``L`` vorgegeben.
                                  
                                  **Beispiel-TypoScript:**
                                 
                                  .. code-block:: ts
                                      config.linkVars = L
                                  
Verhindert Charset-Header         Verhindert das der Charset-Header (content-type:text/html; charset...) gesendet wird.
                                  
                                  **Beispiel-TypoScript:**
                                 
                                  .. code-block:: ts
                                      config.disableCharsetHeader = 0
                                  
Meta-Charset/Zeichenkodierung     Gibt die Zeichenkodierung für die Ausgabe an.
                                  Dieser Wert wird in den Meta-Tag und im HTTP-Header (nur bei ``config.disableCharsetHeader = 0``) verwendet.
                                  
                                  **Beispiel-TypoScript:**
                                 
                                  .. code-block:: ts
                                      config.metaCharset = UTF-8
                                  
Anker-Prefix                      Konfiguration für HTML-Ankerpunkte in TYPO3-Links.
                                  Mögliche Werte sind:
                                  
                                  * all - Alle
                                  * cached - Gecacht
                                  * output - Ausgabe
                                  
                                  **Beispiel-TypoScript:**
                                 
                                  .. code-block:: ts
                                      config.prefixLocalAnchors = all
                                  
Sprechende URLs                   Hier ausgewählt werden, ob und mit welcher Technik sprechende URLs generiert werden sollen.
                                  Mögliche Werte sind:
                                  
                                  * none - Keine sprechenden URLs verwenden.
                                  * simulatestatic - Simulate Static (Extension simulatestatic erforderlich) für sprechende URLs verwenden.
                                  * realurl - RealURL (Extension RealURL ab Version 1.12.6 erforderlich) für sprechende URLs verwenden.
                                  
                                  **Beispiel-TypoScript:**
                                 
                                  .. code-block:: ts
                                      config.tx_realurl_enable = 1
                                      config.simulateStaticDocuments = 0
                                  
Google-Analytics                  Hier kann der Google-Analytics Tracking-Code eingesetzt werden.
                                  Dieser wird jedoch nur in der Seite verwendet, wenn sich das Template im Produktion-Mode befindet.
                                  
================================= =====================================================================================================================================================



~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Sprache und Lokalisierung
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Der Tab *Sprache und Lokalisierung* bietet die Konfigration für die Basis-Spracheinstellungen Ihrer Seite.
Das heißt die Sprache in der alle Ihre Standard-Seiteninhalte sein sollten.

In diesem Abschnitt finden Sie die folgenden Einstellungen.

================================= =====================================================================================================================================================
Feld                              Beschreibung
================================= =====================================================================================================================================================
sys_language_uid                  Hier ist die Sprachen-Uid für Ihr System eingetragen.
                                  Dies ist in der Regel die UID 0.
Sprachen-Titel                    Hier wird der Anzeige-Name für die Standard-Sprache eingegeben.
                                  Bspw. *Englisch* wenn die Standard-Sprache Englisch ist.
                                  Dieser Name wird dann u.a. für den automatisch generierten Sprachschalter verwendet.
language                          Gibt den Key der verwendeten Sprache an.
                                  Bspw. ``en`` für Englisch oder ``de`` für Deutsch.
localeAll                         Gibt die Lokalisierung an, bspw. ``en_US.UTF-8``
================================= =====================================================================================================================================================

Für eine Seite mit der Standard-Sprache deutsch könnte somit das TYPOScript wie folgt aussehen:

.. code-block:: ts

    config.sys_language_uid = 0
    config.language         = de
    config.locale_all       = de_DE.UTF-8



~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Spam Protect
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Um das Auslesen der auf Ihrer Webseite dargestellten E-Mailadressen zu erschweren sollten Sie den integrierten Spamschutz verwenden.
Der Spamschutz bietet die folgenden Optionen:


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
In Sachen Meta-Tags und SEO haben wir auch hier versucht, eine gewisse Basis für Sie bereitzustellen.

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

Standardmäßig wird auch das Datum der letzten Änderung aus einer TYPO3-Seite ausgelesen und dann in einem Meta-Tag *Last-Modified* geschrieben.
Des Weiteren wird der Website-Name automatisch immer mit dem Seiten-Titel verbunden und dann als HTML-Titel verwendet.



--------------------------------------------------------------------
Website-Sprachen
--------------------------------------------------------------------
In diesem Abschnitt kann je Sprache auf der Webseite ein Datensatz erstellt werden.
Anhand dieser Datensätze wird dann die Grundkonfiguration für die Sprachen und auch ein einfacher Sprachschalter generiert, den Sie dann in Ihrem Template einsetzen können.

Bevor Sie jedoch eine neue Sprache in Ihrem FTM-Template auswählen können, müssen Sie die jeweilige Sprache noch im TYPO3 erstellt haben.
Dafür gehen Sie wie folgt vor:

1. Wechseln Sie im TYPO3-Backend in das *WEB*-Modul und klicken Sie die Root-Seite im Seitenbaum an.
2. Klicken Sie im oberen Content-Bereich auf Datensatz erstellen.
3. Wählen Sie nun auf der Auswahl-Seite **Website-Sprache** aus.
4. Auf der folgenden Bearbeitungs-Seite stellen Sie nun entsprechend Ihre neue Sprache ein und speichern Sie den Datensatz.

Nun haben Sie innerhalb von TYPO3 eine neue Website-Sprache bereit gestellt.
Damit das FTM-Template nun die neue Sprache im generierten TYPOScript berücksichtigen kann, müssen Sie die neue Sprache auch im FTM-Template zuweisen.
Darfür müssen Sie nun in diesem Abschnitt (FTM-Template Tab *General*, Abschnitt *Website-Sprachen*) einen Datensatz erstellen.

Diese Datensätze stellen folgende Einstellungen bereit:

================================= =====================================================================================================================================================
Feld                              Beschreibung
================================= =====================================================================================================================================================
sys_language_uid                  Hier muss die Sprachen-Uid ausgewählt werden, also die Website-Sprache die Sie gerade auf der TYPO3-Rootseite erstellt haben.
                                  Für die Auswahl wird hier eine Selektor bereitgestellt, der (nur) die Auswahl von TYPO3-Website-Sprachen erlaubt.
Sprachen-Titel                    Hier wird der Anzeige-Name für die neue Sprache eingegeben.
                                  Bspw. *Englisch* wenn die neue Sprache Englisch ist.
                                  Dieser Name wird dann u.a. für den automatisch generierten Sprachschalter verwendet.
language                          Gibt den Key der verwendeten Sprache an.
                                  Bspw. ``en`` für Englisch oder ``de`` für Deutsch.
localeAll                         Gibt die Lokalisierung an, bspw. ``en_US.UTF-8``
================================= =====================================================================================================================================================

Haben Sie nun eine neue Sprache angelegt, so müssen Sie nur noch das TYPOScript neu generieren und die neue Sprache sollte im System verfügbar sein.

Wie bereits oben erwähnt, wird auch ein einfaches Sprach-Auswahlmenü generiert.
Dieses Sprach-Auswahlmenü trägt den Marker-Namen ``lib.nav.language``.

Sie können nun dieses Menü einfach mit dem folgenden Fluid-Befehl in Ihre Templates einsetzen:

.. code-block:: html

    <f:cObject typoscriptObjectPath="lib.nav.language"></f:cObject>



.. include:: ./Snippets/PoweredBy.rst