======================================== ====================================================================================================================================
Verzeichnis                              Beschreibung
======================================== ====================================================================================================================================
``../Less/``                             Hier liegen alle Less-Dateien des Theme - die Dateien müssen in der Reihenfolge dieser Liste hier eingebunden werden!
                                         Die Less-Dateien packen wir in das Public-Verzeichnis, da es auch vorkommen kann das ein Entwickler sein Less clientseitig kompilieren möchte.
                                         Die Less-Dateien werden automatisch zu CSS kompiliert und dann im CSS-Verzeichnis bereitgestellt.
``../Less/BasicLess``                    Hier liegen die Basis-Lessdateien.
                                         Dies wären:
                                         
                                         * variables.less: Hier werden die generierten Less-Variablen automatisiert reingeschrieben.
                                         * mixins.less: Mixins die der FTM für Ihr Template bereitstellt.
                                         * mixinsCustom.less: Hier platzieren Sie Ihre eigenen Mixins.
                                         
``../Less/BasicLess/ContentLayouts``     Hier werden die Less-Dateien für die Content-Layouts abgelegt.
                                         Lesen Sie hier mehr dazu `http://fluid-template-manager.de/documentation/ContentAndRte.html#content-layouts <http://fluid-template-manager.de/documentation/ContentAndRte.html#content-layouts>`_.
``../Less/BasicLess/GridElementLayouts`` Hier werden die Less-Dateien für die Grid-Element-Layouts abgelegt.
                                         Lesen Sie hier mehr dazu `http://fluid-template-manager.de/documentation/Css-Less.html#vordefinierte-css-less-klassen-fur-die-grid-elemente <http://fluid-template-manager.de/documentation/Css-Less.html#vordefinierte-css-less-klassen-fur-die-grid-elemente>`_.
``../Less/BasicLayout``                  Hier liegen die Basislayout-Lessdateien.
                                         Dies wären:
                                         
                                         * layout.less: Hier legen Sie alle Styles für das generelle Layout ab.
                                         * print.less: Hier legen Sie alle Styles für die Druckansicht ab.
                                         * typography.less: Hier legen Sie alle Styles rund um die Typografie ab.
                                         
``../Less/Modifications``                Hier liegen alle modifizierten Daten, bspw. die angepassten Bootstrap-Dateien.
                                         Es werden somit von anzupassenden Dateien eine Kopie erstellt, um das original vorzuhalten und im ``modifications``-Verzeichnis wird die Kopie verändert und statt dem Original eingebunden.
                                         Am besten kommentieren Sie die zu überschreibende Datei auch in der ``bootstrap.less`` aus.
``../Less/Areas``                        Hier liegen alle Styles der Äreas. 
                                         Für jede Ärea sollte eine eigene Datei mit gleichem Namen angelegt werden.
``../Less/Navigations``                  Hier liegen alle Styles der Menüs. 
                                         Für jedes Menü sollte eine eigene Datei mit gleichem Namen angelegt werden.
``../Less/Layouts``                      Hier liegen alle Styles der Layout-Dateien. 
                                         Für jedes Layout sollte eine eigene Datei mit gleichem Namen angelegt werden.
``../Less/Templates``                    Hier liegen alle Styles der Template-Dateien. 
                                         Für jedes Templates sollte eine eigene Datei mit gleichem Namen angelegt werden.
``../Less/Partials``                     Hier liegen alle Styles die in Partials verwendet werden. Für jedes Partial sollte eine eigene Datei mit gleichem Namen angelegt werden.
                                         Gibt es nun bspw. ein Partial Quicksearch, würde man alle Styles aus diesem Partial in eine ``/Less/Partials/QuickSearch.less`` legen.
                                         Das bietet den Vorteil, wenn man nun in einer weiteren Seite eine Quicksearch braucht, kann man das Partial alleine in die neue Seite rüberkopieren ohne lange zu suchen wo alles liegt.
======================================== ====================================================================================================================================
