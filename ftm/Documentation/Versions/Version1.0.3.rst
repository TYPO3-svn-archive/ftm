--------------------------------------------------------------------
FTM - Fluid Template Manager 1.0.3 (Release-Date 2013-04-16) 
--------------------------------------------------------------------
**Aktionen bei einem Update:**

* Datenbank aktualisieren im Extensionmanager
* Typo3-Cache leeren 

**Neuerungen:**

* Konfigurations-Option zum Einbinden der html5.js, wenn DocType HTML5 aktiviert ist
* Automatisches Update des FTM-Root-Templates, wenn Die FTM-Extension aktualisiert wurde
* setup.ts und constants.ts werden nun zusammen generiert. Es ist kein einzelnes Anklicken mehr notwendig
* Optimierung der IRRE-Konfiguration/Logik
* Marker haben viele neue Typen dazu bekommen (bspw. IMAGE, INT, uvm.)
* Folgende Less-Variablen bietet der FTM nun von Haus aus:
    * **@baseUrl** -> bspw. http://www.fluid-template-manager.de
    * **@baseUrlTemplate** -> bspw. http://www.fluid-template-manager.de/fileadmin/templateName/
    * **@fileadminDir** -> bspw. templateName
    * Somit können also auch selbst immer aktuelle Variablen generiert werden, **@baseUrlImage** könnte dann: **@{baseUrlTemplate}img/** oder alternativ: **@{baseUrl}fileadmin/@{fileadminDir}/template/** lauten. 
* Diverse kleinere Erweiterungen 