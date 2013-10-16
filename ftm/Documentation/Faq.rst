================================
FAQ - Frequently asked questions
================================
`Fluid-Template-Manager.de <http://www.fluid-template-manager.de>`_ / `Dokumentation <http://www.fluid-template-manager.de/documentation>`_ / `FAQ - Frequently asked questions <http://fluid-template-manager.de/documentation/Faq.html>`_


Hier finden Sie alle häufig gestellten Fragen. 

----------------------------------------------------------------------------------------------------------------
Was bedeutet die Abkürzung FTM? 
----------------------------------------------------------------------------------------------------------------
FTM bedeutet Fluid-Template-Manager.



----------------------------------------------------------------------------------------------------------------
Was ist mit den Namen Frontend und Backend gemeint?
----------------------------------------------------------------------------------------------------------------
Das Frontend bezeicht alles was man später auf der eigentlichen Webseite sehen kann, also das was Ihre Besucher sehen.
Das Backend bezeichnet die TYPO3-Verwaltungsoberfläche, also das TYPO3-Backend wo Sie ihre Inhalte pflegen.



----------------------------------------------------------------------------------------------------------------
Was passiert wenn der TYPOScript WebService nicht mehr bereitgestellt wird oder nicht verfügbar ist?
----------------------------------------------------------------------------------------------------------------
Der TYPOScript WebService generiert ja lediglich die TYPOScript Dateien.
Wenn nun eine Seite fertig generiert, bzw. fertig entwickelt wurde, hat man ein vollwertiges TYPO3-Template welches auch ohne den FTM nutzbar ist.
Sollten nun Änderungen notwendig sein, kann man diese (so wie man es auch ohne FTM machen würde) einfach per Hand in den jeweiligen Dateien vornehmen.
Der FTM stellt in diesem Sinne nur eine Template-Entwicklungshilfe dar.
Die bereits mit dem FTM entwickelten Projekte wären für den sehr unwahrscheinlichen Fall also nicht verloren.



----------------------------------------------------------------------------------------------------------------
Kann es in Zukunft passieren das der TYPOScript WebService irgendwann einmal Geld kostet?
----------------------------------------------------------------------------------------------------------------
Nein, der TYPOScript WebService soll in der public Version, so wie er jetzt zur Verfügung steht kein Geld kosten - auch in Zukunft nicht. 
Es gibt Planungen das dieser um personalisierte Funktionen, bspw. für Agenturen die spezielle/abweichende Besonderheiten in Ihrem Basis-TYPOScript brauchen, anzubieten. 
Diese würden dann jedoch nicht mehr über einen public-Key laufen, sondern über einen personalisierten Schlüssel. Für alle normalen User bliebe die Funktion wie bisher.
Die öffentliche, freie Nutzung geben wir als Dankeschön an die Community zurück, für all die nützlichen Extensions, etc. die wir auch nutzen dürfen.



----------------------------------------------------------------------------------------------------------------
Ist eine lokale Entwicklung mit dem FTM möglich?
----------------------------------------------------------------------------------------------------------------
Sofern eine Internetverbindung vorhanden ist, und die lokale Umgebung so konfiguriert ist das der WebService-Aufruf eine Verbindung bekommt, sollte einer Offline-Entwicklung nichts im Wege stehen.
Es wird jedoch immer empfohlen bereits auf dem Zielsystem zu entwickeln (bspw. auf einer Dev-Subdomain), damit es bei der Onlinestellung keine Komplikationen gibt weil sich die System-Konfiguration/Funktion unterscheidet.
Gute Entwicklungsumgebungen haben auch bereits schon ein FTP-Programm intergriert mit dem es möglich ist seine online Dateien wir gewohnt lokal zu bearbeiten. 
Nach der Bearbeitung werden diese automatisch synchronisiert und sind online verfügbar.



----------------------------------------------------------------------------------------------------------------
Wie kann ich ein FTM-Template löschen? 
----------------------------------------------------------------------------------------------------------------
1. WEB: Fluid Template Manager anwählen 
2. Template bearbeiten anklicken 
3. Im oberen Seiten-Bereich auf das Mülleimer-Symbol klicken und das Löschen bestätigen 

**Achtung:** Hier wird nur das FTM-Template (sprich der Konfigurations-Datensatz) als gelöscht markiert. Alle Template-Dateien verbleiben auf dem Server und müssen von Hand gelöscht werden.



----------------------------------------------------------------------------------------------------------------
Hilfe, der FTM hat eine Datei überschrieben, wie bekomme ich die alte wieder? 
----------------------------------------------------------------------------------------------------------------
Jedes mal wenn der FTM eine Template-Datei überschreibt, legt er vorher ein Backup im Verzeichnis ``/uploads/tx_ftm/backup/ ab. 
Aus dieser kann einfach der Inhalt zurück kopiert werden.




.. include:: ./Snippets/PoweredBy.rst