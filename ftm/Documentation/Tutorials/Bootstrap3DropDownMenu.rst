Bootstrap 3 DropDown-Menü
====================================================================
Um ein Bootstrap 3 DropDown-Menü mit dem FTM zu realisieren gehen Sie wie folgt vor.

**1.** Erstellen Sie ein neues Menü namenes *main* und machen Sie die benötigten Einstellungen bzgl. Menütyp, Einstiegslevel, etc.
**2.** Dieses Menü bekommt den Wrap ``<ul class="nav nav-pills" id="lib.nav.main"> | </ul>``.
**3.** Nun erstellen wir ein erstes TMENU wo wir den Haken *Expand Submenus* setzen.
**3.1.** In diesem ersten TMENU erstellen wir nun die folgenden Menü-Zustände in angegebener Reihenfolge:

* NO
* ACT (erbt von NO)
* IFSUB (erbt von NO)
* ACTIFSUB (erbt von NO)

**4.** Nun erstellen wir ein zweites TMENU und geben ihm den wrap ``<ul role="menu" class="dropdown-menu"> | </ul>``.
**4.1. Dieses TMENU bekommt nun die folgenden Menü-Zustände in angegebener Reihenfolge:

* NO
* ACT (erbt von NO)


Zusätzlich brauchen wir noch das folgende TS:

.. code-block:: typoscript
    
    lib.nav.main.1.IFSUB.before = <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    lib.nav.main.1.IFSUB.after = <b class="caret"></b></a>
    lib.nav.main.1.IFSUB.doNotLinkIt = 1
    
    lib.nav.main.1.ACTIFSUB.before = <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    lib.nav.main.1.ACTIFSUB.after = <b class="caret"></b></a>
    lib.nav.main.1.ACTIFSUB.doNotLinkIt = 1

    
.. note:: Einen kleinen Nachteil hat dieses Menü. Die Haupt-Menüpunkte die ein DropDown-Menü bereitstellen, können nicht angeklickt werden.
    Wir können diese also in TYPO3 als Shortcuts auf die erste Unterseite anlegen.
