--------------------------------------------------------------------
FTM - Fluid Template Manager 1.1.0 (Release-Date 2013-10-16) 
--------------------------------------------------------------------
**Aktionen bei einem Update:**

* Typo3-Cache leeren
* Datenbank-Updates durch den Extension-Manager

.. important:: **Achtung:** In dieser Version haben sich viele Änderungen ergeben. Lesen Sie auf jeden Fall die Dokumentation!

**Neuerungen:**

* Bugfix für T3 6.1 - Das GridElements 2.0 include-static wurde nicht automatisch ins FTM Root-Template eingetragen
* Bugfix für T3 6.1.5 - Hier wird nun automatisiert ein Storage für die Extension erstellt, so dass ein Bearbeiten der TYPOScript- und Template-Dateien möglich ist.
* Optimierung der CSS-Classes in den Grid-Elementen
* Twitter Bootstrap 3 Integration
* bootstrap.js via CDN eingebunden
* GridElements-Vorlagen optimiert für Bootstrap 3 für responsive Sites
* Das Template kann nun den Modus Production/Development annehmen. Je nach Mode werden Caching, Compressing, uvm. de-/aktiviert.
* Die Bearbeitung von Fluid-Templates/Layouts/Partials wurde nun in zwei Teile geteilt: Template-Einstellungen bearbeiten; Template-Quellcode bearbeiten
* Überarbeitung des SEO/Meta-Tag Bereichs
* TYPOScript-Generator Erweiterungen und Optimierungen
* JavaScript-Integration für Template-Typen Bootstrap/YAML
* Less-Variablen haben jetzt eine Kategorie
* Das Backend-Modul wurde so umstrukturiert, dass die jeweiligen Bereiche nun sinnvoll in Tabs verteilt sind.
* Diverse kleinere Erweiterungen 