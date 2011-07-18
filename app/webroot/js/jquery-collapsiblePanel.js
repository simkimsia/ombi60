/*(function($) {
    $.fn.extend({
        collapsiblePanel: function() {
            // Call the ConfigureCollapsiblePanel function for the selected element
            return $(this).each(ConfigureCollapsiblePanel);
        }
    });

})(jQuery);

function ConfigureCollapsiblePanel() {
    $(this).addClass("ui-widget");

    // Wrap the contents of the container within a new div.
    $(this).children().wrapAll("<div class='collapsibleContainerContent ui-widget-content'></div>");
    console.log($(this).find('h3').html());
    // Create a new div as the first item within the container.  Put the title of the panel in here.
    //$("<div class='collapsibleContainerTitle ui-widget-header'><div>" + $(this).attr("title") + "</div></div>").prependTo($(this));
     $("<div class='collapsibleContainerTitle ui-widget-header'><div><h3 class=\"section-header\">" + $(this).find('h3').html() + "</h3></div></div>").prependTo($(this));
    // Assign a call to CollapsibleContainerTitleOnClick for the click event of the new title div.
    $(".collapsibleContainerTitle", this).click(CollapsibleContainerTitleOnClick);
}

function CollapsibleContainerTitleOnClick() {
    // The item clicked is the title div... get this parent (the overall container) and toggle the content within it.
    $(".collapsibleContainerContent", $(this).parent()).slideToggle();
}*/

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
		obj.find("legend:first").addClass('collapsible').click(function() {
			if (obj.hasClass('collapsed'))
				obj.removeClass('collapsed').addClass('collapsible');
	
			jQuery(this).removeClass('collapsed');
	
			obj.children().not('legend').toggle("slow", function() {
			 
				 if (jQuery(this).is(":visible"))
					obj.find("legend:first").addClass('collapsible');
				 else
					obj.addClass('collapsed').find("legend").addClass('collapsed');
			 });
		});
		if (settings.closed) {
			obj.addClass('collapsed').find("legend:first").addClass('collapsed');
			obj.children().not("legend:first").css('display', 'none');
		}
	});
};


