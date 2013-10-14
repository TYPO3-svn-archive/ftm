================================
TypoScript
================================
Hier findest Du alle Informationen über das TYPOScript im FTM.

.. include:: ./Snippets/TypoScriptWebServiceMessage.rst


--------------------------------------------------------------------
TYPOScript-Generator
--------------------------------------------------------------------

@todo
---- 
Seite über den TYPOScript generator
- was er macht
- welche Daten werden an ihn geschickt -> möglichkeit in FTM bieten, das die gesendeten Daten angesenen werden können.
- werden daten in der cloud gespeichert? -> kann man helfen, in dem man log einschaltet
-

- Mail für Optimierungs-vorschlag

- Anreißen, das man als agentur auch einen personalisierten haben kann


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

@todo: welche Konstanten werden automatisch generiert?

* **constants.ts:** Hier werden vom FTM generierte Konstanten abgelegt.
* **constantsCustom.ts:** Hier können Sie eigene Konstanten definieren, ohne das diese vom FTM überschrieben werden. 

--------------------------------------------------------------------
Setup
--------------------------------------------------------------------
Beim Erstellen eines neuen FTM-Templates werden automatisch die Dateien setup.ts und setupCustom.ts erstellt und in das Root-Template eingetragen.

* **setup.ts:** Hier wird vom FTM generiertes TypoScript abgelegt.
* **setupCustom.ts:** Hier können Sie eigenes TypoScript definieren, ohne das diese vom FTM überschrieben werden. 





.. include:: ./Snippets/PoweredBy.rst