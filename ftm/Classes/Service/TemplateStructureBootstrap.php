<?php
namespace CodingMs\Ftm\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Managed alle Aktionen rund um Bootstrap-Datensaetze
 *
 * @package ftm
 * @subpackage Service
 */
class TemplateStructureBootstrap extends TemplateStructure {
    
    protected $fluidLayouts = array(
        'Default'   => 'Default.html',
        'Empty'     => 'Empty.html',
        'Startsite' => 'Startsite.html',
    );
    
    protected $fluidTemplates = array(
        'Content'            => 'Content.html',
        'ContentMenu'        => 'ContentMenu.html',
        'ContentMenuSidebar' => 'ContentMenuSidebar.html',
        'ContentSidebar'     => 'ContentSidebar.html',
        'ContentSidebarMenu' => 'ContentSidebarMenu.html',
        'Empty'              => 'Empty.html',
        'MenuContent'        => 'MenuContent.html',
        'MenuContentSidebar' => 'MenuContentSidebar.html',
        'MenuSidebarContent' => 'MenuSidebarContent.html',
        'SidebarContent'     => 'SidebarContent.html',
        'SidebarContentMenu' => 'SidebarContentMenu.html',
        'SidebarMenuContent' => 'SidebarMenuContent.html',
        'Special'            => 'Special.html',
        'Startsite'          => 'Startsite.html',
    );
    
    protected $fluidPartials = array(
        'MainContent'    => 'MainContent.html',
        'MenuContent'    => 'MenuContent.html',
        'QuickSearch'    => 'QuickSearch.html',
        'SidebarContent' => 'SidebarContent.html',
    );
    
    protected $lessFiles = array(
        'bootstrap.less'   => 'bootstrap.less',
        'import.less'      => 'import.less',
        
        'Areas/extended.less' => 'Areas/extended.less',
        'Areas/footer.less'   => 'Areas/footer.less',
        'Areas/header.less'   => 'Areas/header.less',
        'Areas/main.less'     => 'Areas/main.less',
        'Areas/nav.less'      => 'Areas/nav.less',
        'Areas/top.less'      => 'Areas/top.less',
        'Areas/teaser.less'   => 'Areas/teaser.less',
        
        'BasicLayout/layout.less'     => 'BasicLayout/layout.less',
        'BasicLayout/print.less'      => 'BasicLayout/print.less',
        'BasicLayout/typography.less' => 'BasicLayout/typography.less',
        
        'BasicLess/mixins.less'       => 'BasicLess/mixins.less',
        'BasicLess/mixinsCustom.less' => 'BasicLess/mixinsCustom.less',
        'BasicLess/rteFrontend.less'  => 'BasicLess/rteFrontend.less',
        'BasicLess/variables.less'    => 'BasicLess/variables.less',
        
        'Layouts/default.less'   => 'Layouts/default.less',
        'Layouts/empty.less'     => 'Layouts/empty.less',
        'Layouts/startsite.less' => 'Layouts/startsite.less',
        
        'Partials/mainContent.less' => 'Partials/mainContent.less',
        'Partials/menuContent.less' => 'Partials/menuContent.less',
        'Partials/quickSearch.less' => 'Partials/quickSearch.less',
        'Partials/sideContent.less' => 'Partials/sideContent.less',
        
        'Templates/c.less'         => 'Templates/c.less',
        'Templates/cm.less'        => 'Templates/cm.less',
        'Templates/cms.less'       => 'Templates/cms.less',
        'Templates/cs.less'        => 'Templates/cs.less',
        'Templates/csm.less'       => 'Templates/csm.less',
        'Templates/empty.less'     => 'Templates/empty.less',
        'Templates/mc.less'        => 'Templates/mc.less',
        'Templates/mcs.less'       => 'Templates/mcs.less',
        'Templates/msc.less'       => 'Templates/msc.less',
        'Templates/sc.less'        => 'Templates/sc.less',
        'Templates/scm.less'       => 'Templates/scm.less',
        'Templates/smc.less'       => 'Templates/smc.less',
        'Templates/special.less'   => 'Templates/special.less',
        'Templates/startsite.less' => 'Templates/startsite.less',
        
    );
    
    protected $lessVariables = array(
        array('Basis Url für die Bilder',                                                               'baseUrlImage',                   '', 'string', ' ',                                ' ',       '@{baseUrlTemplate}Resources/Public/Images/'),
        
        
        //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Grays: gray-darker',                                                                     'gray-darker',                    'Grays',       'value',  'lighten(#000, 13.5%)',     '',       ''),
        // array('Grays: gray-dark',                                                                       'gray-dark',                      'Grays',       'value',  'lighten(#000, 20%)',       '',       ''),
        // array('Grays: gray',                                                                            'gray',                           'Grays',       'value',  'lighten(#000, 33.5%)',     '',       ''),
        // array('Grays: gray-light',                                                                      'gray-light',                     'Grays',       'value',  'lighten(#000, 60%)',       '',       ''),
        // array('Grays: gray-lighter',                                                                    'gray-lighter',                   'Grays',       'value',  'lighten(#000, 93.5%)',     '',       ''),
        
        //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        array('Brand colors: brand-primary',                                                            'brand-primary',                  'Brand colors',       'color',  '',     '#428bca',       ''),
        array('Brand colors: brand-success',                                                            'brand-success',                  'Brand colors',       'color',  '',     '#5cb85c',       ''),
        array('Brand colors: brand-warning',                                                            'brand-warning',                  'Brand colors',       'color',  '',     '#f0ad4e',       ''),
        array('Brand colors: brand-danger',                                                             'brand-danger',                   'Brand colors',       'color',  '',     '#d9534f',       ''),
        array('Brand colors: brand-info',                                                               'brand-info',                     'Brand colors',       'color',  '',     '#5bc0de',       ''),
        
        //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        array('Scaffolding: body-bg',                                                                   'body-bg',                        'Scaffolding',       'color',  '',           '#fff',       ''),
        array('Scaffolding: text-color',                                                                'text-color',                     'Scaffolding',       'value',  '@gray-dark', '',           ''),
        
        //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        array('Links: link-color',                                                                      'link-color',                     'Links',       'value',  '@brand-primary',           '',       ''),
        array('Links: link-hover-color',                                                                'link-hover-color',               'Links',       'value',  'darken(@link-color, 15%)', '',       ''),
        
        //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        array('Typography: font-family-sans-serif',                                                     'font-family-sans-serif',         'Typography',       'value',  '"Helvetica Neue", Helvetica, Arial, sans-serif',           '',       ''),
        array('Typography: font-family-serif',                                                          'font-family-serif',              'Typography',       'value',  'Georgia, "Times New Roman", Times, serif', '',       ''),
        array('Typography: font-family-monospace',                                                      'font-family-monospace',          'Typography',       'value',  'Monaco, Menlo, Consolas, "Courier New", monospace',           '',       ''),
        array('Typography: font-family-base',                                                           'font-family-base',               'Typography',       'value',  '@font-family-sans-serif', '',       ''),
        
        array('Typography: font-size-base',                                                             'font-size-base',                 'Typography',       'value',  '14px',           '',       ''),
        array('Typography: font-size-large (~18px)',                                                    'font-size-large',                'Typography',       'value',  'ceil(@font-size-base * 1.25)', '',       ''),
        array('Typography: font-size-small (~12px)',                                                    'font-size-small',                'Typography',       'value',  'ceil(@font-size-base * 0.85)',           '',       ''),
        
        array('Typography: line-height-base (20/14)',                                                   'line-height-base',               'Typography',       'value',  '1.428571429',           '',       ''),
        array('Typography: line-height-computed (~20px)',                                               'line-height-computed',           'Typography',       'value',  'floor(@font-size-base * @line-height-base)', '',       ''),
        
        array('Typography: headings-font-family',                                                       'headings-font-family',           'Typography',       'value',  '@font-family-base',           '',       ''),
        array('Typography: headings-font-weight',                                                       'headings-font-weight',           'Typography',       'value',  '500', '',       ''),
        array('Typography: headings-line-height',                                                       'link-color',                     'Typography',       'value',  '1.1',           '',       ''),
        
        //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Iconography: icon-font-path',                                                            'icon-font-path',                 'Iconography',       'value',  '../fonts/',           '',       ''),
        // array('Iconography: icon-font-name',                                                            'icon-font-name',                 'Iconography',       'value',  'glyphicons-halflings-regular', '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Components: padding-base-vertical',                                                      'padding-base-vertical',          'Components',       'value',  '6px',            '',       ''),
        // array('Components: padding-base-horizontal',                                                    'padding-base-horizontal',        'Components',       'value',  '12px',           '',       ''),
//         
        // array('Components: padding-large-vertical',                                                     'padding-large-vertical',         'Components',       'value',  '10px',           '',       ''),
        // array('Components: padding-large-horizontal',                                                   'padding-large-horizontal',       'Components',       'value',  '16px',           '',       ''),
//         
        // array('Components: padding-small-vertical',                                                     'padding-small-vertical',         'Components',       'value',  '5px',            '',       ''),
        // array('Components: padding-small-horizontal',                                                   'padding-small-horizontal',       'Components',       'value',  '10px',           '',       ''),
//         
        // array('Components: line-height-large',                                                          'line-height-large',              'Components',       'value',  '1.33',           '',       ''),
        // array('Components: line-height-small',                                                          'line-height-small',              'Components',       'value',  '1.5',            '',       ''),
//         
        // array('Components: border-radius-base',                                                         'border-radius-base',             'Components',       'value',  '4px',            '',       ''),
        // array('Components: border-radius-large',                                                        'border-radius-large',            'Components',       'value',  '6px',            '',       ''),
        // array('Components: border-radius-small',                                                        'border-radius-small',            'Components',       'value',  '3px',            '',       ''),
//         
        // array('Components: component-active-bg',                                                        'component-active-bg',            'Components',       'value',  '@brand-primary', '',       ''),
//         
        // array('Components: caret-width-base',                                                           'caret-width-base',               'Components',       'value',  '4px',            '',       ''),
        // array('Components: caret-width-large',                                                          'caret-width-large',              'Components',       'value',  '5px',            '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Tables: table-cell-padding',                                                             'table-cell-padding',             'Tables',       'value',  '8px',             '',              ''),
        // array('Tables: table-condensed-cell-padding',                                                   'table-condensed-cell-padding',   'Tables',       'value',  '5px',             '',              ''),
//         
        // array('Tables: table-bg (overall background-color)',                                            'table-bg',                       'Tables',       'value',  'transparent',     '',              ''),
        // array('Tables: table-bg-accent (for striping)',                                                 'table-bg-accent',                'Tables',       'color',  '',                '#f9f9f9',       ''),
        // array('Tables: table-bg-hover',                                                                 'table-bg-hover',                 'Tables',       'color',  '',                '#f5f5f5',       ''),
        // array('Tables: table-bg-active',                                                                'table-bg-active',                'Tables',       'value',  '@table-bg-hover', '',              ''),
//         
        // array('Tables: table-border-color (table and cell border)',                                     'table-border-color',             'Tables',       'color',  '',                '#ddd',          ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                           Color     String
        // array('Buttons: btn-font-weight',                                                               'btn-font-weight',                 'Buttons',      'value',  'normal',                      '',       ''),
//         
        // array('Buttons: btn-default-color',                                                             'btn-default-color',               'Buttons',      'color',  '',                            '#333',   ''),
        // array('Buttons: btn-default-bg',                                                                'btn-default-bg',                  'Buttons',      'color',  '',                            '#fff',   ''),
        // array('Buttons: btn-default-border',                                                            'btn-default-border',              'Buttons',      'color',  '',                            '#ccc',   ''),
//         
        // array('Buttons: btn-primary-color',                                                             'btn-primary-color',               'Buttons',      'color',  '',                            '#fff',   ''),
        // array('Buttons: btn-primary-bg',                                                                'btn-primary-bg',                  'Buttons',      'value',  '@brand-primary',              '',       ''),
        // array('Buttons: btn-primary-border',                                                            'btn-primary-border',              'Buttons',      'value',  'darken(@btn-primary-bg, 5%)', '',       ''),
//         
        // array('Buttons: btn-success-color',                                                             'btn-success-color',               'Buttons',      'color',  '',                            '#fff',   ''),
        // array('Buttons: btn-success-bg',                                                                'btn-success-bg',                  'Buttons',      'value',  '@brand-success',              '',       ''),
        // array('Buttons: btn-success-border',                                                            'btn-success-border',              'Buttons',      'value',  'darken(@btn-success-bg, 5%)', '',       ''),
//         
        // array('Buttons: btn-warning-color',                                                             'btn-warning-color',               'Buttons',      'color',  '',                            '#fff',   ''),
        // array('Buttons: btn-warning-bg',                                                                'btn-warning-bg',                  'Buttons',      'value',  '@brand-warning',              '',       ''),
        // array('Buttons: btn-warning-border',                                                            'btn-warning-border',              'Buttons',      'value',  'darken(@btn-warning-bg, 5%)', '',       ''),
//         
        // array('Buttons: btn-danger-color',                                                              'btn-danger-color',                'Buttons',      'color',  '',                            '#fff',   ''),
        // array('Buttons: btn-danger-bg',                                                                 'btn-danger-bg',                   'Buttons',      'value',  '@brand-danger',               '',       ''),
        // array('Buttons: btn-danger-border',                                                             'btn-danger-border',               'Buttons',      'value',  'darken(@btn-danger-bg, 5%)',  '',       ''),
//         
        // array('Buttons: btn-info-color',                                                                'btn-info-color',                  'Buttons',      'color',  '',                            '#fff',   ''),
        // array('Buttons: btn-info-bg',                                                                   'btn-info-bg',                     'Buttons',      'value',  '@brand-info',                 '',       ''),
        // array('Buttons: btn-info-border',                                                               'btn-info-border',                 'Buttons',      'value',  'darken(@btn-info-bg, 5%)',    '',       ''),
//         
        // array('Buttons: btn-link-disabled-color',                                                       'btn-link-disabled-color',         'Buttons',      'value',  '@gray-light',                 '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                                                                                   Color     String
        // array('Forms: input-bg',                                                                         'input-bg',                       'Forms',       'color',  '',                                                                                     '#FFF',   ''),
        // array('Forms: input-bg-disabled',                                                                'input-bg-disabled',              'Forms',       'value',  '@gray-lighter',                                                                        '',       ''),
//         
        // array('Forms: input-color',                                                                      'input-color',                    'Forms',       'value',  '@gray',                                                                                '',       ''),
        // array('Forms: input-border',                                                                     'input-border',                   'Forms',       'color',  '',                                                                                     '#ccc',       ''),
        // array('Forms: input-border-radius',                                                              'input-border-radius',            'Forms',       'value',  '@border-radius-base',                                                                  '',       ''),
        // array('Forms: input-border-focus',                                                               'input-border-focus',             'Forms',       'color',  '',                                                                                     '#66afe9',       ''),
//         
        // array('Forms: input-color-placeholder',                                                          'input-color-placeholder',        'Forms',       'value',  '@gray-light',                                                                          '',       ''),
//         
        // array('Forms: input-height-base',                                                                'input-height-base',              'Forms',       'value',  '(@line-height-computed + (@padding-base-vertical * 2) + 2)',                           '',       ''),
        // array('Forms: input-height-large',                                                               'input-height-large',             'Forms',       'value',  '(floor(@font-size-large * @line-height-large) + (@padding-large-vertical * 2) + 2)',   '',       ''),
        // array('Forms: input-height-small',                                                               'input-height-large',             'Forms',       'value',  '(floor(@font-size-small * @line-height-small) + (@padding-small-vertical * 2) + 2)',   '',       ''),
//         
        // array('Forms: legend-color',                                                                     'legend-color',                   'Forms',       'value',  '@gray-dark',                                                                           '',       ''),
        // array('Forms: legend-border-color',                                                              'legend-border-color',            'Forms',       'color',  '',                                                                                     '#e5e5e5',       ''),
//         
        // array('Forms: input-group-addon-bg',                                                             'input-group-addon-bg',           'Forms',       'value',  '@gray-lighter',                                                                        '',       ''),
        // array('Forms: input-group-addon-border-color',                                                   'input-group-addon-border-color', 'Forms',       'color',  '@input-border',                                                                        '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                    Color          String
        // array('Dropdowns: dropdown-bg',                                                                  'dropdown-bg',                    'Dropdowns',   'color',  '',                         '#fff',     ''),
        // array('Dropdowns: dropdown-border',                                                              'dropdown-border',                'Dropdowns',   'value',  'rgba(0,0,0,.15)',          '',         ''),
        // array('Dropdowns: dropdown-fallback-border',                                                     'dropdown-fallback-border',       'Dropdowns',   'value',  '',                         '#ccc',     ''),
        // array('Dropdowns: dropdown-divider-bg',                                                          'dropdown-divider-bg',            'Dropdowns',   'color',  '',                         '#e5e5e5',  ''),
//         
        // array('Dropdowns: dropdown-link-active-color',                                                   'dropdown-link-active-color',     'Dropdowns',   'color',  '',                         '#fff',     ''),
        // array('Dropdowns: dropdown-link-active-bg',                                                      'dropdown-link-active-bg',        'Dropdowns',   'value',  '@component-active-bg',     '',         ''),
//         
        // array('Dropdowns: dropdown-link-color',                                                          'dropdown-link-color',            'Dropdowns',   'value',  '@gray-dark',               '',         ''),
        // array('Dropdowns: dropdown-link-hover-color',                                                    'dropdown-link-hover-color',      'Dropdowns',   'color',  '',                         '#fff',     ''),
        // array('Dropdowns: dropdown-link-hover-bg',                                                       'dropdown-link-hover-bg',         'Dropdowns',   'value',  '@dropdown-link-active-bg', '',         ''),
//         
        // array('Dropdowns: dropdown-link-disabled-color',                                                 'dropdown-link-disabled-color',   'Dropdowns',   'value',  '@gray-light',              '',         ''),
//         
        // array('Dropdowns: dropdown-header-color',                                                        'dropdown-header-color',          'Dropdowns',   'value',  '@gray-light',              '',         ''),
//         
        // array('Dropdowns: dropdown-caret-color',                                                         'dropdown-caret-color',           'Dropdowns',   'color',  '',                         '#000',     ''),
//         
        // //     Name                                                                                      Variable                           Kategorie                Typ       Value                    Color           String
        // array('Z-index master list: zindex-navbar',                                                      'zindex-navbar',                   'Z-index master list',   'value',  '1000',                      '',             ''),
        // array('Z-index master list: zindex-dropdown',                                                    'zindex-dropdown',                 'Z-index master list',   'value',  '1000',                      '',             ''),
        // array('Z-index master list: zindex-popover',                                                     'zindex-popover',                  'Z-index master list',   'value',  '1010',                      '',             ''),
        // array('Z-index master list: zindex-tooltip',                                                     'zindex-tooltip',                  'Z-index master list',   'value',  '1030',                      '',             ''),
        // array('Z-index master list: zindex-navbar-fixed',                                                'zindex-navbar-fixed',             'Z-index master list',   'value',  '1030',                      '',             ''),
        // array('Z-index master list: zindex-modal-background',                                            'zindex-modal-background',         'Z-index master list',   'value',  '1040',                      '',             ''),
        // array('Z-index master list: zindex-modal',                                                       'zindex-modal',                    'Z-index master list',   'value',  '1050',                      '',             ''),
//         
        // //     Name                                                                                      Variable                           Kategorie                        Typ       Value                    Color           String
        // array('Media queries breakpoints: screen-xs',                                                    'screen-xs',                       'Media queries breakpoints',     'value',  '480px',                 '',             ''),
        // array('Media queries breakpoints: screen-phone',                                                 'screen-phone',                    'Media queries breakpoints',     'value',  '@screen-xs',            '',             ''),
//         
        // array('Media queries breakpoints: screen-sm',                                                    'screen-sm',                       'Media queries breakpoints',     'value',  '768px',                 '',             ''),
        // array('Media queries breakpoints: screen-tablet',                                                'screen-tablet',                   'Media queries breakpoints',     'value',  '@screen-sm',            '',             ''),
//         
        // array('Media queries breakpoints: screen-md',                                                    'screen-md',                       'Media queries breakpoints',     'value',  '992px',                 '',             ''),
        // array('Media queries breakpoints: screen-desktop',                                               'screen-desktop',                  'Media queries breakpoints',     'value',  '@screen-md',            '',             ''),
//         
        // array('Media queries breakpoints: screen-lg',                                                    'screen-lg',                       'Media queries breakpoints',     'value',  '1200px',                '',             ''),
        // array('Media queries breakpoints: screen-lg-desktop',                                            'screen-lg-desktop',               'Media queries breakpoints',     'value',  '@screen-lg',            '',             ''),
//         
        // array('Media queries breakpoints: screen-xs-max',                                                'screen-xs-max',                   'Media queries breakpoints',     'value',  '(@screen-sm - 1)',      '',             ''),
        // array('Media queries breakpoints: screen-sm-max',                                                'screen-sm-max',                   'Media queries breakpoints',     'value',  '(@screen-md - 1)',      '',             ''),
        // array('Media queries breakpoints: screen-md-max',                                                'screen-md-max',                   'Media queries breakpoints',     'value',  '(@screen-lg - 1)',      '',             ''),
//         
        // //     Name                                                                                      Variable                           Kategorie                        Typ       Value                    Color           String
        // array('Grid system: grid-columns',                                                               'grid-columns',                    'Grid system',                   'value',  '12',                    '',             ''),
        // array('Grid system: grid-gutter-width',                                                          'grid-gutter-width',               'Grid system',                   'value',  '30px',                  '',             ''),
        // array('Grid system: grid-float-breakpoint',                                                      'grid-float-breakpoint',           'Grid system',                   'value',  '@screen-tablet',        '',             ''),
//         
        // //     Name                                                                                      Variable                               Kategorie                        Typ       Value                                Color           String
        // array('Navbar: navbar-height',                                                                   'navbar-height',                               'Navbar',                        'value',  '50px',                                              '',             ''),
        // array('Navbar: navbar-margin-bottom',                                                            'navbar-margin-bottom',                        'Navbar',                        'value',  '@line-height-computed',                             '',             ''),
        // array('Navbar: navbar-default-color',                                                            'navbar-default-color',                        'Navbar',                        'color',  '',                                                  '#777',         ''),
        // array('Navbar: navbar-default-bg',                                                               'navbar-default-bg',                           'Navbar',                        'color',  '',                                                  '#f8f8f8',      ''),
        // array('Navbar: navbar-default-border',                                                           'navbar-default-border',                       'Navbar',                        'value',  'darken(@navbar-default-bg, 6.5%)',                  '',             ''),
        // array('Navbar: navbar-default-radius',                                                           'navbar-default-radius',                       'Navbar',                        'value',  '@border-radius-base',                               '',             ''),
        // array('Navbar: navbar-padding-horizontal',                                                       'navbar-padding-horizontal',                   'Navbar',                        'value',  'floor(@grid-gutter-width / 2)',                     '',             ''),
        // array('Navbar: navbar-padding-vertical',                                                         'navbar-padding-vertical',                     'Navbar',                        'value',  '((@navbar-height - @line-height-computed) / 2)',    '',             ''),
//         
        // array('Navbar: navbar-default-link-color',                                                       'navbar-default-link-color',                   'Navbar',                        'color',  '',                                                  '#777',         ''),
        // array('Navbar: navbar-default-link-hover-color',                                                 'navbar-default-link-hover-color',             'Navbar',                        'color',  '',                                                  '#333',         ''),
        // array('Navbar: navbar-default-link-hover-bg',                                                    'navbar-default-link-hover-bg',                'Navbar',                        'value',  'transparent',                                       '',             ''),
        // array('Navbar: navbar-default-link-active-color',                                                'navbar-default-link-active-color',            'Navbar',                        'color',  '',                                                  '#555',         ''),
        // array('Navbar: navbar-default-link-active-bg',                                                   'navbar-default-link-active-bg',               'Navbar',                        'value',  'darken(@navbar-default-bg, 6.5%)',                  '',             ''),
        // array('Navbar: navbar-default-link-disabled-color',                                              'navbar-default-link-disabled-color',          'Navbar',                        'color',  '',                                                  '#ccc',             ''),
        // array('Navbar: navbar-default-link-disabled-bg',                                                 'navbar-default-link-disabled-bg',             'Navbar',                        'value',  'transparent',                                       '',             ''),
//         
        // array('Navbar: navbar-default-brand-color',                                                      'navbar-default-brand-color',                  'Navbar',                        'value',  '@navbar-default-link-color',                        '',             ''),
        // array('Navbar: navbar-default-brand-hover-color',                                                'navbar-default-brand-hover-color',            'Navbar',                        'value',  'darken(@navbar-default-link-color, 10%)',           '',             ''),
        // array('Navbar: navbar-default-brand-hover-bg',                                                   'navbar-default-brand-hover-bg',               'Navbar',                        'value',  'transparent',                                       '',             ''),
//         
        // array('Navbar: navbar-default-toggle-hover-bg',                                                  'navbar-default-toggle-hover-bg',              'Navbar',                        'color',  '',                                                  '#ddd',         ''),
        // array('Navbar: navbar-default-toggle-icon-bar-bg',                                               'navbar-default-toggle-icon-bar-bg',           'Navbar',                        'color',  '',                                                  '#ccc',         ''),
        // array('Navbar: navbar-default-toggle-border-color',                                              'navbar-default-toggle-border-color',          'Navbar',                        'color',  '',                                                  '#ddd',         ''),
//         
        // array('Navbar: navbar-inverse-color',                                                            'navbar-inverse-color',                        'Navbar',                        'value',  '@gray-light',                                       '',             ''),
        // array('Navbar: navbar-inverse-bg',                                                               'navbar-inverse-bg',                           'Navbar',                        'color',  '',                                                  '#222',         ''),
        // array('Navbar: navbar-inverse-border',                                                           'navbar-inverse-border',                       'Navbar',                        'value',  'darken(@navbar-inverse-bg, 10%)',                   '',             ''),
//         
        // array('Navbar: navbar-inverse-link-color',                                                       'navbar-inverse-link-color',                   'Navbar',                        'value',  '@gray-light',                                       '',             ''),
        // array('Navbar: navbar-inverse-link-hover-color',                                                 'navbar-inverse-link-hover-color',             'Navbar',                        'color',  '',                                                  '',             ''),
        // array('Navbar: navbar-inverse-link-hover-bg',                                                    'navbar-inverse-link-hover-bg',                'Navbar',                        'value',  'transparent',                                       '',             ''),
        // array('Navbar: navbar-inverse-link-active-color',                                                'navbar-inverse-link-active-color',            'Navbar',                        'value',  '@navbar-inverse-link-hover-color',                  '',             ''),
        // array('Navbar: navbar-inverse-link-active-bg',                                                   'navbar-inverse-link-active-bg',               'Navbar',                        'value',  'darken(@navbar-inverse-bg, 10%)',                   '',             ''),
        // array('Navbar: navbar-default-link-disabled-color',                                              'navbar-default-link-disabled-color',          'Navbar',                        'color',  '',                                                  '#444',         ''),
        // array('Navbar: navbar-inverse-link-disabled-bg',                                                 'navbar-inverse-link-disabled-bg',             'Navbar',                        'value',  'transparent',                                       '',             ''),
//         
        // array('Navbar: navbar-inverse-brand-color',                                                      'navbar-inverse-brand-color',                  'Navbar',                        'value',  '@navbar-inverse-link-color',                        '',             ''),
        // array('Navbar: navbar-inverse-brand-hover-color',                                                'navbar-inverse-brand-hover-color',            'Navbar',                        'color',  '#fff',                                              '',             ''),
        // array('Navbar: navbar-inverse-brand-hover-bg',                                                   'navbar-inverse-brand-hover-bg',               'Navbar',                        'value',  'transparent',                                       '',             ''),
//         
        // array('Navbar: navbar-inverse-search-bg',                                                        'navbar-inverse-search-bg',                    'Navbar',                        'value',  'lighten(@navbar-inverse-bg, 25%)',                  '',             ''),
        // array('Navbar: navbar-inverse-search-bg-focus',                                                  'navbar-inverse-search-bg-focus',              'Navbar',                        'color',  '',                                                  '#fff',             ''),
        // array('Navbar: navbar-inverse-search-border',                                                    'navbar-inverse-search-border',                'Navbar',                        'value',  '@navbar-inverse-bg',                                '',             ''),
        // array('Navbar: navbar-inverse-search-placeholder-color',                                         'navbar-inverse-search-placeholder-color',     'Navbar',                        'value',  '',                                                  '#ccc',             ''),
//         
        // array('Navbar: navbar-inverse-toggle-hover-bg',                                                  'navbar-inverse-toggle-hover-bg',              'Navbar',                        'color',  '',                                                  '#333',             ''),
        // array('Navbar: navbar-inverse-toggle-icon-bar-bg',                                               'navbar-inverse-toggle-icon-bar-bg',           'Navbar',                        'color',  '',                                                  '#fff',             ''),
        // array('Navbar: navbar-inverse-toggle-border-color',                                              'navbar-inverse-toggle-border-color',          'Navbar',                        'color',  '',                                                  '#333',             ''),
//         
        // //     Name                                                                                      Variable                               Kategorie                        Typ       Value                                Color           String
        // array('Navs: nav-link-padding',                                                                  'nav-link-padding',                            'Navs',                          'value',  '10px 15px',                         '',             ''),
        // array('Navs: nav-link-hover-bg',                                                                 'nav-link-hover-bg',                           'Navs',                          'value',  '@gray-lighter',                     '',             ''),
//         
        // array('Navs: nav-disabled-link-color',                                                           'nav-disabled-link-color',                     'Navs',                          'value',  '@gray-light',                       '',             ''),
        // array('Navs: nav-disabled-link-hover-color',                                                     'nav-disabled-link-hover-color',               'Navs',                          'value',  '@gray-light',                       '',             ''),
//         
        // array('Navs: nav-open-link-hover-color',                                                         'nav-open-link-hover-color',                   'Navs',                          'color',  '',                                  '#fff',         ''),
        // array('Navs: nav-open-caret-border-color',                                                       'nav-open-caret-border-color',                 'Navs',                          'color',  '',                                  '#fff',         ''),
//         
        // array('Navs: nav-tabs-border-color',                                                             'nav-tabs-border-color',                       'Navs',                          'color',  '',                                  '#ddd',         ''),
//         
        // array('Navs: nav-tabs-link-hover-border-color',                                                  'nav-tabs-link-hover-border-color',            'Navs',                          'value',  '@gray-lighter',                     '',             ''),
//         
        // array('Navs: nav-tabs-active-link-hover-bg',                                                     'nav-tabs-active-link-hover-bg',               'Navs',                          'value',  '@body-bg',                          '',             ''),
        // array('Navs: nav-tabs-active-link-hover-color',                                                  'nav-tabs-active-link-hover-color',            'Navs',                          'value',  '@gray',                             '',             ''),
        // array('Navs: nav-tabs-active-link-hover-border-color',                                           'nav-tabs-active-link-hover-border-color',     'Navs',                          'color',  '',                                  '#ddd',         ''),
//         
        // array('Navs: nav-tabs-justified-link-border-color',                                              'nav-tabs-justified-link-border-color',        'Navs',                          'color',  '',                                  '#ddd',         ''),
        // array('Navs: nav-tabs-justified-active-link-border-color',                                       'nav-tabs-justified-active-link-border-color', 'Navs',                          'value',  '@body-bg',                          '',             ''),
//         
        // array('Navs: nav-pills-active-link-hover-bg',                                                    'nav-pills-active-link-hover-bg',              'Navs',                          'value',  '@component-active-bg',              '',             ''),
        // array('Navs: nav-pills-active-link-hover-color',                                                 'nav-pills-active-link-hover-color',           'Navs',                          'color',  '',                                  '#fff',         ''),
//         
        // //     Name                                                                                      Variable                               Kategorie                            Typ       Value                                Color           String
        // array('Pagination: pagination-bg',                                                               'pagination-bg',                       'Pagination',                        'color',  '',                                  '#fff',         ''),
        // array('Pagination: pagination-border',                                                           'pagination-border',                   'Pagination',                        'color',  '',                                  '#ddd',         ''),
//         
        // array('Pagination: pagination-hover-bg',                                                         'pagination-hover-bg',                 'Pagination',                        'value',  '@gray-lighter',                     '',             ''),
//         
        // array('Pagination: pagination-active-bg',                                                        'pagination-active-bg',                'Pagination',                        'value',  '@brand-primary',                    '',             ''),
        // array('Pagination: pagination-active-color',                                                     'pagination-active-color',             'Pagination',                        'color',  '',                                  '#fff',         ''),
//         
        // array('Pagination: pagination-disabled-color',                                                   'pagination-disabled-color',           'Pagination',                        'value',  '@gray-light',                       '',             ''),
//         
        // //     Name                                                                                      Variable                               Kategorie                            Typ       Value                                Color           String
        // array('Pager: pager-border-radius',                                                              'pager-border-radius',                 'Pager',                         'value',  '15px',                              '',             ''),
        // array('Pager: pager-disabled-color',                                                             'jumbotron-color',                     'Pager',                         'value',  '@gray-light',                           '',             ''),
//         
        // //     Name                                                                                      Variable                               Kategorie                            Typ       Value                                Color           String
        // array('Jumbotron: jumbotron-padding',                                                            'jumbotron-padding',                   'Jumbotron',                         'value',  '30px',                              '',             ''),
        // array('Jumbotron: jumbotron-color',                                                              'jumbotron-color',                     'Jumbotron',                         'value',  'inherit',                           '',             ''),
        // array('Jumbotron: jumbotron-bg',                                                                 'jumbotron-bg',                        'Jumbotron',                         'value',  '@gray-lighter',                     '',             ''),
//         
        // array('Jumbotron: jumbotron-heading-color',                                                      'jumbotron-heading-color',             'Jumbotron',                         'value',  'inherit',                           '',             ''),
//         
        // //     Name                                                                                      Variable                               Kategorie                            Typ       Value                                              Color             String
        // array('Form states and alerts: state-warning-text',                                              'state-warning-text',                  'Form states and alerts',            'color',  '',                                                '#c09853',        ''),
        // array('Form states and alerts: state-warning-bg',                                                'state-warning-bg',                    'Form states and alerts',            'color',  '',                                                '#fcf8e3',        ''),
        // array('Form states and alerts: state-warning-border',                                            'state-warning-border',                'Form states and alerts',            'value',  'darken(spin(@state-warning-bg, -10), 3%)',        '',               ''),
//         
        // array('Form states and alerts: state-danger-text',                                               'state-danger-text',                   'Form states and alerts',            'color',  '',                                                '#b94a48',        ''),
        // array('Form states and alerts: state-danger-bg',                                                 'state-danger-bg',                     'Form states and alerts',            'color',  '',                                                '#f2dede',        ''),
        // array('Form states and alerts: state-danger-border',                                             'state-danger-border',                 'Form states and alerts',            'value',  'darken(spin(@state-danger-bg, -10), 3%)',         '',               ''),
//         
        // array('Form states and alerts: state-success-text',                                              'state-success-text',                  'Form states and alerts',            'color',  '',                                                '#468847',        ''),
        // array('Form states and alerts: state-success-bg',                                                'state-warning-bg',                    'Form states and alerts',            'color',  '',                                                '#dff0d8',        ''),
        // array('Form states and alerts: state-success-border',                                            'state-success-border',                'Form states and alerts',            'value',  'darken(spin(@state-success-bg, -10), 5%)',        '#fcf8e3',        ''),
//         
        // array('Form states and alerts: state-info-text',                                                 'state-info-text',                     'Form states and alerts',            'color',  '',                                                '#3a87ad',        ''),
        // array('Form states and alerts: state-info-bg',                                                   'state-info-bg',                       'Form states and alerts',            'color',  '',                                                '#d9edf7',        ''),
        // array('Form states and alerts: state-info-border',                                               'state-info-border',                   'Form states and alerts',            'value',  'darken(spin(@state-info-bg, -10), 7%)',           '#fcf8e3',        ''),
// 
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Tooltips: tooltip-max-width',                                                            'tooltip-max-width',              'Tooltips',       'value',  '200px',                 '',               ''),
        // array('Tooltips: tooltip-color',                                                                'tooltip-color',                  'Tooltips',       'color',  '',                      '#fff',           ''),
        // array('Tooltips: tooltip-bg',                                                                   'tooltip-bg',                     'Tooltips',       'color',  '',                      '#000',           ''),
//         
        // array('Tooltips: tooltip-arrow-width',                                                          'tooltip-arrow-width',            'Tooltips',       'value',  '5px',                   '',               ''),
        // array('Tooltips: tooltip-arrow-color',                                                          'tooltip-arrow-color',            'Tooltips',       'value',  '@tooltip-bg',           '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Popovers: popover-bg',                                                                   'popover-bg',                         'Popovers',       'color',  '',                           '#fff',           ''),
        // array('Popovers: popover-max-width',                                                            'popover-max-width',                  'Popovers',       'value',  '276px',                      '',               ''),
        // array('Popovers: popover-border-color',                                                         'popover-border-color',               'Popovers',       'value',  'rgba(0,0,0,.2)',             '',               ''),
        // array('Popovers: popover-fallback-border-color',                                                'popover-fallback-border-color',      'Popovers',       'color',  '',                           '#ccc',           ''),
//         
        // array('Popovers: popover-title-bg',                                                             'popover-title-bg',                   'Popovers',       'value',  'darken(@popover-bg, 3%)',    '',               ''),
//         
        // array('Popovers: popover-arrow-width',                                                          'popover-arrow-width',                'Popovers',       'value',  '10px',                       '',               ''),
        // array('Popovers: popover-arrow-color',                                                          'popover-arrow-color',                'Popovers',       'color',  '',                           '#fff',           ''),
//         
        // array('Popovers: popover-arrow-outer-width',                                                    'popover-arrow-outer-width',          'Popovers',       'value',  '(@popover-arrow-width + 1)', '',               ''),
        // array('Popovers: popover-arrow-outer-color',                                                    'popover-arrow-outer-color',          'Popovers',       'value',  'rgba(0,0,0,.25)',            '',               ''),
        // array('Popovers: popover-arrow-outer-fallback-color',                                           'popover-arrow-outer-fallback-color', 'Popovers',       'color',  '',                           '#999',           ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Labels: label-default-bg',                                                               'label-default-bg',               'Labels',       'value',  '@gray-light',                '',               ''),
        // array('Labels: label-primary-bg',                                                               'label-primary-bg',               'Labels',       'value',  '@brand-primary',             '',               ''),
        // array('Labels: label-success-bg',                                                               'label-success-bg',               'Labels',       'value',  '@brand-success',             '',               ''),
        // array('Labels: label-info-bg',                                                                  'label-info-bg',                  'Labels',       'value',  '@brand-info',                '',               ''),
        // array('Labels: label-warning-bg',                                                               'label-warning-bg',               'Labels',       'value',  '@brand-warning',             '',               ''),
        // array('Labels: label-danger-bg',                                                                'label-danger-bg',                'Labels',       'value',  '@brand-danger',              '',               ''),
//         
        // array('Labels: label-color',                                                                    'modal-header-border-color',      'Labels',       'color',  '',                           '#fff',           ''),
        // array('Labels: label-link-hover-color',                                                         'modal-footer-border-color',      'Labels',       'color',  '',                           '#fff',           ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Modals: modal-inner-padding',                                                            'modal-inner-padding',                 'Modals',       'value',  '20px',                       '',               ''),
//         
        // array('Modals: modal-title-padding',                                                            'modal-title-padding',                 'Modals',       'value',  '15px',                       '',               ''),
        // array('Modals: modal-title-line-height',                                                        'modal-title-line-height',             'Modals',       'value',  '@line-height-base',          '',               ''),
//         
        // array('Modals: modal-content-bg',                                                               'modal-content-bg',                    'Modals',       'color',  '',                           '#fff',           ''),
        // array('Modals: modal-content-border-color',                                                     'modal-content-border-color',          'Modals',       'value',  'rgba(0,0,0,.2)',             '',               ''),
        // array('Modals: modal-content-fallback-border-color',                                            'modal-content-fallback-border-color', 'Modals',       'color',  '',                           '#999',           ''),
//         
        // array('Modals: modal-backdrop-bg',                                                              'modal-backdrop-bg',                   'Modals',       'color',  '',                           '#000',           ''),
        // array('Modals: modal-header-border-color',                                                      'modal-header-border-color',           'Modals',       'color',  '',                           '#e5e5e5',        ''),
        // array('Modals: modal-footer-border-color',                                                      'modal-footer-border-color',           'Modals',       'value',  '@modal-header-border-color', '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Alerts: alert-padding',                                                                  'alert-padding',                  'Alerts',       'value',  '15px',                    '',               ''),
        // array('Alerts: alert-border-radius',                                                            'alert-border-radius',            'Alerts',       'value',  '@border-radius-base',     '',               ''),
        // array('Alerts: alert-link-font-weight',                                                         'alert-link-font-weight',         'Alerts',       'value',  'bold',                    '',               ''),
//         
        // array('Alerts: alert-success-bg',                                                               'alert-success-bg',               'Alerts',       'value',  '@state-success-bg',       '',               ''),
        // array('Alerts: alert-success-text',                                                             'alert-success-text',             'Alerts',       'value',  '@state-success-text',     '',               ''),
        // array('Alerts: alert-success-border',                                                           'alert-success-border',           'Alerts',       'value',  '@state-success-border',   '',               ''),
//         
        // array('Alerts: alert-info-bg',                                                                  'alert-info-bg',                  'Alerts',       'value',  '@state-info-bg',          '',               ''),
        // array('Alerts: alert-info-text',                                                                'alert-info-text',                'Alerts',       'value',  '@state-info-text',        '',               ''),
        // array('Alerts: alert-info-border',                                                              'alert-info-border',              'Alerts',       'value',  '@state-info-border',      '',               ''),
//         
        // array('Alerts: alert-warning-bg',                                                               'alert-warning-bg',               'Alerts',       'value',  '@state-warning-bg',       '',               ''),
        // array('Alerts: alert-warning-text',                                                             'alert-warning-text',             'Alerts',       'value',  '@state-warning-text',     '',               ''),
        // array('Alerts: alert-warning-border',                                                           'alert-warning-border',           'Alerts',       'value',  '@state-warning-border',   '',               ''),
//         
        // array('Alerts: alert-danger-bg',                                                                'alert-danger-bg',                'Alerts',       'value',  '@state-danger-bg',        '',               ''),
        // array('Alerts: alert-danger-text',                                                              'alert-danger-text',              'Alerts',       'value',  '@state-danger-text',      '',               ''),
        // array('Alerts: alert-danger-border',                                                            'alert-danger-border',            'Alerts',       'value',  '@state-danger-border',    '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Progress bars: progress-bg',                                                             'progress-bg',                    'Progress bars',       'color',  '',                 '#f5f5f5',        ''),
        // array('Progress bars: progress-bar-color',                                                      'progress-bar-color',             'Progress bars',       'color',  '',                 '#fff',           ''),
//         
        // array('Progress bars: progress-bar-bg',                                                         'progress-bar-bg',                'Progress bars',       'value',  '@brand-primary',   '',               ''),
        // array('Progress bars: progress-bar-success-bg',                                                 'progress-bar-success-bg',        'Progress bars',       'value',  '@brand-success',   '',               ''),
        // array('Progress bars: progress-bar-warning-bg',                                                 'progress-bar-warning-bg',        'Progress bars',       'value',  '@brand-warning',   '',               ''),
        // array('Progress bars: progress-bar-danger-bg',                                                  'progress-bar-danger-bg',         'Progress bars',       'value',  '@brand-danger',    '',               ''),
        // array('Progress bars: progress-bar-info-bg',                                                    'progress-bar-info-bg',           'Progress bars',       'value',  '@brand-info',      '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('List group: list-group-bg',                                                              'list-group-bg',                  'List group',       'color',  '',                      '#fff',               ''),
        // array('List group: list-group-border',                                                          'list-group-border',              'List group',       'color',  '',                      '#ddd',               ''),
        // array('List group: list-group-border-radius',                                                   'list-group-border-radius',       'List group',       'value',  '@border-radius-base',   '',                   ''),
//         
        // array('List group: list-group-hover-bg',                                                        'list-group-hover-bg',            'List group',       'color',  '',                      '#f5f5f5',            ''),
        // array('List group: list-group-active-color',                                                    'list-group-active-color',        'List group',       'color',  '',                      '#fff',               ''),
        // array('List group: list-group-active-bg',                                                       'list-group-active-bg',           'List group',       'value',  '@component-active-bg',  '',                   ''),
        // array('List group: list-group-active-border',                                                   'list-group-active-border',       'List group',       'value',  '@list-group-active-bg', '',                   ''),
//         
        // array('List group: list-group-link-color',                                                      'list-group-link-color',          'List group',       'color',  '',                      '#555',               ''),
        // array('List group: list-group-link-heading-color',                                              'list-group-link-heading-color',  'List group',       'color',  '',                      '#333',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Panels: panel-bg',                                                                       'panel-bg',                       'Panels',       'color',  '',                     '#fff',           ''),
        // array('Panels: panel-inner-border',                                                             'panel-inner-border',             'Panels',       'color',  '',                     '#ddd',           ''),
        // array('Panels: panel-border-radius',                                                            'panel-border-radius',            'Panels',       'value',  '@border-radius-base',  '',               ''),
        // array('Panels: panel-footer-bg',                                                                'panel-footer-bg',                'Panels',       'color',  '',                     '#f5f5f5',        ''),
//         
        // array('Panels: panel-default-text',                                                             'panel-default-text',             'Panels',       'value',  '@gray-dark',           '',               ''),
        // array('Panels: panel-default-border',                                                           'panel-default-border',           'Panels',       'color',  '',                     '#ddd',           ''),
        // array('Panels: panel-default-heading-bg',                                                       'panel-default-heading-bg',       'Panels',       'color',  '',                     '#f5f5f5',        ''),
//         
        // array('Panels: panel-primary-text',                                                             'panel-primary-text',             'Panels',       'color',  '',                     '#fff',           ''),
        // array('Panels: panel-primary-border',                                                           'panel-primary-border',           'Panels',       'value',  '@brand-primary',       '',               ''),
        // array('Panels: panel-primary-heading-bg',                                                       'panel-primary-heading-bg',       'Panels',       'value',  '@brand-primary',       '',               ''),
//         
        // array('Panels: panel-success-text',                                                             'panel-success-text',             'Panels',       'value',  '@state-success-text',  '',               ''),
        // array('Panels: panel-success-border',                                                           'panel-success-border',           'Panels',       'value',  '@state-success-border','',               ''),
        // array('Panels: panel-success-heading-bg',                                                       'panel-success-heading-bg',       'Panels',       'value',  '@state-success-bg',    '',               ''),
//         
        // array('Panels: panel-warning-text',                                                             'panel-warning-text',             'Panels',       'value',  '@state-warning-text',  '',               ''),
        // array('Panels: panel-warning-border',                                                           'panel-warning-border',           'Panels',       'value',  '@state-warning-border','',               ''),
        // array('Panels: panel-warning-heading-bg',                                                       'panel-warning-heading-bg',       'Panels',       'value',  '@state-warning-bg',    '',               ''),
//         
        // array('Panels: panel-danger-text',                                                              'panel-danger-text',              'Panels',       'value',  '@state-danger-text',   '',               ''),
        // array('Panels: panel-danger-border',                                                            'panel-danger-border',            'Panels',       'value',  '@state-danger-border', '',               ''),
        // array('Panels: panel-danger-heading-bg',                                                        'panel-danger-heading-bg',        'Panels',       'value',  '@state-danger-bg',     '',               ''),
//         
        // array('Panels: panel-info-text',                                                                'panel-info-text',                'Panels',       'value',  '@state-info-text',     '',               ''),
        // array('Panels: panel-info-border',                                                              'panel-info-border',              'Panels',       'value',  '@state-info-border',   '',               ''),
        // array('Panels: panel-info-heading-bg',                                                          'panel-info-heading-bg',          'Panels',       'value',  '@state-info-bg',       '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Thumbnails: thumbnail-padding',                                                          'thumbnail-padding',              'Thumbnails',       'value',  '4px',                 '',               ''),
        // array('Thumbnails: thumbnail-bg',                                                               'thumbnail-bg',                   'Thumbnails',       'value',  '@body-bg',            '',               ''),
        // array('Thumbnails: thumbnail-border',                                                           'thumbnail-border',               'Thumbnails',       'color',  '',                    '#ddd',           ''),
        // array('Thumbnails: thumbnail-border-radius',                                                    'thumbnail-border-radius',        'Thumbnails',       'value',  '@border-radius-base', '',               ''),
//         
        // array('Thumbnails: thumbnail-caption-color',                                                    'thumbnail-caption-color',        'Thumbnails',       'value',  '@text-color',         '',               ''),
        // array('Thumbnails: thumbnail-caption-padding',                                                  'thumbnail-caption-padding',      'Thumbnails',       'value',  '9px',                 '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Wells: well-bg',                                                                         'well-bg',                        'Wells',       'color',  '',                 '#f5f5f5',        ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Badges: badge-color',                                                                    'badge-color',                    'Badges',       'color',  '',                 '#fff',            ''),
        // array('Badges: badge-link-hover-color',                                                         'badge-link-hover-color',         'Badges',       'color',  '',                 '#fff',            ''),
        // array('Badges: badge-bg',                                                                       'badge-bg',                       'Badges',       'value',  '@gray-light',      '',                ''),
//         
        // array('Badges: badge-active-color',                                                             'badge-active-color',             'Badges',       'value',  '@link-color',      '',                ''),
        // array('Badges: badge-active-bg',                                                                'badge-active-bg',                'Badges',       'color',  '',                 '#fff',            ''),
//         
        // array('Badges: badge-font-weight',                                                              'badge-font-weight',              'Badges',       'value',  'bold',              '',               ''),
        // array('Badges: badge-line-height',                                                              'badge-line-height',              'Badges',       'value',  '1',                 '#ccc',           ''),
        // array('Badges: badge-border-radius',                                                            'badge-border-radius',            'Badges',       'value',  '10px',              '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Breadcrumbs: breadcrumb-bg',                                                             'breadcrumb-bg',                  'Breadcrumbs',       'color',  '',                 '#f5f5f5',        ''),
        // array('Breadcrumbs: breadcrumb-color',                                                          'breadcrumb-color',               'Breadcrumbs',       'color',  '',                 '#ccc',           ''),
        // array('Breadcrumbs: breadcrumb-active-color',                                                   'breadcrumb-active-color',        'Breadcrumbs',       'value',  '@gray-light',      '',               ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Carousel: carousel-text-shadow',                                                         'carousel-text-shadow',           'Carousel',       'value',  '0 1px 2px rgba(0,0,0,.6)', '',               ''),
//         
        // array('Carousel: carousel-control-color',                                                       'carousel-control-color',         'Carousel',       'color',  '',                         '#fff',           ''),
        // array('Carousel: carousel-control-width',                                                       'carousel-control-width',         'Carousel',       'value',  '15%',                      '',               ''),
        // array('Carousel: carousel-control-opacity',                                                     'carousel-control-opacity',       'Carousel',       'value',  '.5',                       '',               ''),
        // array('Carousel: carousel-control-font-size',                                                   'carousel-control-font-size',     'Carousel',       'value',  '20px',                     '',               ''),
//         
        // array('Carousel: carousel-indicator-active-bg',                                                 'carousel-indicator-active-bg',   'Carousel',       'color',  '',                         '#fff',           ''),
        // array('Carousel: carousel-indicator-border-color',                                              'carousel-indicator-border-color','Carousel',       'color',  '',                         '#fff',           ''),
//         
        // array('Carousel: carousel-caption-color',                                                       'carousel-caption-color',         'Carousel',       'color',  '',                         '#fff',           ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Close: close-color',                                                                     'close-color',                    'Close',       'color',  '',                 '#000',       ''),
        // array('Close: close-font-weight',                                                               'close-font-weight',              'Close',       'value',  'bold',             '',           ''),
        // array('Close: close-text-shadow',                                                               'close-text-shadow',              'Close',       'value',  '0 1px 0 #fff',     '',           ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Code: code-color',                                                                       'code-color',                     'Code',       'value',  '@gray-light',             '',       ''),
        // array('Code: code-bg',                                                                          'code-bg',                        'Code',       'value',  '@gray-light',             '',       ''),
//         
        // array('Code: pre-bg',                                                                           'pre-bg',                         'Code',       'value',  '@gray-light',             '',       ''),
        // array('Code: pre-color',                                                                        'pre-color',                      'Code',       'value',  '@gray-light',             '',       ''),
        // array('Code: pre-border-color',                                                                 'pre-border-color',               'Code',       'value',  '@gray-lighter',           '',       ''),
        // array('Code: pre-scrollable-max-height',                                                        'pre-scrollable-max-height',      'Code',       'value',  '@gray-lighter',           '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Type: text-muted',                                                                       'text-muted',                     'Type',       'value',  '@gray-light',             '',       ''),
        // array('Type: abbr-border-color',                                                                'abbr-border-color',              'Type',       'value',  '@gray-light',             '',       ''),
        // array('Type: headings-small-color',                                                             'headings-small-color',           'Type',       'value',  '@gray-light',             '',       ''),
        // array('Type: blockquote-small-color',                                                           'blockquote-small-color',         'Type',       'value',  '@gray-light',             '',       ''),
        // array('Type: blockquote-border-color',                                                          'blockquote-border-color',        'Type',       'value',  '@gray-lighter',           '',       ''),
        // array('Type: page-header-border-color',                                                         'page-header-border-color',       'Type',       'value',  '@gray-lighter',           '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Miscellaneous: Hr border color',                                                         'hr-border',                      'Miscellaneous',       'value',  '@gray-lighter',           '',       ''),
        // array('Miscellaneous: Horizontal forms & lists',                                                'component-offset-horizontal',    'Miscellaneous',       'value',  '180px',                   '',       ''),
//         
        // //     Name                                                                                      Variable                          Kategorie      Typ       Value                       Color     String
        // array('Container sizes: Small screen / tablet',                                                 'container-tablet',               'Container sizes',       'value',  '((720px + @grid-gutter-width))',           '',       ''),
        // array('Container sizes: Medium screen / desktop',                                               'container-desktop',              'Container sizes',       'value',  '((940px + @grid-gutter-width))', '',       ''),
        // array('Container sizes: Large screen / wide desktop',                                           'container-lg-desktop',           'Container sizes',       'value',  '((1140px + @grid-gutter-width))', '',       ''),
        
        


    );


    /**
     * TemplateLessVariable Repository
     *
     * @var \CodingMs\Ftm\Domain\Repository\TemplateLessVariableRepository
     */
    protected $templateLessVariableRepository;

    /**
     * injectTemplateLessVariableRepository
     *
     * @param \CodingMs\Ftm\Domain\Repository\TemplateLessVariableRepository $fluidTemplateLessVariableRepository
     * @return void
     */
    public function injectTemplateLessVariableRepository(\CodingMs\Ftm\Domain\Repository\TemplateLessVariableRepository $templateLessVariableRepository) {
        $this->templateLessVariableRepository = $templateLessVariableRepository;
    }
    
    /**
     * Prueft alles was Richtung Bootstrap abweicht
     *
     * @author     Thomas Deuling <typo3@coding.ms>
     * @since      22.11.2013
     * 
     * @return mixed boolean wenn alles aktuell ist, ansonsten die Meldungens
     */
    public function checkStructure($pid, $fluidTemplate) {
        
        parent::checkStructure($pid, $fluidTemplate);
        
        
        // Bootstrap-Layouts bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureBootstrap", $fluidTemplate->getTemplateDir())."Layouts/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $fluidTemplate->getTemplateDir())."Layouts/";
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->fluidLayouts)) {
            foreach($this->fluidLayouts as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // Bootstrap-Templates bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureBootstrap", $fluidTemplate->getTemplateDir())."Templates/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $fluidTemplate->getTemplateDir())."Templates/";
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->fluidTemplates)) {
            foreach($this->fluidTemplates as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // Bootstrap-Partials bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureBootstrap", $fluidTemplate->getTemplateDir())."Partials/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("FluidTemplates", $fluidTemplate->getTemplateDir())."Partials/";
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->fluidPartials)) {
            foreach($this->fluidPartials as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // Less-Dateien bereitstellen
        $sourceFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("TemplateStructureBootstrap", $fluidTemplate->getTemplateDir())."Less/";
        $targetFolder = \CodingMs\Ftm\Utility\Tools::getDirectory("Less", $fluidTemplate->getTemplateDir());
        $sourceFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($sourceFolder);
        $targetFolder = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($targetFolder);
        if(!empty($this->lessFiles)) {
            foreach($this->lessFiles as $name=>$filename) {
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!file_exists($targetFolder.$filename)) {
                    copy($sourceFolder.$filename, $targetFolder.$filename);
                }
                
            }
        }
        
        
        // Less-Variablen bereitstellen
        if(!empty($this->lessVariables)) {
            $sorting = 1;
            foreach($this->lessVariables as $variable) {
                
                
                $lessVariable = $this->templateLessVariableRepository->findOneByNameAndPid($variable[1], $pid);
                
                // Nur kopieren wenn es das noch nicht gibt
                if(!($lessVariable instanceof \CodingMs\Ftm\Domain\Model\TemplateLessVariable)) {
                    
                    /**
                     * @var \CodingMs\Ftm\Domain\Model\TemplateLessVariable
                     */
                    $lessVariableObject = $this->objectManager->create('CodingMs\Ftm\Domain\Model\TemplateLessVariable');
                    $lessVariableObject->setPid($pid);
                    $lessVariableObject->setTemplate($fluidTemplate);
                    $lessVariableObject->setSorting($sorting);
                    $lessVariableObject->setVariableTitle($variable[0]);
                    $lessVariableObject->setVariableName($variable[1]);
                    $lessVariableObject->setCategory($variable[2]);
                    $lessVariableObject->setVariableType($variable[3]);
                    $lessVariableObject->setVariableValue($variable[4]);
                    $lessVariableObject->setVariableColor($variable[5]);
                    $lessVariableObject->setVariableString($variable[6]);
                    
                    // Variable speichern
                    $this->templateLessVariableRepository->add($lessVariableObject);
                              
                    // und persistieren
                    $this->persistenceManager->persistAll();
                    $sorting++;
                }
                else {
                    // echo $variable[2]." exists<br>";
                }
                
            }
        }
        
       
        
    }
    
}

?>