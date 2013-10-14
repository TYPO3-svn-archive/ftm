================================
Fluid-Templates
================================

Die im FTM verwendeten Fluid Templates/Layouts/Partials bestehen aus einem Datensatz und eine entsprechenden Fluid-Datei.

**Die Fluid-Datei** enthält den Fluid-Code der bei der Ausführung des Templates verwendet wird.

**Der Datensatz** enthält Informationen über die jeweiligen Fluid-Dateien und wird des Weiteren für die dynamische TYPOScript-Generierung benötigt.
Im Datensatz ist ebenfalls eine Version des Template-Codes enthalten.
Ist eine Template nur als Datensatz vorhanden, im Dateisystem jedoch nicht, so wird diese fehlende Datei automatisch aus dem Datensatz generiert.

Das kann sehr praktisch sein. Hat man ein FTM-Template schon auf verschiedenen TYPO3-Instanzen unterschiedlich konfiguriert genutzt und möchte nun eine neue Instanz aufsetzen, so importiert man nur das Basis-Template über den Extension-Manager und importiert dann die Konfiguration als T3D-Datei.
Ist dies geschehen kann man über die Template-Übersicht entscheiden welches Template aus der importierten Konfiguration oder aus dem Basis-Template genutzt werden soll.

Die Fluid-Templates findet man im Fluid-Template-Manager Modul auf dem Reiter *Fluid-Templates*.

Diese Templates sollten nur über die FTM-GUI erstellt und auch nur darüber bearbeitet und verwaltet werden.



--------------------------------------------------------------------
Fluid-Tempate Übersicht
--------------------------------------------------------------------
Im FTM-Modul befindet sich die Template-Übersicht. 
Diese gibt eine gute Übersicht darüber, welche Templates vorhanden sind und wie deren Status aktuell ist.

@todo
import fluid-template-overview.png

============== ==================================================================================================================================================================================================================
Spalte         Beschreibung
============== ==================================================================================================================================================================================================================
Typ            Zeigt an ob es ein Template, Layout oder Partial ist
Dateiname      Zeigt den Dateinamen an, welchen das Template im Dateisystem besitzt. OnMouseOver erscheint der komplette Pfad in einem Tooltip
Backend-Layout Diese Spalte ist nur bei Templates befüllt. Hier wird angezeigt ob, und welches Backend-Layout zugewiesen ist. Darüberhinaus kann man die jeweiligen Backend-Layouts direkt über den Bleistift-Button bearbeiten.
Info           Diese Spalte zeigt an, ob zu diesem Datensatz die entsprechende Datei im Dateisystem vorhanden ist und ob diese aktuell, sprich gleich sind.
============== ==================================================================================================================================================================================================================

Jede Listen-Spalte stellt die folgenden Aktionen bereit:

=============================================== ===========================================================================
Aktion                                          Beschreibung
=============================================== ===========================================================================
.. figure:: Images/Icons/fluid_edit.png         Öffnet den Template-Datensatz zum bearbeiten.
.. figure:: Images/Icons/edit.png               Öffnet den Template-Code zum bearbeiten.
.. figure:: Images/Icons/fluid_db_to_file.png   Kopiert den Template-Code aus dem Template-Datensatz in die Template-Datei.
.. figure:: Images/Icons/fluid_file_to_db.png   Kopiert den Template-Code aus dem Template-Datei in die Template-Datensatz.
=============================================== ===========================================================================


.. important:: Die Reihenfolge der Fluid-Templates in der Übersichtsliste ist von Bedeutung. 
               Da es in jeder TYPO3-Seite eine standard/default-Template gibt, welches verwendet wird wenn kein Template explizit zugewiesen wurde, muss dem FTM auf mitgeteilt werden welches es sein soll.
               Dies geschieht einfach über die Reihenfolge/Sorting der Templates. Das erste Template in der Liste ist das standard/default-Layout Ihrer TYPO3-Webseite.


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
Fluid-Tempate Datensätze
--------------------------------------------------------------------
Die Template-Datensätze haben die folgenden Einstellungen:

==================== ========================= =====================================================================================================================================================================================================================================================================================
Feld                 verfügbar in Template-Typ Beschreibung
==================== ========================= =====================================================================================================================================================================================================================================================================================
Title                Template, Layout, Partial Dies ist ein interner Bezeichner der Ihnen dabei helfen soll, Ihre Templates zu identifizieren ohne das Sie das Template öffnen müssen.
Template-Typ         Template, Layout, Partial Der FTM unterstützt, wie auch normale 'hand'-programmierte Fluid-Templates und Fluid/ExtBase-Extensions, die Template-Typen Layout, Partial und Template. Diese Templates sollten nur über die FTM-GUI erstellt und auch nur darüber bearbeitet und verwaltet werden. 
Template-(Datei)name Template, Layout, Partial Hier muss der Name des Templates eingegeben werden. Dieser wird, wie das Label schon sagt, auch für den Dateinamen des Templates verwendet. Daher darf der Name nur aus Buchstaben bestehen und sollte mit einem kleinen Buchstaben beginnen. Wenn der Name aus mehreren Worten besteht, sollte der Anfangs-Buchstabe jedes Wortes groß geschrieben werden (lower-camel-case). Hat ein Template bspw. 4 Spalten könnte dieses ''fourColumns'' heißen.
Backend-Layout       Template                  Hier kann bei Fluid-Templates entschieden werden, welches Backend-Layout diesem Template zugeordnet wird. Ein Template **muss** ein Backend-Layout zugewiesen haben, damit das erforderliche TYPOScript richtig generiert werden kann.
Template-Code        Template, Layout, Partial Hier kann der Template-Code bearbeitet werden, welcher sich direkt im Datensatz befindet.
==================== ========================= =====================================================================================================================================================================================================================================================================================



--------------------------------------------------------------------
Fluid-Tempate Namenskonvention und Strukturen
--------------------------------------------------------------------
Im folgenden ein paar Namenskonventionen um den Templates eine bessere Struktur und Übersichtlichkeit zu geben.


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Fluid Layout-Templates
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Layout-Templates werden dazu verwendet, um Teile vom HTML-Template die auf vielen oder gar allen Seiten vorkommen, auszulagern. Dies sind in der Regel Header und/oder Footer-Elemente.
Alle Fluid Layout-Dateien werden aus diesem Datensatz generiert und im Verzeichnis /template/fluid/layouts/ abgelegt.
Ein Beispiel für ein Layout-Template könnte wie folgt aussehen:

.. code-block:: html

    <div id="layout-default">
      <header>Header-Content, der in allen zugewiesenen Templates verwendet wird</header>
      <f:render section="content"></f:render>
    </div>

Der gesamte Inhalt jedes Layouts sollte in ein div gewrappt werden, das eine id nach einem festen Muster bekommt. 
Dies erlaubt es über CSS-Selektoren Styles zu definieren, die nur innerhalb dieses Layouts greifen sollen. 
Das feste Muster ("Template-Typ"-"(Datei)name des Template") hilft uns dabei, schneller die zu verwendenden Selektoren etc. zu erkennen, aber auch anhand eines Seiten-Sourcecodes zu erkennen, welches Layout verwendet wurde.
Die id von unserem Layout mit dem (Datei)namen *layout* bekommt somit den Namen ``layout-default``.

Wenn Sie und auch alle anderen Template-Entwickler sich stets an diese Konvention halten, wird es allen einfacher fallen sich in den Templates zurecht zu finden und Sie wissen immer wo Sie eine bestimmte Template-Struktur oder auch CSS-Code suchen müssen.



~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Fluid Template-Templates
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Die *Template*-Templates (kurz Templates) werden für gewöhnliche Seiten-Templates verwendet. 
So könnte man bspw. ein eigenes Template für eine Startseite und ein eigenes Template für Standard-Seiten erstellen.
Wichtig hierbei ist, das man jedem Template auch ein BackendLayout zuweist, damit wir dem Redakteur der später die Seite bearbeiten soll, eine ähnliche Content-Strukturierung im Backend geben können, wie sie im Frontend verwendet wird. 
Des Weiteren ist, wie bereits weiter oben erwähnt, die Sortierung der Templates in der Liste zu beachten. 
Das oberste Template wird als *standard/default*-Template verwendet. 
Das heißt, hat man später einer Seite kein explizites Layout zugewiesen, wird das *standard/default*-Layout verwendet.



~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Fluid Partial-Templates
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Partial-Templates, oder auch kurz ''Partials'' genannt, werden für kleinere Template-Teile verwendet, die sich öfter wiederholen oder wo eine Trennung sinnvoll ist (bspw. um eine bessere Übersicht in einem großen Template zu erhalten).
Ein Beispiel für ein Partial könnte wie folgt aussehen:

.. code-block:: html

    <div id="partial-menuContent">
      <f:cObject typoscriptObjectPath="lib.area.menuContent"></f:cObject>
    </div>

Auch hier wird wieder der eigentliche Template-Code in ein Div mit einer genau definierten ID gewrappt.
Wie auch bei den beiden anderen Template-Typen, wird hier der Template-Typ und der Template-(Datei)name mit einem - verbunden.
Also bekommt das *Partial* mit dem Dateinamen *menuContent* die ID ``partial-menuContent``.

.. tip:: Halte Dich an die Namenskonvetion, damit auch andere Entwickler sich schnell in Deinen Templates zurechtfinden und diese auch für zukünftige Funktionalitäten kompatibel bleiben.



--------------------------------------------------------------------
Bekannte Probleme
--------------------------------------------------------------------
Manchmal wird der HTML-Editor nicht direkt geladen, wenn die Templates aus dem Haupt-Datensatz heraus bearbeitet werden. 
Es wird daher empfohlen die Templates einzeln aus der FTM- Übersicht heraus zu editieren, und nicht im gesamten Template-Datensatz. 



--------------------------------------------------------------------
Weiterführende Links zu Fluid
--------------------------------------------------------------------
`http://wiki.typo3.org/Fluid <http://wiki.typo3.org/Fluid>`_

`http://fedext.net/viewhelpers/fluid.html <http://fedext.net/viewhelpers/fluid.html>`_



.. include:: ./Snippets/PoweredBy.rst