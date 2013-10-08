<?php
namespace CodingMs\Ftm\ViewHelper;

/**
 * Shows Content Element
 *
 * @package TYPO3
 * @subpackage ftm
 */
class ContentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @var Content Object
     */
    protected $cObj;

    /**
     * Parse a content element
     *
     * @param   int         UID of any content element
     * @return  string      Parsed Content Element
     */
    public function render($uid) {
        $conf = array( // config
            'tables' => 'tt_content',
            'source' => $uid,
            'dontCheckPid' => 1
        );
        return $this->cObj->RECORDS($conf);
    }

    /**
     * Injects the Configuration Manager
     *
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     * @return void
    */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
        $this->configurationManager = $configurationManager;
        $this->cObj = $this->configurationManager->getContentObject();
    }

}
?>