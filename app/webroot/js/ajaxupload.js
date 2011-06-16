$(document).ready(function() {
  $('.make_cover').live('click', make_cover);
  //$('.delete-image').live('click', deleteImage);
});
function make_cover() {
  var url = $(this).attr('href');
  var id_element = $('#divToUpdate').val();
  $.ajax({
    type: 'GET',
    url: url,
    success: function(t) {
      //$('.error').hide();
      //$('#product-list').html(t);
      //$('.minus').bind('click', remove);
      $('#'+id_element).html(t);
      $('.make_cover').live('click', make_cover);
    },
    error: function () {
      alert('Sorry, something went wrong!');
    }
  });
  return false;
}
function deleteImage() {
  alert('Am I here???');return false;
  var url = $(this).attr('href');
  var id_element = $('#divToUpdate').val();
  $.ajax({
    type: 'GET',
    url: url,
    success: function(t) {
      //$('.error').hide();
      //$('#product-list').html(t);
      //$('.minus').bind('click', remove);
      $('#'+id_element).html(t);
      
    },
    error: function () {
      alert('Sorry, something went wrong!');
    }
  });
  return false;
}
function $m(theVar){
	return document.getElementById(theVar)
}
function remove(theVar){
	var theParent = theVar.parentNode;
	theParent.removeChild(theVar);
}
function addEvent(obj, evType, fn){
	if(obj.addEventListener)
	    obj.addEventListener(evType, fn, true)
	if(obj.attachEvent)
	    obj.attachEvent("on"+evType, fn)
}
function removeEvent(obj, type, fn){
	if(obj.detachEvent){
		obj.detachEvent('on'+type, fn);
	}else{
		obj.removeEventListener(type, fn, false);
	}
}
function isWebKit(){
	return RegExp(" AppleWebKit/").test(navigator.userAgent);
}
function ajaxUpload(form, url_action){
  id_element = $('#divToUpdate').val();
  html_show_loading = $('#loadMsg').val();;
  html_error_http = $('#errMsg').val();
  url_action += $('#ProductId').val();
  url_action += "/" + true;
	var detectWebKit = isWebKit();
	form = typeof(form)=="string"?$m(form):form;
	var erro="";
	if(form==null || typeof(form)=="undefined"){
		erro += "The form of 1st parameter does not exists.\n";
	}else if(form.nodeName.toLowerCase()!="form"){
		erro += "The form of 1st parameter its not a form.\n";
	}
	if($m(id_element)==null){
		erro += "The element of 3rd parameter does not exists.\n";
	}
	if(erro.length>0){
		alert("Error in call ajaxUpload:\n" + erro);
		return;
	}
	var iframe = document.createElement("iframe");
	iframe.setAttribute("id","ajax-temp");
	iframe.setAttribute("name","ajax-temp");
	iframe.setAttribute("width","0");
	iframe.setAttribute("height","0");
	iframe.setAttribute("border","0");
	iframe.setAttribute("style","width: 0; height: 0; border: none;");
	form.parentNode.appendChild(iframe);
	window.frames['ajax-temp'].name="ajax-temp";
	var doUpload = function(){
		removeEvent($m('ajax-temp'),"load", doUpload);
		var cross = "javascript: ";
		cross += "window.parent.$m('"+id_element+"').innerHTML = document.body.innerHTML; void(0);";
		$m(id_element).innerHTML = html_error_http;
		$m('ajax-temp').src = cross;
		if(detectWebKit){
        	remove($m('ajax-temp'));
        }else{
        	setTimeout(function(){ remove($m('ajax-temp'))}, 250);
        }
    }
	addEvent($m('ajax-temp'),"load", doUpload);
	form.setAttribute("target","ajax-temp");
	form.setAttribute("action",url_action);
	form.setAttribute("method","post");
	form.setAttribute("enctype","multipart/form-data");
	form.setAttribute("encoding","multipart/form-data");
  //console.log(form);return false;
	form.submit();
	if(html_show_loading.length > 0){
		$m(id_element).innerHTML = html_show_loading;
	}
}