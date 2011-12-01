/*
 * 
 * jQuery.send()
 *
 * Copyright (c) 2008 Jared Mellentine - jared(at)mellentine(dot)com | http://design.mellentine.com
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * Date: 9/22/2008
 * 
 * Full option list here: http://docs.jquery.com/Ajax/jQuery.ajax#options
 * 
 * Most common options are callbacks:
 * - beforeSend (function): use to validate data before sending
 * - complete (function): will be called regardless of success or error
 * - success (function): called only on success
 * - error (function): called only on error
 * - ifModified (function): called only if the response has changed since last
 *   request (based on Last-Modified header)
 * 
 * Other common options:
 * - dataType (string): specifies data return type ('xml', 'json', etc)
 * - cache (boolean): can be used to bypass cache
 * 
 */

(function(jQuery) {
	jQuery.fn.send = function(options) {
		return this.each(function(){
		    var form = jQuery(this);
			jQuery(this).bind('submit', function() {
				jQuery.ajax(jQuery.extend({
					type     : form.attr('method') || 'get',
					url      : form.attr('action') || window.location.href,
					data     : form.serialize()
				}, options));
				return false;
			});
		});
	};
})(jQuery);