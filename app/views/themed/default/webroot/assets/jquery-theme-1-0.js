/* Solo Shopify Theme v1.0 (jQuery 1.3.1 required). Copyright (c) Pixellent, LLC <http://www.pixellent.com>. */
$.cleared=function(A){if($(A).length>0){$(A).each(function(){var B=$(this).val();$(this).focus(function(){if($(this).val()==B){$(this).val("")}});$(this).blur(function(){if($(this).val()==""){$(this).val(B)}})})}};$.slider=function(A,E,D,C){if($(A).length>0){var B=parseInt($(E+" li").length)*116;if($(E+" li").length<6){$(C).addClass("inactive")}$(D).unbind("click");$(D).click(function(){if($(D).hasClass("inactive")||$(D).hasClass("disabled")){return false}else{$(D).addClass("disabled");var F=parseInt($(E).css("margin-left"));var G=(F+580)+"px";$(E).animate({marginLeft:G},1000,"easeInOutQuint",function(){var H=parseInt($(E).css("margin-left"))+580;if(H>0){$(D).addClass("inactive")}$(C).removeClass("inactive");$(D).removeClass("disabled")})}return false});$(C).unbind("click");$(C).click(function(){if($(C).hasClass("inactive")||$(C).hasClass("disabled")){return false}else{$(C).addClass("disabled");var F=parseInt($(E).css("margin-left"));var G=(F-580)+"px";$(E).animate({marginLeft:G},1000,"easeInOutQuint",function(){var H=parseInt($(E).css("margin-left"))+-580;if((H+B)<=0){$(C).addClass("inactive")}$(D).removeClass("inactive");$(C).removeClass("disabled")})}return false})}};$(document).ready(function(){$.cleared("input.field");$.slider("div#slider","div#slider ul","div#prev a","div#next a")});