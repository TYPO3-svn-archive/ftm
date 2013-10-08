================================ ====================================================================================================================================
Verzeichnis                      Beschreibung
================================ ====================================================================================================================================
``../Less/``                     Hier liegen alle Less-Dateien des Theme - die Dateien müssen in der Reihenfolge dieser Liste hier eingebunden werden.
                                 Die Less-Dateien packen wir in das Public-Verzeichnis, da es auch vorkommen kann das ein Entwickler sein Less clientseitig kompilieren möchte
                                 Die Less-Dateien werden automatisch zu CSS kompiliert und dann im CSS-Verzeichnis bereitgestellt.
``../Less/BasicLess``            
``../Less/BasicLayout``            
``../Less/Modifications``        Hier liegen alle modifizierten Daten, bspw. die angepassten Bootstrap-Dateien.
                                 Es werden somit von anzupassenden Dateien eine Kopie erstellt, um das original vorzuhalten und im ``modifications``-Verzeichnis wird die Kopie verändert und statt dem Original eingebunden.
``../Less/Areas``                
``../Less/Layouts``              Hier liegen alle Styles der Layout-Dateien. Für jedes Layout sollte eine eigene Datei mit gleichem Namen angelegt werden.
``../Less/Templates``            Hier liegen alle Styles der Template-Dateien. Für jedes Templates sollte eine eigene Datei mit gleichem Namen angelegt werden.
``../Less/Partials``             Hier liegen alle Styles die in Partials verwendet werden. Für jedes Partial sollte eine eigene Datei mit gleichem Namen angelegt werden.
                                 Gibt es nun bspw. ein Partial Quicksearch, würde man alle Styles aus diesem Partial in eine ``/Less/Partials/QuickSearch.less`` legen.
                                 Das bietet den Vorteil, wenn man nun in einer weiteren Seite eine Quicksearch braucht, kann man das Partial alleine in die neue Seite rüberkopieren ohne lange zu suchen wo alles liegt.
================================ ====================================================================================================================================
