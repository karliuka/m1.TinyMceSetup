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
if(window.tinyMceWysiwygSetup)
{
	/**
	 * Rewrite getSettings method (set correct settings)
	 * based on the article Alan Storm
	 *
	 * @see http://alanstorm.com/magento_html5_tinymce
	 * @params mixed mode
	 * @return object
	 */	
    tinyMceWysiwygSetup.prototype.originalSettings = tinyMceWysiwygSetup.prototype.getSettings;
    tinyMceWysiwygSetup.prototype.getSettings = function(mode)
    {
		var settings = this.originalSettings(mode);
        // add any extra settings you'd like below
		settings.valid_children = FAONNI_TINYMCE_VALID_CHILDREN;
		settings.extended_valid_elements = FAONNI_TINYMCE_EXTENDED_VALID_ELEMENTS;
		settings.force_br_newlines = true;
		settings.force_p_newlines  = false;
		settings.forced_root_block = false;

        return settings;
    }
	
	/**
	 * Rewrite encodeDirectives method (RegExp bug: replace ?".+?)>/i to ?".*?)>/i)
	 *
	 * @params string content
	 * @return string
	 */	
    tinyMceWysiwygSetup.prototype.encodeDirectives = function(content)
    {
        // collect all HTML tags with attributes that contain directives
        return content.gsub(/<([a-z0-9\-\_]+.+?)([a-z0-9\-\_]+=".*?\{\{.+?\}\}.*?".*?)>/i, function(match) {
			var attributesString = match[2];
            // process tag attributes string
            attributesString = attributesString.gsub(/([a-z0-9\-\_]+)="(.*?)(\{\{.+?\}\})(.*?)"/i, function(m) {
                return m[1] + '="' + m[2] + this.makeDirectiveUrl(Base64.mageEncode(m[3])) + m[4] + '"';
            }.bind(this));

            return '<' + match[1] + attributesString + '>';

        }.bind(this));
    }	
}