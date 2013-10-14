Damit ein Vererben der Meta-Angaben auf der Rootline möglich ist, müssen die Felder in der ``localconf.php``/``LocalConfiguration.php`` entsprechend vermerkt werden.
Dies geschieht folgendermaßen:

.. code-block:: php
    
    $TYPO3_CONF_VARS['FE']['addRootLineFields'] = 'abstract,keywords,description,author,author_email,backend_layout_next_level';

bzw.:

.. code-block:: php
    
    'FE' => array(
        'addRootLineFields' => 'abstract,keywords,description,author,author_email,backend_layout_next_level',
    ),
