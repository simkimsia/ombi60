 /* CHANGES
 * v.2.1.3 - Made it $.noConflict() compatible
 * v.2.1.2 - Fixed bug in which nested fieldsets do not work correctly.
 * v.2.1.1 - Forgot to put the new filter from v.2.1 into the if (settings.closed)
 * v.2.1 - Changed jQuery(this).parent().children().filter( ELEMENTS HERE) to jQuery(this).parent().children().not('label').  Prevents you from having to guess what elements will be in the fieldset.
 * v.2.0 - Added settings to allow a fieldset to be initiated as closed.
 *
 * This script may be used by anyone, but please link back to me.
 *
 * Copyright 2009-2010.  Michael Irwin (http://michael.theirwinfamily.net)
 */
       
jQuery.fn.collapse = function(options) {
	var defaults = {
		closed : false
	}
	settings = jQuery.extend({}, defaults, options);

	return this.each(function() {
		var obj = jQuery(this);
		obj.find("h3:first").addClass('collapsible').click(function() {
			if (obj.hasClass('collapsed'))
				obj.removeClass('collapsed').addClass('collapsible');
	
			jQuery(this).removeClass('collapsed');
	
			obj.children().not('h3').toggle("fast", function() {
			 
				 if (jQuery(this).is(":visible"))
					obj.find("h3:first").addClass('collapsible');
				 else
					obj.addClass('collapsed').find("h3").addClass('collapsed');
			 });
		});
		if (settings.closed) {
			obj.addClass('collapsed').find("h3:first").addClass('collapsed');
			obj.children().not("h3:first").css('display', 'none');
		}
	});
};


