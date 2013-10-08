================================
Grid-Layouts
================================


--------------------------------------------------------------------
Allgemein
--------------------------------------------------------------------
Je nach dem welchen Template-Typ (Bootstrap oder YAML) ein FTM-Template hat, werden automatisiert Grid-Layouts angelegt.
Das Anlegen geschieht via TYPOScript und würde entsprechend bereits bestehende Grid-Layout Datensätze mit der gleichen uid überschreiben.



--------------------------------------------------------------------
Bootstrap Grid-Layouts
--------------------------------------------------------------------
Hier eine Liste der automatisch angelegten Bootstrap Grid-Layouts:

==== ====================== =========== ===========
uid  Name                   colPos      columns
2000 GridLayout 100         10          12
2001 GridLayout 83-17       11, 15      10, 2
2002 GridLayout 75-25       11, 15      9, 3
2003 GridLayout 66-33       11, 15      8, 4
2004 GridLayout 50-50       11, 15      6, 6
2005 GridLayout 33-66       11, 15      4, 8
2006 GridLayout 25-75       11, 15      3, 9
2007 GridLayout 17-83       11, 15      2, 10
2008 GridLayout 33-33-33    11, 13, 15  4, 4, 4
2009 GridLayout 50-25-25    11, 13, 15  6, 3, 3
2010 GridLayout 25-50-25    11, 13, 15  3, 6, 3
2011 GridLayout 25-25-50    11, 13, 15  3, 3, 6
2012 GridLayout 25-25-25-25 11, 13, 15  3, 3, 3, 3
==== ====================== =========== ===========

Der uid-Bereich für die Bootstrap Grid-Layouts liegt zwischen 2000-2999.
Eigene Bootstrap Grid-Layouts sollten zwischen 2500-2999.
Achten Sie am besten selbst auch darauf, das Sie in Ihren Themes nie zweimal die gleiche uid verwenden.



--------------------------------------------------------------------
YAML Grid-Layouts
--------------------------------------------------------------------
Hier eine Liste der automatisch angelegten YAML Grid-Layouts:

==== ========================== =================== ==============
uid  Name                       colPos              columns
3000 GridLayout 100             10                  12
3001 GridLayout 80-20           11, 15              10, 2
3002 GridLayout 75-25           11, 15              9, 3
3003 GridLayout 66-33           11, 15              8, 4
3004 GridLayout 62-38           11, 15              6, 6
3005 GridLayout 60-40           11, 15              4, 8
3006 GridLayout 50-50           11, 15              6, 6
3007 GridLayout 40-60           11, 15              2, 10
3008 GridLayout 38-62           11, 15              4, 8
3009 GridLayout 33-66           11, 15              4, 8
3010 GridLayout 25-75           11, 15              3, 9
3011 GridLayout 20-80           11, 15              2, 10
3012 GridLayout 60-20-20        11, 13, 15          4, 4, 4
3013 GridLayout 50-25-25        11, 13, 15          4, 4, 4
3014 GridLayout 40-40-20        11, 13, 15          4, 4, 4
3015 GridLayout 40-20-40        11, 13, 15          4, 4, 4
3016 GridLayout 33-33-33        11, 13, 15          4, 4, 4
3017 GridLayout 25-50-25        11, 13, 15          3, 6, 3
3018 GridLayout 25-25-50        11, 13, 15          3, 3, 6
3019 GridLayout 20-60-20        11, 13, 15          3, 6, 3
3020 GridLayout 20-40-40        11, 13, 15          3, 3, 6
3021 GridLayout 20-20-60        11, 13, 15          3, 3, 6
3022 GridLayout 40-20-20-20     11, 12, 14, 15      6, 2, 2, 2
3023 GridLayout 25-25-25-25     11, 12, 14, 15      3, 3, 3, 3
3024 GridLayout 20-40-20-20     11, 12, 14, 15      2, 6, 2, 2
3025 GridLayout 20-20-40-20     11, 12, 14, 15      2, 2, 6, 2
3026 GridLayout 20-20-20-40     11, 12, 14, 15      2, 2, 2, 6
3027 GridLayout 20-20-20-20-20  11, 12, 13, 14, 15  2, 2, 2, 2, 2
==== ========================== =================== ==============

Der uid-Bereich für die YAML Grid-Layouts liegt zwischen 3000-3999.
Eigene YAML Grid-Layouts sollten zwischen 3500-3999.
Achten Sie am besten selbst auch darauf, das Sie in Ihren Themes nie zweimal die gleiche uid verwenden.




.. include:: ./Snippets/PoweredBy.rst

