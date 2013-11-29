--------------------------------------------------------------------
FTM - Fluid Template Manager 1.1.1 (Release-Date 2013-10-29) 
--------------------------------------------------------------------
**Aktionen bei einem Update:**

* Typo3-Cache leeren
* Datenbank-Updates durch den Extension-Manager

**Neuerungen:**

* Die generierten TYPOScript-Constants haben nun eine Konstante ``ftmTemplateDir`` in der das Template-Verzeichnis steht. Bspw. ``ftm_theme_website``.
* BugFix: Disclaimer konnte nicht weggeklickt werden.
* Optimierung von Fehlermeldungen
* Bereitstellung von tt_address ExtBase-Objekten, damit mit tt_address-Datensätzen gearbeitet werden kann.
* Exception beim Template erstellen wegen einer fehlenden Übersetzung korrigiert
* Fehlendes Icon auf Tab Fluid-Templates hinzugefügt
* Es wird nun auch eine Less-Variable für den Bild-Pfad automatisch angelegt
* Strukturelle Optimierung bzgl. Page-IDs
* Erweiterung des Session-Objektes für FTM-Extensions
* Erweiterungen am tt_content ExtBase-Objekt