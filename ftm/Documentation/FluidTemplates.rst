================================
Fluid-Templates
================================

Die im FTM verwendeten Fluid Templates/Layouts/Partials bestehen aus einem Datensatz und eine entsprechenden Fluid-Datei.

**Der Datensatz** enthält Informationen über die jeweiligen Fluid-Dateien und wird des Weiteren für die dynamische TYPOScript-Generierung benötigt.
Im Datensatz ist ebenfalls eine Version des Template-Codes enthalten.
Ist eine Template nur als Datensatz vorhanden, im Dateisystem jedoch nicht, so wird diese fehlende Datei automatisch aus dem Datensatz generiert.

Das kann sehr praktisch sein. Hat man ein FTM-Template schon auf verschiedenen TYPO3-Instanzen unterschiedlich konfiguriert genutzt und möchte nun eine neue Instanz aufsetzen, so importiert man nur das Basis-Template über den Extension-Manager und importiert dann die Konfiguration als T3D-Datei.
Ist dies geschehen kann man über die Template-Übersicht entscheiden welches Template aus der importierten Konfiguration oder aus dem Basis-Template genutzt werden soll.


--------------------------------------------------------------------
Fluid-Tempate Datensätze
--------------------------------------------------------------------

==================== ========================= =====================================================================================================================================================================================================================================================================================
Feld                 verfügbar in Template-Typ Beschreibung
==================== ========================= =====================================================================================================================================================================================================================================================================================
Title                Template, Layout, Partial
Template-Typ         Template, Layout, Partial Der FTM unterstützt, wie auch normale 'hand'-programmierte Fluid-Templates und Fluid/ExtBase-Extensions, die Template-Typen Layout, Partial und Template. Diese Templates sollten nur über die FTM-GUI erstellt und auch nur darüber bearbeitet und verwaltet werden. 
Template-(Datei)name Template, Layout, Partial
Backend-Layout       Template                  Hier kann bei Fluid-Templates entschieden werden, welches Backend-Layout diesem Template zugeordnet wird. Ein Template **muss** ein Backend-Layout zugewiesen haben, damit das erforderliche TYPOScript richtig generiert werden kann.
Template-Code        Template, Layout, Partial Hier kann der Template-Code bearbeitet werden, welcher sich direkt im Datensatz befindet.
==================== ========================= =====================================================================================================================================================================================================================================================================================




--------------------------------------------------------------------
Fluid-Tempate Dateien
--------------------------------------------------------------------
Wie auch bei TYPO3-Extensions liegen die Fluid-Templates in einem FTM-Theme in den folgenden Verzeichnissen:

============== =========================================================
Template-Typen Verzeichnis
============== =========================================================
Fluid-Template typo2conf/ext/ftm_theme_name/Resources/Private/Templates/
Fluid-Layout   typo2conf/ext/ftm_theme_name/Resources/Private/Layouts/
Fluid-Partial  typo2conf/ext/ftm_theme_name/Resources/Private/Partials/
============== =========================================================

Die Dateinamen ergeben sich wie schon weiter oben erwähnt aus dem *Template-(Datei)name*-Feld im Template-Datensatz.
Ist im Template-Datensatz der Name ``standard`` eingetragen, so heißt der Dateiname ``standard.html``.

.. note:: Bearbeitet werden können die Dateien aber nicht nur aus dem FTM heraus. Alle Templates können auch nach belieben via FTP oder anders bearbeitet werden.





--------------------------------------------------------------------
Fluid-Tempate Übersicht
--------------------------------------------------------------------
Im FTM-Modul befindet sich die Template-Übersicht. Diese gibt eine gute Übersicht darüber, welche Templates vorhanden sind und wie deren Status aktuell ist.

============== ==================================================================================================================================================================================================================
Spalte         Beschreibung
============== ==================================================================================================================================================================================================================
Typ            Zeigt an ob es ein Template, Layout oder Partial ist
Dateiname      Zeigt den Dateinamen an, welchen das Template im Dateisystem besitzt. OnMouseOver erscheint der komplette Pfad in einem Tooltip
Backend-Layout Diese Spalte ist nur bei Templates befüllt. Hier wird angezeigt ob, und welches Backend-Layout zugewiesen ist. Darüberhinaus kann man die jeweiligen Backend-Layouts direkt über den Bleistift-Button bearbeiten.
Info           Diese Spalte zeigt an, ob zu diesem Datensatz die entsprechende Datei im Dateisystem vorhanden ist und ob diese aktuell, sprich gleich sind.
============== ==================================================================================================================================================================================================================

Jede Listen-Spalte stellt die folgenden Aktionen bereit:

=============================================== ==========================================================================
Aktion                                          Beschreibung
=============================================== ==========================================================================
.. figure:: Images/Icons/fluid_edit.png         Öffnet den Template-Datensatz zum bearbeiten
.. figure:: Images/Icons/edit.png               Öffnet den Template-Code zum bearbeiten
.. figure:: Images/Icons/fluid_db_to_file.png   Kopiert den Template-Code aus dem Template-Datensatz in die Template-Datei
.. figure:: Images/Icons/fluid_file_to_db.png   Kopiert den Template-Code aus dem Template-Datei in die Template-Datensatz
=============================================== ==========================================================================


.. important:: Die Reihenfolge der Fluid-Templates in der Übersichtsliste ist von Bedeutung. 


--------------------------------------------------------------------
Fluid-Tempate Namenskonvention
--------------------------------------------------------------------
Im folgenden ein paar Namenskonventionen um den Templates eine bessere Struktur und Übersichtlichkeit zu geben.

.. tip:: Halte Dich an die Namenskonvetion, damit auch andere Entwickler sich schnell in Deinen Templates zurechtfinden und diese auch für zukünftige Funktionalitäten kompatibel bleiben.



--------------------------------------------------------------------
Bekannte Probleme
--------------------------------------------------------------------
Manchmal wird der HTML-Editor nicht direkt geladen. Es wird daher empfohlen die Templates einzeln aus der FTM- Übersicht heraus zu editieren, und nicht im gesamten Template-Datensatz. 



--------------------------------------------------------------------
Weiterführende Links zu Fluid
--------------------------------------------------------------------
`http://wiki.typo3.org/Fluid <http://wiki.typo3.org/Fluid>`_

`http://fedext.net/viewhelpers/fluid.html <http://fedext.net/viewhelpers/fluid.html>`_




.. include:: ./Snippets/PoweredBy.rst

