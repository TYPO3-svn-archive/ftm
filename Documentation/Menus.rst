================================
Menüs
================================


--------------------------------------------------------------------
Allgemein
--------------------------------------------------------------------
Mit Hilfe des FTMs sind Sie auch in der Lage Menüs zu generieren.
Auch dies bietet nun wieder einige Vorteile, ein paar wären z.B.:

* Einheitliche HTML-Strukturen und CSS-Klassen erlauben es, einmal gestylte Menüs immer wieder zu verwenden.
Um eine solche Wiederverwendung von bspw. eines CSS-Ausklappmenüs gewährleisten zu können, sollten Sie sich angewöhnen die CSS/LESS-Angaben eines Menüs in eine gleichnamige Datei zu schreiben.
So kommen bspw. alle Styles des Main-Menüs in die Datei ``Resources/Public/Less/Navigations/main.less``

* Diverse Angaben über Menü-Elemente/Seiten bereits vorkonfiguriert.
  .. welche Klassen etc. sind schon vorhanden?!

, ggf. Uids einfach auswählbar.



Wrapper:
HIer ist die Namens-Konvention wieder wichtig!!!
<ul class="nav-main">|</ul>

------------------------
# SubNavi nicht automatisch in Column-Menu schreiben
lib.area.menuContent.10 >

------------------------



###############################################
1 Menüs

Jedes Typo3-Template hat für gewöhnlich eine Vielzahl an Menüs (Top-Menü, Main-Menü, Sub-Menü, uvm.). 
Da dieses sich ja im wesentlich nicht unterscheiden haben wir versucht diese (wie es auch intern in Typo3 ist) in eine Struktur zu bekommen. 
Bei genauerer Betrachtung haben wir somit einen Menü-Container, Menü-Objekte und Menü-Zustände.



@todo: diagramm von container->Objekt->Zustand struktur!?


--------------------------------------------------------------------
Menü-Container
--------------------------------------------------------------------
Ein Menü-Container beinhaltet im Prinzip alle Informationen die für ein Menü notwendig sind.



================================= =====================================================================================================================================================
Feld                              Beschreibung
================================= =====================================================================================================================================================
Hide                              Mit dieser Check-Box kann das Menü deaktiviert werden.
                                  Deaktivierte Menüs werden im TYPOScript-Generator nicht generiert.
Menü/Marker-Name                  Hier wird der Name eingetragen, den der Menü-Marker vom TYPOScript-Generator erhalten soll.
                                  Dieser Name darf nur Buchstaben enthalten.
                                  Bspw. ``main`` für das Hauptmenu, der spätere Marker würde dann den Namen ``lib.nav.main`` tragen.
Menü-Typ                          Hier kann ausgewählt werden, woher die angezeigten Menüpunkte bezogen werden sollen.
                                  
                                  Mögliche Werte sind:
                                  
                                  * Menü nach Seitenbaum. Hierbei gibt man einfach eine Seiten-Ebene an und TYPO3 generiert ein Menü mit allen sichtbaren Seiten dieser und ggf. tieferen Ebenen.
                                  * Liste von ausgewählten Seiten. Hierbei wählt man selbst aus, welche Seiten in diesem Menü erscheinen sollen. Die Seiten können auch auf unterschiedlichen Ebenen liegen.
                                  
Einstiegs-Ebene                   Nur sichtbar wenn das Menü den Typ *Menü nach Seitenbaum* hat.
                                  Hier kann angegeben werden auf welcher Ebene das Menü beginnen soll.
Menü-Seiten                       Nur sichtbar wenn das Menü den Typ *Liste von ausgewählten Seiten* hat.
                                  Hier können die Seiten selektiert werden, die im Menü angezeigt werden soll.
Ausgeschlossene Seiten            Nur sichtbar wenn das Menü den Typ *Menü nach Seitenbaum* hat.
                                  Hier kann angegeben werden welche Seiten, die normalerweise sichtbar wären, nicht angezeigt werden sollen.
Zeige auch nicht sichtbare Seiten Ist diese Option aktiviert, so werden auch Seiten in diesem Menü angezeigt, die als *im Menü nicht anzeigen* markiert sind.
                              
                              
================================= =====================================================================================================================================================



--------------------------------------------------------------------
Menü-Objekt
--------------------------------------------------------------------


--------------------------------------------------------------------
Menü-Zustand
--------------------------------------------------------------------
[Edit]1.1 


[Edit]1.2 

Hier werden die Menü-Objekte angelegt. Für jede Menu-Ebene muss ein Menü-Objekt angelegt werden. Hat man bspw. eine Menü mit drei Ebenen, muss man auch drei Menü-Objekte anlegen. Die Ebenen-Reihenfolge wir entsprechend der Liste generiert - man kann also via Drag'n'Drop die Zuweisung von Menü-Objekt zu Ebene verändern.



[Edit]1.3 


Die Reihenfolge der Verwendung kann hier einfach via Drag'n'Drop bestimmt werden. Jeder Zustand darf (muss aber nicht) nur einmal verwendet werden.

Folgende Zustände werden aktuell vom FTM-Menü unterstützt:

    NO - Normal - Muss immer angegeben werden
    ACT - Einstellungen für Menü-Objekte auf der Rootline
    ACTRO - MouseOver für Menü-Objekte auf der Rootline
    ACTIFSUB - Einstellungen für Menü-Objekte auf der Rootline, die Unterseiten haben
    ACTIFSUBRO - MouseOver für Menü-Objekte auf der Rootline, die Unterseiten haben
    CUR - Einstellungen der aktuellen Seite/Menü-Objektes
    CURRO - MouseOver der aktuellen Seite/Menü-Objektes
    CURIFSUB - Einstellungen der aktuellen Seite/Menü-Objekt, wenn dieser Unterseiten hat
    CURIFSUBRO - MouseOver der aktuellen Seite/Menü-Objekt, wenn diese Unterseiten hat
    IFSUB - Einstellungen wenn Menü-Objekt Unterseiten besitzt
    IFSUBRO - MouseOver wenn Menü-Objekt Unterseiten besitzt
    SPC - Einstellungen für Menü-Trenner 
###############################################




.. include:: ./Snippets/PoweredBy.rst

