<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_TinyMceSetup
 * @copyright   Copyright (c) 2015 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Faonni_TinyMceSetup_Helper_Data 
	extends Mage_Core_Helper_Abstract 
{
    /**
     * Check TinyMce Html5 functionality should be enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::helper('Core')->isModuleEnabled('Faonni_TinyMceSetup') &&
			Mage::getStoreConfig('cms/wysiwyg/enabled_html5') &&
				Mage::getStoreConfig('cms/wysiwyg/enabled') != Mage_Cms_Model_Wysiwyg_Config::WYSIWYG_DISABLED;
    }
}