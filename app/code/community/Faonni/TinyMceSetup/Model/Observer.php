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
class Faonni_TinyMceSetup_Model_Observer
{
    /**
     * Predispath admin action controller
     *
     * @param Varien_Event_Observer $observer
     */
    public function addJs(Varien_Event_Observer $observer)
    {
		if (!Mage::helper('faonni_tinymcesetup')->isEnabled()) {
			return $this;
		}
		
		$block = $observer->getEvent()->getBlock();
		if ('head' == $block->getNameInLayout()) {
			$transport = $observer->getEvent()->getTransport();
			$html = $transport->getHtml();
			$html.= Mage::app()->getLayout()->createBlock('core/template')
				->setName('faonni.tinymcesetup')
				->setTemplate('faonni/tinymcesetup/js.phtml')
				->setJsUrl($block->getJsUrl())
				->setCanLoadTinyMce($block->getCanLoadTinyMce())
				->toHtml() . PHP_EOL; 
	
			$transport->setHtml($html);
		}
		return $this;
    }
}