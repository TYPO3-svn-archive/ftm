================================
Extensions
================================
`Fluid-Template-Manager.de <http://www.fluid-template-manager.de>`_ / `Dokumentation <http://www.fluid-template-manager.de/documentation>`_ / `Extensions <http://fluid-template-manager.de/documentation/Extensions.html>`_


Hier finden Sie alle Informationen zu den verwendeten bzw. empfohlenen Extensions.

--------------------------------------------------------------------
t3jquery
--------------------------------------------------------------------
Für die Einbindung von jQuery in Typo3 empfehlen wir die Extension t3jquery.
Diese verträgt sich erfahrungsgemäß am besten mit anderen Extensions die ebenfalls jQuery verwenden.

==================  ======================================================================
**Abhängigkeit:**   optional
**Extension-Key:**  t3jquery
**Link:**           http://typo3.org/extensions/repository/view/t3jquery/
==================  ======================================================================



.. include:: ./Extensions/Rzcolorbox.rst


--------------------------------------------------------------------
socialshareprivacy
--------------------------------------------------------------------
Für die Integration von Social-Media Links.

==================  ======================================================================
**Abhängigkeit:**   optional
**Extension-Key:**  socialshareprivacy
**Link:**           http://typo3.org/extensions/repository/view/socialshareprivacy/
==================  ======================================================================

Das folgende Beispiel zeigt wie man die Extensions socialshareprivacy bspw. im Footer platziert. 

1. Die Extension socialshareprivavcy wie gewohnt installieren (include_static nicht vergessen) 
2. Einen Marker im FTM anlegen vom Typ: RECORDS, Marker-Name: socialButtons, Marker-Code:

.. code-block:: php

    source = 18
    tables = tt_content
    wrap = < div id="socialButtons">|< /div>
3. Nun nur noch den Marker entsprechend in den Fluid-Templates einbinden:

.. code-block:: php

    < f:cObject typoscriptObjectPath="lib.socialButtons">< /f:cObject>

Das Ergebnis für ein YAML-Template könnte wie folgt aussehen:

.. code-block:: php

    <footer id="areaFooter">
      <div class="ym-wrapper">
        <div class="ym-wbox">
          <f:cObject typoscriptObjectPath="lib.copyright"></f:cObject>
          <f:cObject typoscriptObjectPath="lib.nav.footer"></f:cObject>
          <f:cObject typoscriptObjectPath="lib.socialButtons"></f:cObject>
        </div>
      </div>
    </footer>



--------------------------------------------------------------------
Extensions richtig einbinden
--------------------------------------------------------------------
Hier zeigen wir nun wie man weitere ExtBase-Extensions optimal im Template-System einbinden kann.

Die meisten ExtBase-Extensions haben Ihre eigenen Templates und die möchte man nun auch entsprechend seinem eigenen Template anpassen.
Dies macht man aber nicht in den original Dateien, sondern man legt Kopien an und bindet diese dann in sein Template ein.

Bspw. soll eine Extension mit dem Key ``ftm_ext_shop`` in das Template mit dem Namen ``ftm_theme_website`` eingebunden werden.
Dazu gehen wir wie folgt vor:

1. Im Template-Verzeichnis unter ``ftm_theme_website/Resources/Public/Extensions/`` muss ein eigenes Verzeichnis für die FrontEnd-Dateien anlegt werden.
Bspw.: ``typo3conf/ext/ftm_theme_website/Resources/Public/Extensions/ftm_ext_shop``.

Hierin können nun entsprechend der benötigten Dateien weitere Verzeichnisse angelegt werden. 
Dies können Kopien von orginal Extension-Dateien sein, die wir anpassen wollen, aber auch neue Dateien wie z.B. zusätzlich Bilder oder Less-Dateien.

============ ===============================================================================================================================================================================================================================================================================================================================================
Verzeichnis  Beschreibung
============ ===============================================================================================================================================================================================================================================================================================================================================
Less         Dieses Verzeichnis enthält alle Less-Dateien die zu dieser Extension gehören. 
             Hier wir eine Import.less erstellt, welche dann alle Extension Less-Dateien includiert. 
             Diese Import.less-Datei wiederum wird in der ``../Public/Less/import.less`` Datei mit ``@import url(../Extensions/ftm_ext_shop/Less/Import.less);`` eingefügt. 
Images       Hier werden alle Bilder abgelegt, die zu dieser Extension gehören. 
             Das könnte in diesem Beipiel ein Bild vom Warenkorb-Button sein.
usw.
============ ===============================================================================================================================================================================================================================================================================================================================================

2. Im Template-Verzeichnis unter ``ftm_theme_website/Resources/Private/Extensions/`` muss ein eigenes Verzeichnis für die Template-Dateien anlegt werden.
Bspw.: ``typo3conf/ext/ftm_theme_website/Resources/Private/Extensions/ftm_ext_shop``.

Hierin können nun entsprechend der benötigten Dateien weitere Verzeichnisse angelegt werden. 
Dies sind im normal Fall Layouts, Templates und Partials.

============ ===============================================================================================================================================================================================================================================================================================================================================
Verzeichnis  Beschreibung
============ ===============================================================================================================================================================================================================================================================================================================================================
Language     Falls wir auch Label übersetzen oder anpassen wollen, muss hier eine Kopie der relevanten Language-Dateien aus ``ftm_ext_shop/Resources/Private/Language`` abgelegt werden. 
Layouts      Hier wird eine komplette Kopie des Layouts-Verzeichnis aus ``ftm_ext_shop/Resources/Private/Layouts`` abgelegt.
Partials     Hier wird eine komplette Kopie des Partials-Verzeichnis aus ``ftm_ext_shop/Resources/Private/Partials`` abgelegt.
Templates    Hier wird eine komplette Kopie des Templates-Verzeichnis aus ``ftm_ext_shop/Resources/Private/Templates`` abgelegt.
============ ===============================================================================================================================================================================================================================================================================================================================================

3. Nun muss dem System nur noch mitgeteilt werden, das die Templates der ``ftm_ext_shop`` Extension nun in unserem Theme-Verzeichnis liegen.
Dies können wir einfach über die folgenden TYPOScript-Constants machen:

.. code-block:: ts

    plugin.tx_ftmextshop {
      view {
        templateRootPath = typo3conf/ext/ftm_theme_website/Resources/Private/Extensions/ftm_ext_shop/Templates/
        partialRootPath  = typo3conf/ext/ftm_theme_website/Resources/Private/Extensions/ftm_ext_shop/Partials/
        layoutRootPath   = typo3conf/ext/ftm_theme_website/Resources/Private/Extensions/ftm_ext_shop/Layouts/
      }
    }

4. Um die eigenen Sprachdateien nutzen zu können, muss man in der ``LocalConfiguration.php`` in einem Knoten ``locallangXMLOverride`` angeben, welche Dateien man anpassen möchte, bspw.:

.. code-block:: php

    'SYS' => array(
        'locallangXMLOverride' => array(
            'EXT:ftm_ext_shop/Resources/Private/Language/locallang.xlf'    => array('EXT:ftm_theme_website/Resources/Private/Extensions/ftm_ext_shop/Language/locallang.xlf'),
            'EXT:ftm_ext_shop/Resources/Private/Language/locallang_db.xlf' => array('EXT:ftm_theme_website/Resources/Private/Extensions/ftm_ext_shop/Language/locallang_db.xlf'),
            /* ..usw. */
        ),



.. include:: ./Snippets/PoweredBy.rst