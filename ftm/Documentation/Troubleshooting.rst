===============
Troubleshooting
===============
Hier finden Sie Lösungsansätze zu häufigen Problemen.
Bitte schauen Sie auch im FAQ-Bereich, vielleicht finden Sie auch dort etwaas zu Ihrem Problem

.. note:: Sollten sich das Problem nicht lösen lassen oder haben Sie einen Bug gefunden, dann klicke `hier <http://forge.typo3.org/projects/show/extension-ftm>`_.

--------------------------------------------------------------------
Die FTM-Links im Backend werden nicht aufgerufen.
--------------------------------------------------------------------
Durch das Extbase-Framework werden die generierten Bezeichner doch meist sehr lang. 
Wenn dazu auch noch PHP mit aktiviertem Sohusin zum Einsatz kommt wird es problematisch. 
Hier müssen die folgenden Einstellungen in der /etc/php5/conf.d/suhosin.ini angepasst werden:

.. code-block:: php

    suhosin.get.max_array_index_length = 128
    suhosin.get.max_name_length = 128
    suhosin.get.max_totalname_length = 256
    suhosin.get.max_value_length = 65536
    suhosin.post.max_array_index_length = 128
    suhosin.post.max_name_length = 128
    suhosin.request.max_array_index_length = 128
    suhosin.request.max_varname_length = 128 

Achtung: Nicht vergessen den Apache danach neu zu starten. Nun sollten alle Links aufgerufen und auch korrekt dispatched werden. 

--------------------------------------------------------------------
Beim Aufrufen des FTM im Backend erhalten Sie einen Fehler
--------------------------------------------------------------------
Beim Aufrufen des FTM im Backend erhalten Sie die Fehlermeldung:

.. code-block:: php
    
    Oops, an error occurred!
    Extension configuration isnt valid! pluginCloudHost not found! Default value is plugincloud.de.
    More information regarding this error might be available online.

Lösung: Bei der Extension-Installation wurde die Konfiguration nicht nochmals gespeichert. Um die Konfiguration nun zu speichern, gehen Sie unter "Erweiterungen" auf den "FTM" und klicken dort unter dem Reiter "Konfiguration" auf den Button "Aktualisieren". Abschließend sollte der Cache gelöscht werden.



--------------------------------------------------------------------
Beim editieren von TYPOScript-Dateien erhalten Sie einen Fehler
--------------------------------------------------------------------
Beim editieren von TYPOScript-Dateien erhalten Sie die folgende Meldung:

-- code-block:: php

    This filetype cannot be edited.
    The file must have an extension like:
    
    txt,html,htm,css,tmpl,js,sql,xml,csv,php,php3,php4,php5,php6,phpsh,inc,phtml,rst,py

.. include:: ./Snippets/LocalConfigurationAllowedFiles.rst








.. include:: ./Snippets/PoweredBy.rst


 