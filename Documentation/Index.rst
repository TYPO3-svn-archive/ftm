..  Editor configuration
	...................................................
	* utf-8 with BOM as encoding
	* tab indent with 4 characters for code snippet.
	* optional: soft carriage return preferred.

.. Includes roles, substitutions, ...
.. include:: _IncludedDirectives.rst

====================================
Fluid-Template-Manager |extension_version| Documentation
====================================

..  :Extension name: |extension_name|
    :Extension key: |extension_key|
    :Version: 
    :Language: en
    :Author: Thomas Deuling
    :Creation: 2013-07-13
    :Generation: 17:09
    :Licence: Open Content License available from `www.opencontent.org/opl.shtml <http://www.opencontent.org/opl.shtml>`_
    
..  The content of this document is related to TYPO3, a GNU/GPL CMS/Framework available from `www.typo3.org
    <http://www.typo3.org/>`_


Was ist der Fluid-Template-Manager, kurz FTM?
=============================================

Der Fluid Template Manager (kurz FTM) ist ein TYPO3-Backendmodul welches es erlaubt TYPO3-Templates zu generieren, anzupassen und zu verwalten. 
Darüberhinaus ist eine schnelle Austauschbarkeit (sprich Import/Export) des gesamten Templates möglich. 
Auf dieser Seite finden Sie eine ausführliche Hilfe/Dokumentation zum aktuellen FTM. 


Für wen ist der FTM gedacht?
=============================================
Der FTM gibt neuen TYPO3-Entwicklern einen vereinfachten Start bei der Entwicklung von Webseiten,
hilft aber auch den erfahrenen Entwicklern nicht die gleichen stupiden Basis-Codes immer und immer wieder zu schreiben, sondern direkt immer mit der gleichen generierten Basis zu beginnen.
Somit haben alle TYPO3-Themes die gleiche Grundstruktur und jeder Entwickler findet sich schnell darin zurecht.


Wichtige Begriffserklärungen
=============================================
**Template-Struktur**

Ein FTM-Template ist aufgeteilt in ein Template-Extension (Basis-Template genannt) und in einen Konfigurations-Datensatz (Template-Konfiguration).
Dies ermöglicht es ein Template physikalisch in einer Template-Extension aufzubauen und später mit der Konfiguration in verschiedenen Instanzen zu individualisieren.
Somit kann man *ein* Template welches man entworfen hat, für unterschiedliche Kunden nutzen in dem man bspw. die Farbwelten via Less anpasst, Fluid-Marker verändert und vieles mehr.
Ist eine solche Template-Konfiguration entstanden, kann diese einfach via T3D exportiert werden und in einer Versionierung gesichert oder bei einem neuen Projekt als Grundlage dienen.

**Theme**


.. TODO:
    @todo: Oder einen Bereich: Fakten machen, welcher die Vorteile etc des FTM aufweist


Welchen Ansatz verfolgt der FTM
=============================================
**TYPOScript-Generator**
Dadurch das wir die Template-Konfiguration vom Template getrennt haben, sind wir in der Lage aus diesem Konfigurations-Datensatz unser Basis-TYPOScript zu generieren.
Dies ist somit ein deklarativer Ansatz, da Sie in Ihrer Konfiguration nur sagen, was gemacht werden soll, aber nicht wie. 
Der TYPOScript-Generator übernimmt dann für Sie die Arbeit und generiert aus Ihren Anweisungen wie sich Ihr Template verhalten soll ein optimiertes TYPOScript, welches immer die gleichen Strukturen aufweist.

**Vorteile:**

- Man braucht das Basis-TYPOScript nicht immer und immer wieder schreiben, sprich config, meta und tempate-Definitionen liegen direkt vor.
- Menüs haben immer die gleichen Strukturen, CSS-Klassen, etc.. Dadurch kann nur durch Austausch des CSS ein Menü komplett angepasst werden.
- Zum Teil unabhängig von uid/pid, da bspw. die GridElements (und später auch BackendLayouts) über TYPOScript bereitgestellt werden
- Theoretisch wären wir durch die Abstraktion von Template-Dateien und Konfiguration in der Lage, die Konfiguration in TYPOScript2 zu konvertieren und somit das Template (zumindest in Grundzügen) auch für TYPO3 Neos bereitzustellen.


Inhaltsverzeichnis
=============================================

.. toctree::
    :maxdepth: 2
    
    CurrentVersion
    Installation
    FtmOverview
    CreateNewTemplate
    ThemeDirectoryStructure
    Template
    FluidTemplates
    ContentAndRte
    GridLayouts
    FluidMarker
    Menus
    TypoScript
    MultiLanguage
    Css-Less
    Extensions
    Faq
    Troubleshooting
    Versions
    ToDo

.. TODO: STILL TO ADD IN THIS DOCUMENT
    @todo: add section about how screenshots can be automated. Pointer to PhantomJS could be added.
	@todo: explain how documentation can be rendered locally and remotely.
	@todo: explain what files should be versionned and what not (_build, Makefile, conf.py, ...)


.. include:: ./Snippets/PoweredBy.rst

