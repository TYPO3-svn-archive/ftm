================================
Mehrsprachigkeit
================================

--------------------------------------------------------------------
Frontend
--------------------------------------------------------------------
Standardmäßig wird die default Language mit in jedes Template gebunden. 
Wird eine weitere Sprache benötigt, so muss diese erst auf der Root-Seite erstellt werden. 
Ist dies geschehen kann man in seine FTM-Konfiguration gehen und diese Sprache dort integrieren. 

Templating
~~~~~~~~~~~~~~~~~~~
Damit bei der Gestaltung der Templates auch im CSS/LESS entsprechend je nach Sprache Direktiven eingefügt werden können, wird bei FTM-Templates die Sprachvariable automatisch in den Body-Tag geschrieben.
So würde der Body-Tag er deutschen Seite mit der Page-Id 69 folgendermaßen aussehen:

.. code-block:: html

    <body id="pid-69" class="language-de">

Der Bezeichner setzt sich also logisch aus dem String **language-** und dem Language-Key *de* zusammen



~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Sprachen-Umschalter
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
@todo: hier eine Verlinkung zu Template Website-Sprachen schaffen



--------------------------------------------------------------------
Backend
--------------------------------------------------------------------
Die FTM-Extension wird momentan in den beiden Sprachen deutsch und englisch bereitgestellt. Welche Sprache verwendet wird, hängt von der verwendeten Backend-User Sprache ab.

Sie sprechen eine bisher noch nicht unterstützte Sprache und wollen der Community etwas zurück geben? 
Wir freuen uns über Ihre Mithilfe den FTM in weitere Sprachen zu übersetzen! 
Schicke einfach eine Mail an info@fluid-template-manager.de. 



.. include:: ./Snippets/PoweredBy.rst