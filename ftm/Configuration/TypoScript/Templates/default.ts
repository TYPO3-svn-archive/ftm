module.tx_ftm.settings {

    # Templates, this array will be readed for
    # the Create-Template actions/options
    # @ToDo: splitten in einzelne Dateien
    templates {
        default {
            directories {
                1000 = Configuration
                1100 = Configuration/PageTS
                1200 = Configuration/TCA
                1300 = Configuration/TypoScript
                1310 = Configuration/TypoScript/Constants
                1320 = Configuration/TypoScript/Library
                1400 = Configuration/UserTS
                2000 = Documentation
                3000 = Initialisation
                3100 = Initialisation/Files
                3200 = Initialisation/Extensions
                4000 = Meta
                5000 = Resources
                5100 = Resources/Private
                5110 = Resources/Private/DynCss
                5111 = Resources/Private/DynCss/Files
                51110 = Resources/Private/DynCss/Files/GridElementLayouts
                51111 = Resources/Private/DynCss/Files/ContentLayouts
                51113 = Resources/Private/DynCss/Files/Variables

                5120 = Resources/Private/Extensions
                5130 = Resources/Private/Language
                5140 = Resources/Private/Layouts
                5150 = Resources/Private/Partials
                5160 = Resources/Private/Templates
                # Hier liegen die Konfigurationen der Backend-Layouts
                #5170 = Resources/Private/BackendLayouts

                5200 = Resources/Public
                5210 = Resources/Public/Fonts
                5220 = Resources/Public/Icons
                5230 = Resources/Public/Images
                5240 = Resources/Public/JavaScript
                5250 = Resources/Public/Stylesheets
                5260 = Resources/Public/Contrib
                5270 = Resources/Public/Extensions
                # Hier liegen die Bilder der Backend-Layouts
                #5280 = Resources/Public/BackendLayouts
            }
            files {
                # Basic-Files
                basic001 {
                    from = /ext_icon.gif
                    to   = /ext_icon.gif
                }
                basic002 {
                    from = /ext_emconf.php
                    to   = /ext_emconf.php
                }
                basic003 {
                    from = /ext_localconf.php
                    to   = /ext_localconf.php
                }
                basic004 {
                    from = /Meta/theme.yaml
                    to   = /Meta/theme.yaml
                }


            }

            # Base for the constants.ts generation
            constants {
                configuration {
                    siteName {
                        comment = cat=metaDefaults; type=string; label= Default author email
                        value   = FTM-Theme
                    }
                    colors {
                        link {
                            comment = cat=siteColors; type=color; label= Link color
                            value   = #FF8700
                        }
                        primary {
                            comment = cat=siteColors; type=color; label= Primary color
                            value   = #FF8700
                        }
                        secondary {
                            comment = cat=siteColors; type=color; label= Secondary color
                            value   = #EFEFEF
                        }
                    }
                    meta {
                        defaults {
                            abstract {
                                comment = cat=metaDefaults; type=string; label= Default abstract
                                value = TYPO3 Bootstrap Theme
                            }
                            keywords {
                                comment = cat=metaDefaults; type=string; label= Default keywords
                                value = TYPO3, Theme, Bootstrap
                            }
                            description {
                                comment = cat=metaDefaults; type=string; label= Default description
                                value = TYPO3 Bootstrap Theme
                            }
                            author {
                                comment = cat=metaDefaults; type=string; label= Default author
                                value = TYPO3 Themes-Team
                            }
                            author_email {
                                comment = cat=metaDefaults; type=string; label= Default author email
                                value = team@typo3-themes.org
                            }
                        }
                        copyright {
                            comment = cat=meta; type=string; label= Copyright
                            value = TYPO3 Themes-Team - www.typo3-themes.org
                        }
                        robots {
                            comment = cat=meta; type=string; label= Robots (for example: noindex,nofollow)
                            value = noindex,nofollow
                        }
                        revisitAfter {
                            comment = cat=meta; type=string; label= Revisit after (for example: 7 days)
                            value = 7 days
                        }
                        applicationName {
                            comment = cat=meta; type=string; label= Application name
                            value = Bootstrap-Theme
                        }
                    }
                    pages {
                        startsite {
                            comment =  cat=page; type=int+; label= Seite für die Home/Startseite
                            value = 1
                        }
                        legal {
                            comment = cat=page; type=int+; label= Seite für die AGB
                            value = 0
                        }
                        privacy {
                            comment = cat=page; type=int+; label= Datenschutz-Seite
                            value = 0
                        }
                        imprint {
                            comment = cat=page; type=int+; label= Impressum-Seite
                            value = 16
                        }
                        contact {
                            comment = cat=page; type=int+; label= Kontakt-Seite
                            value = 0
                        }
                        sitemap {
                            comment = cat=page; type=int+; label= Seite auf der die Sitemap zu finden ist
                            value = 15
                        }
                        search {
                            comment = cat=page; type=int+; label= Seite auf der sich die Suche befindet
                            value = 0
                        }
                        login {
                            comment = cat=page; type=int+; label= Seite auf der man sich einloggt
                            value = 0
                        }
                        logout {
                            comment = cat=page; type=int+; label= Seite auf der man sich ausloggt
                            value = 0
                        }
                        intro {
                            comment = cat=page; type=int+; label= Intro/Landing-Page einer Website
                            value = 0
                        }
                        cookie {
                            comment = cat=page; type=int+; label= Seite auf der man Cookies bestätigen muss
                            value =  0
                        }
                        references {
                            comment = cat=page; type=int+; label= Seite auf der die Referenzen angezeigt werden
                            value =  0
                        }
                    }



                }
            }

        }
    }
}