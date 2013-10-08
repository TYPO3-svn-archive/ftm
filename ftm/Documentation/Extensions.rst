================================
Extensions
================================
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

Das Ergebnis könnte wie folgt aussehen:

.. code-block:: php

    < footer id="areaFooter">
    < div class="ym-wrapper">
    < div class="ym-wbox">
    < f:cObject typoscriptObjectPath="lib.copyright">< /f:cObject>
    < f:cObject typoscriptObjectPath="lib.nav.footer">< /f:cObject>
    < f:cObject typoscriptObjectPath="lib.socialButtons">< /f:cObject>
    < /div>
    < /div>
    < /footer>



--------------------------------------------------------------------
Extensions richtig einbinden
--------------------------------------------------------------------
Hier zeigen wir nun wie man weitere ExtBase-Extensions optimal im Template-System einbinden kann. 
Bspw. ``ftm_ext_shop`` soll in das Template mit dem Namen ``ftm_theme_website``.

1. Im Template-Verzeichnis unter ``Public/Extensions/`` ein eigenes Verzeichnis für die FrontEnd-Dateien anlegen.
Bspw.: ``typo3conf/ext/ftm_theme_website/Resources/Public/Extensions/ftm_ext_shop``.

Hierin können nun ensprechend der benötigten Dateien weitere Verzeichnisse angelegt werden. Dies können Kopien von orginal Extension-Dateien sein, die wir anpassen wollen, aber auch neue Dateien wie z.B. zusätzlich Bilder oder Less-Dateien.

============ ===============================================================================================================================================================================================================================================================================================================================================
Verzeichnis  Beschreibung
============ ===============================================================================================================================================================================================================================================================================================================================================
Less         Dieses Verzeichnis enthält alle Less-Dateien die zu dieser Extension gehören. Hier wir eine Import.less erstellt, welche dann alle Extension Less-Dateien includiert. Diese Import.less-Datei wiederum wird in der ``../Public/Less/import.less`` Datei mit ``@import url(../Extensions/ftm_ext_shop/Less/Import.less);`` eingefügt. 
Images       Hier werden alle Bilder abgelegt, die zu dieser Extension gehören. Das könnte in diesem Beipiel ein Bild vom Warenkorb-Button sein.
usw.
============ ===============================================================================================================================================================================================================================================================================================================================================







.. include:: ./Snippets/PoweredBy.rst


