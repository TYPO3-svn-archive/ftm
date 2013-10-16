================================
Theme Verzeichnisstruktur
================================
`Fluid-Template-Manager.de <http://www.fluid-template-manager.de>`_ / `Dokumentation <http://www.fluid-template-manager.de/documentation>`_ / `Theme Verzeichnisstruktur <http://fluid-template-manager.de/documentation/ThemeDirectoryStructure.html>`_


Seit der FTM Version 1.1.0 haben die Themes eine neue Verzeichnisstrukutur.
Diese ist zum einen an die Site-Strukturen der TYPO3 Neos Sites angelehnt, aber auch an Theme-Strukturen wie sie bspw. vom site_mgr von Kay Strobach verwendet werden.
Dies erlaubt Entwicklern eine schnellere Portierung der Templates auf die verschiedenen System, und vielleicht darüberhinaus auch die Nutzung von site_mgr und ftm im gleichen System.

Darüber hinaus wurde das Theme in eine eigenständige Extension verlegt. 
Dies erlaubt es einen besseren Export/Import der Quelldateien, und darüber hinaus auch durch das Installieren der Theme-Extension im Extension-Manager auch das Einbinden von Theme spezifischem TCA.

Der redaktionelle Content liegt aber weiterhin sauber getrennt unterhalb des fileadmin-Verzeichnisses.
Somit besteht auch nicht mehr die Gefahr, das Redakteure versehentlich mit Template-Dateien in Berührung kommen.


--------------------------------------------------------------------
Allgemeine Verzeichnisse
--------------------------------------------------------------------
Hier eine Auflistung der allgemeinen Verzeichnisse:

================================ ====================================================================================================================================
Verzeichnis                      Beschreibung
================================ ====================================================================================================================================
``/Configuration/``              Hier liegen alle Konfigurations-Dateien zum Theme
``/Configuration/TypoScript``    Hier liegen alle TYPOScript-Dateien des Theme.
                                 In einem neuen Template werden automatisch die Dateien constants.ts, constantsCustom.ts, setup.ts und setupCustom.ts angelegt.
                                 
                                 .. important:: Achtung: die constants.ts und setup.ts werden vom FTM automatisiert generiert und daher vom System überschrieben.
                                                Für eigenes TYPOScript immer die mit *Custom.ts*-endenden Dateien verwenden!
                                  
``/Initialisation/``             Hier kann man sein Template mit Initial-Daten ausstatten.
                                 Mehr Informationen dazu gibt es hier: `http://wiki.typo3.org/Blueprints/DistributionManagement <http://wiki.typo3.org/Blueprints/DistributionManagement>`_.
``/Documentation/``              Hier liegt die Dokumentation zu diesem Theme
``/Meta/``                       Hier liegen Meta-Informationen zu diesem Theme
``/Resources/``                  Hier liegen alle Resoucen zu diesem Theme.
                                 Diese unterteilen sich in ``Private`` und in ``Public`` Resources und sind in den gleichnamigen Verzeichnissen abgelegt.
                                 Welche Dateien im Detail in diese Verzeichnisse kommen, behandeln wir in den folgenden Abschnitten.
================================ ====================================================================================================================================


--------------------------------------------------------------------
Private-Verzeichnisse
--------------------------------------------------------------------
Im ``/Resources/Private/`` Verzeichnis liegen alle Theme-Dateien, auf die von aussen nicht zugegriffen werden darf.
D.h. Dateien die nicht direkt vom Browser geladen werden.

================================ ====================================================================================================================================
Verzeichnis                      Beschreibung
================================ ====================================================================================================================================
``../Extensions/``               Hier würden alle Private-Dateien zu einer Theme-Extension liegen.
``../Extensions/news``           Das Verzeichnis heißt genauso wie der Extension-Key der jeweiligen Extension.
                                 Die Verzeichnis-Struktur in diesem Verzeichnis ist nach der gleichen Logik aufegbaut wie das ``Private`` Verzeichnis ansich.
``../Extensions/news/Layouts``   Hier liegen alle Fluid Layout-Dateien zur Theme-Extension
``../Extensions/news/Partials``  Hier liegen alle Fluid Partial-Dateien zur Theme-Extension
``../Extensions/news/Templates`` Hier liegen alle Fluid Template-Dateien zur Theme-Extension
``../Language/``                 Hier liegen die Sprach-Dateien zum Theme
``../Layouts/``                  Hier liegen alle Fluid Layout-Dateien zum Theme
``../Partials/``                 Hier liegen alle Fluid Partial-Dateien zum Theme
``../Templates/``                Hier liegen alle Fluid Template-Dateien zum Theme
================================ ====================================================================================================================================



--------------------------------------------------------------------
Public-Verzeichnisse
--------------------------------------------------------------------
Im ``/Resources/Public/`` Verzeichnis liegen alle Theme-Dateien, auf die von aussen zugegriffen werden darf.
D.h. Dateien die direkt vom Browser geladen werden, wie z.B. JavaScript-Dateien, Bilder, etc..

================================ ====================================================================================================================================
Verzeichnis                      Beschreibung
================================ ====================================================================================================================================
``../Contrib/``                  Hier liegen alle fremd Bibliotheken des Theme.
``../Contrib/bootstrap``         Hier würde bspw. Twitter-Bootstrap liegen wenn es im Theme verwendet wird.
``../Contrib/yaml``              Hier würde bspw. YAML liegen wenn es im Theme verwendet wird.
``../Extensions/``               Hier würden alle Public-Dateien zu einer Theme-Extension liegen.
``../Extensions/news``           Das Verzeichnis heißt genauso wie der Extension-Key der jeweiligen Extension.
                                 Die Verzeichnis-Struktur in diesem Verzeichnis ist nach der gleichen Logik aufegbaut wie das ``Public`` Verzeichnis ansich.
``../Extensions/news/Less``      Hier liegen alle Less-Dateien zur Theme-Extension
``../Fonts/``                    Hier liegen alle Web-Fonts des Theme.
``../Icons/``                    Hier liegen alle Icons und Symbole des Theme.
``../Images/``                   Hier liegen alle Bilder des Theme.
``../JavaScript/``               Hier liegen alle JavaScript-Dateien des Theme.
``../Less/``                     Hier liegen alle Less-Dateien des Theme. Auf dieses Verzeichnis gehen wir gleich in der nächsten Tabelle nochmal ein.
``../Sass/``                     Alternativ kann auch Sass verwendet werden. Hier liegen somit alle Sass-Dateien des Theme.
``../Stylesheets/``              Hier liegen alle CSS-Dateien des Theme.
                                 Da standardmäßig nur mit Less gearbeitet wird, wird in diesem Verzeichnis eigentlich nicht direkt gearbeitet.
================================ ====================================================================================================================================

Bei der Less-Verzeichnis ist, anders als bei den anderen Verzeichnissen, die Reihenfolge der Verwendung zu beachten, damit sich die Styles in der richtigen Reihenfolge überschreiben.

.. include:: ./Snippets/ThemeDirectoryStructureLess.rst



--------------------------------------------------------------------
Sonstige Verzeichnisse
--------------------------------------------------------------------
Wie auch in den vorherigen Versionen des FTM werden von allen Dateien die der FTM überschreibt, Backups angelegt.
Diese befinden sich ab Version 1.1.0 im ``/uplodas/tx_ftm/backup/`` Verzeichnis, damit auch diese Dateien außer Reichweite von Redakteuren liegen.


Der Website-Content sollte wie gehabt im fileadmin-Verzeichnis abgelegt werden. 
Hier zu geben wir keine Vorgaben oder Empfehlungen.


--------------------------------------------------------------------
Migration von alten FTM-Templates
--------------------------------------------------------------------
Hier eine kleine Liste was bei der Migration von alten, d.h. vor FTM Version 1.1.0, Templates zu beachten ist:

* ftm_theme_dummy ins /typo3conf/ext/ftm_theme_website kopieren
* Einordnen der Dateien in die jeweiligen Verzeichnisse, bspw.:
  Kompletten Inhalt aus /ftm_alt/3rdParty/yaml nach /ftm_neu/Resources/Public/Contrib/yaml
  Kompletten Inhalt aus /ftm_alt/fluid/templates nach /ftm_neu/Resources/Private/Templates
  Kompletten Inhalt aus /ftm_alt/fluid/layouts nach /ftm_neu/Resources/Private/Layouts
  Kompletten Inhalt aus /ftm_alt/fluid/partials nach /ftm_neu/Resources/Private/Partials
  Kompletten Inhalt aus /ftm_alt/img nach /ftm_neu/Resources/Public/Images
  Kompletten Inhalt aus /ftm_alt/js nach /ftm_neu/Resources/Public/JavaScript
  Kompletten Inhalt aus /ftm_alt/less nach /ftm_neu/Resources/Public/Less
  Kompletten Inhalt aus /ftm_alt/ts nach /ftm_neu/Configuration/TypoScript
  Kompletten Inhalt aus /ftm_alt/ext/felogin/style.less nach /ftm_neu/Resources/Public/Extensions/felogin/Less/style.less
  Kompletten Inhalt aus /ftm_alt/ext/felogin/template.html nach /ftm_neu/Resources/Private/Extensions/felogin/Templates/template.html
  usw.
* In den Less-Dateien die Includes prüfen.
  Bspw.: in der import.less
  @import url(../3rdParty/yaml/core/base.css); ersetzen durch @import url(../Contrib/yaml/core/base.css);
  @import url(../ext/felogin/style.less); ersetzen durch @import url(../Extensions/felogin/Less/style.less);
* Wenn Sie eine @baseUrlImage Less-Variable verwenden, so muss auch diese angepasst werden:
  @{baseUrlTemplate}img/ wird zu @{baseUrlTemplate}Resources/Public/Images/
* Den Template-Datensatz bearbeiten und den Verzeichnis-Namen entsprechend anpassen (ftm_theme_...)
* Abschließen das TYPOScript neu generieren.


.. important:: Der FTM sucht in neuen Versionen nicht mehr nach Templates in Pfaden wie bspw.: ``ftm_theme_bootstrap/template/fluid/``
               Tritt dieser Fall auf, ist vielleicht das TYPOScript noch nicht für die neue Template-Struktur generiert.
               Re/generieren Sie einfach das TYPOScript neu.
               
               



.. include:: ./Snippets/PoweredBy.rst