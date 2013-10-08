================================
TypoScript
================================
Hier findest Du alle Informationen über das TYPOScript im FTM.

.. include:: ./Snippets/TypoScriptWebServiceMessage.rst

--------------------------------------------------------------------
Root-Template
--------------------------------------------------------------------
Das TypoScript Root-Template eines FTM-Templates wird automatisch erstellt, falls keins auf der Seite des Templates gefunden werden kann.
Das generierte Root-Template trägt den Namen *FTM Root-Template*.

**Achtung:** In den Root-Template sollten Sie keine eigenen Einstellungen vornehmen, außer ggf. ein zusätzliches include-static hinzuzufügen!

--------------------------------------------------------------------
Constants
--------------------------------------------------------------------
Beim Erstellen eines neuen FTM-Templates werden automatisch die Dateien constants.ts und constantsCustom.ts erstellt und in das Root-Template eingetragen.

* **constants.ts:** Hier werden vom FTM generierte Konstanten abgelegt.
* **constantsCustom.ts:** Hier können Sie eigene Konstanten definieren, ohne das diese vom FTM überschrieben werden. 

--------------------------------------------------------------------
Setup
--------------------------------------------------------------------
Beim Erstellen eines neuen FTM-Templates werden automatisch die Dateien setup.ts und setupCustom.ts erstellt und in das Root-Template eingetragen.

* **setup.ts:** Hier wird vom FTM generiertes TypoScript abgelegt.
* **setupCustom.ts:** Hier können Sie eigenes TypoScript definieren, ohne das diese vom FTM überschrieben werden. 





.. include:: ./Snippets/PoweredBy.rst


