Damit Sie auch alle erforderlichen Dateien direkt über den FTM bzw. den internen Editor bearbeiten können, müssen Sie diese entsprechend in der ``localconf.php``/``LocalConfiguration.php`` angeben.
Dies geschieht folgendermaßen:

.. code-block:: php

    $TYPO3_CONF_VARS['BE']['fileExtensions']['webspace']['allow'] = 'txt,html,htm,css,less,sass,scss,tmpl,ts,js,sql,xml,csv,inc,png,jpg,gif,pdf';
    $TYPO3_CONF_VARS['SYS']['textfile_ext'] = 'txt,html,htm,css,less,sass,scss,tmpl,ts,js,sql,xml,csv,php,php3,php4,php5,php6,phpsh,inc,phtml'; 

bzw.:

.. code-block:: php
    
    'BE' => array(
        'webspace' => array(
            'allow' => 'txt,html,htm,css,less,sass,scss,tmpl,ts,js,sql,xml,csv,inc,png,jpg,gif,pdf',
        ),
    ),
    'SYS' => array(
        'textfile_ext' => 'txt,html,htm,css,less,sass,scss,tmpl,ts,js,sql,xml,csv,php,php3,php4,php5,php6,phpsh,inc,phtml',
    ),