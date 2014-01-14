<?php
namespace CodingMs\Ftm\ViewHelper\Be;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2011 punkt.de GmbH - Karlsruhe, Germany - http://www.punkt.de
 *  Authors: Daniel Lienert, Michael Knoll
 *  All rights reserved
 *
 *  For further information: http://extlist.punkt.de <extlist@punkt.de>
 *
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
 * This class generates links to edit records or create new ones
 *
 * = Examples =
 *
 * <code title="Default">
 * <Ex:be.editLink parameters="edit[pages][1]=edit" title="Edit page" />
 * </code>
 * <output>
 * <a title="Edit page" href="alt_doc.php?edit[pages][1]=edit">...</a>
 * </output>
 *
 * @author      Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package     TYPO3
 * @from  tx_examples
 *
 * http://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Examples/EditLinks/Index.html#edit-links-new
 * @license http://www.gnu.org/copyleft/gpl.html
 */
class EditLinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments() {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
    }

    /**
     * Crafts a link to edit a database record or create a new one
     *
     * @param string $parameters Query string parameters
     * @param string $returnUrl URL to return to
     * @return string The <a> tag
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     */
    public function render($parameters, $returnUrl = '') {
        $uri = 'alt_doc.php?' . $parameters;
        if (!empty($returnUrl)) {
            $uri .= '&returnUrl=' . rawurlencode($returnUrl);
        }

        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(TRUE);
        return $this->tag->render();
    }
}
?>
