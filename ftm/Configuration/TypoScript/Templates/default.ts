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
                5170 = Resources/Private/BackendLayouts

                5200 = Resources/Public
                5210 = Resources/Public/Fonts
                5220 = Resources/Public/Icons
                5230 = Resources/Public/Images
                5240 = Resources/Public/JavaScript
                5250 = Resources/Public/Stylesheets
                5260 = Resources/Public/Contrib
                5270 = Resources/Public/Extensions
                # Hier liegen die Bilder der Backend-Layouts
                5280 = Resources/Public/BackendLayouts
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
                # BackendLayouts
                backendLayoutLang {
                    from = /Resources/Private/BackendLayouts/locallang.xml
                    to   = /Resources/Private/BackendLayouts/locallang.xml
                }
                backendLayout001 {
                    from = /Resources/Private/BackendLayouts/Content.ts
                    to   = /Resources/Private/BackendLayouts/Content.ts
                }
                backendLayout002 {
                    from = /Resources/Private/BackendLayouts/ContentMenu.ts
                    to   = /Resources/Private/BackendLayouts/ContentMenu.ts
                }
                backendLayout003 {
                    from = /Resources/Private/BackendLayouts/ContentMenuSidebar.ts
                    to   = /Resources/Private/BackendLayouts/ContentMenuSidebar.ts
                }
                backendLayout004 {
                    from = /Resources/Private/BackendLayouts/ContentSidebar.ts
                    to   = /Resources/Private/BackendLayouts/ContentSidebar.ts
                }
                backendLayout005 {
                    from = /Resources/Private/BackendLayouts/ContentSidebarMenu.ts
                    to   = /Resources/Private/BackendLayouts/ContentSidebarMenu.ts
                }
                backendLayout006 {
                    from = /Resources/Private/BackendLayouts/MenuContent.ts
                    to   = /Resources/Private/BackendLayouts/MenuContent.ts
                }
                backendLayout007 {
                    from = /Resources/Private/BackendLayouts/MenuContentSidebar.ts
                    to   = /Resources/Private/BackendLayouts/MenuContentSidebar.ts
                }
                backendLayout008 {
                    from = /Resources/Private/BackendLayouts/MenuSidebarContent.ts
                    to   = /Resources/Private/BackendLayouts/MenuSidebarContent.ts
                }
                backendLayout009 {
                    from = /Resources/Private/BackendLayouts/SidebarContent.ts
                    to   = /Resources/Private/BackendLayouts/SidebarContent.ts
                }
                backendLayout010 {
                    from = /Resources/Private/BackendLayouts/SidebarContentMenu.ts
                    to   = /Resources/Private/BackendLayouts/SidebarContentMenu.ts
                }
                backendLayout011 {
                    from = /Resources/Private/BackendLayouts/SidebarContent.ts
                    to   = /Resources/Private/BackendLayouts/SidebarMenuContent.ts
                }
                backendLayoutImage001 {
                    from = /Resources/Public/BackendLayouts/Content.jpg
                    to   = /Resources/Public/BackendLayouts/Content.jpg
                }
                backendLayoutImage002 {
                    from = /Resources/Public/BackendLayouts/ContentMenu.jpg
                    to   = /Resources/Public/BackendLayouts/ContentMenu.jpg
                }
                backendLayoutImage003 {
                    from = /Resources/Public/BackendLayouts/ContentMenuSidebar.jpg
                    to   = /Resources/Public/BackendLayouts/ContentMenuSidebar.jpg
                }
                backendLayoutImage004 {
                    from = /Resources/Public/BackendLayouts/ContentSidebar.jpg
                    to   = /Resources/Public/BackendLayouts/ContentSidebar.jpg
                }
                backendLayoutImage005 {
                    from = /Resources/Public/BackendLayouts/ContentSidebarMenu.jpg
                    to   = /Resources/Public/BackendLayouts/ContentSidebarMenu.jpg
                }
                backendLayoutImage006 {
                    from = /Resources/Public/BackendLayouts/MenuContent.jpg
                    to   = /Resources/Public/BackendLayouts/MenuContent.jpg
                }
                backendLayoutImage007 {
                    from = /Resources/Public/BackendLayouts/MenuContentSidebar.jpg
                    to   = /Resources/Public/BackendLayouts/MenuContentSidebar.jpg
                }
                backendLayoutImage008 {
                    from = /Resources/Public/BackendLayouts/MenuSidebarContent.jpg
                    to   = /Resources/Public/BackendLayouts/MenuSidebarContent.jpg
                }
                backendLayoutImage009 {
                    from = /Resources/Public/BackendLayouts/SidebarContent.jpg
                    to   = /Resources/Public/BackendLayouts/SidebarContent.jpg
                }
                backendLayoutImage010 {
                    from = /Resources/Public/BackendLayouts/SidebarContentMenu.jpg
                    to   = /Resources/Public/BackendLayouts/SidebarContentMenu.jpg
                }
                backendLayoutImage011 {
                    from = /Resources/Public/BackendLayouts/SidebarMenuContent.jpg
                    to   = /Resources/Public/BackendLayouts/SidebarMenuContent.jpg
                }
                # Fluid-Layouts
                fluidLayout001 {
                    from = /Resources/Private/Layouts/Default.html
                    to   = /Resources/Private/Layouts/Default.html
                }
                # Fluid-Partials
                fluidPartial001 {
                    from = /Resources/Private/Partials/MainContent.html
                    to   = /Resources/Private/Partials/MainContent.html
                }
                fluidPartial002 {
                    from = /Resources/Private/Partials/MenuContent.html
                    to   = /Resources/Private/Partials/MenuContent.html
                }
                fluidPartial003 {
                    from = /Resources/Private/Partials/SidebarContent.html
                    to   = /Resources/Private/Partials/SidebarContent.html
                }
                # Fluid-Templates
                fluidTemplate001 {
                    from = /Resources/Private/Templates/Content.html
                    to   = /Resources/Private/Templates/Content.html
                }
                fluidTemplate002 {
                    from = /Resources/Private/Templates/ContentMenu.html
                    to   = /Resources/Private/Templates/ContentMenu.html
                }
                fluidTemplate003 {
                    from = /Resources/Private/Templates/ContentMenuSidebar.html
                    to   = /Resources/Private/Templates/ContentMenuSidebar.html
                }
                fluidTemplate004 {
                    from = /Resources/Private/Templates/ContentSidebar.html
                    to   = /Resources/Private/Templates/ContentSidebar.html
                }
                fluidTemplate005 {
                    from = /Resources/Private/Templates/ContentSidebarMenu.html
                    to   = /Resources/Private/Templates/ContentSidebarMenu.html
                }
                fluidTemplate006 {
                    from = /Resources/Private/Templates/MenuContent.html
                    to   = /Resources/Private/Templates/MenuContent.html
                }
                fluidTemplate007 {
                    from = /Resources/Private/Templates/MenuContentSidebar.html
                    to   = /Resources/Private/Templates/MenuContentSidebar.html
                }
                fluidTemplate008 {
                    from = /Resources/Private/Templates/MenuSidebarContent.html
                    to   = /Resources/Private/Templates/MenuSidebarContent.html
                }
                fluidTemplate009 {
                    from = /Resources/Private/Templates/SidebarContent.html
                    to   = /Resources/Private/Templates/SidebarContent.html
                }
                fluidTemplate010 {
                    from = /Resources/Private/Templates/SidebarContentMenu.html
                    to   = /Resources/Private/Templates/SidebarContentMenu.html
                }
                fluidTemplate011 {
                    from = /Resources/Private/Templates/SidebarContent.html
                    to   = /Resources/Private/Templates/SidebarMenuContent.html
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