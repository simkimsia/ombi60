$(document).ready(function () {
	$("span").css({
		 'padding' : '5px 20px',
		 'font-size' : '14px'
	});
	
	$("span.fullfillItem").styledButton({
		'orientation' : 'alone',
		'action' : function () {		    
		    //You can write the delete code here
		 },
		'display' : 'block'
	});
	
	
	$("span.markPaymentReceived").styledButton({
		'orientation' : 'alone',
		'action' : function () {		    
		    //You can write the delete code here
		 },
		'display' : 'block'
	});
	
	$("span.delete").styledButton({
		'orientation' : 'alone',
		'action' : function () {
		    if ($('#delete_confirm').html() != null) {
		        if (confirm($('#delete_confirm').html())) {
		            if ($('#delete_url').html() != "") {
		                /*alert($('#delete_url').html());
		                return false;*/
		                window.location = $('#delete_url').html();
		            }
		        }
		    }
		    
		    //You can write the delete code here
		 },
		'display' : 'block'
	});

	$("span.checkUnCheck").styledButton({
		'orientation' : 'right',
		'dropdown' : { 'element' : 'ul' },
		'role' : 'select',
		'defaultValue' : 'default value',
		'name' : 'testSelect',
		'clear' : true
	});
	$("span.moreaction").styledButton({
		'orientation' : 'alone',
		'dropdown' : { 'element' : 'ul' },
		'role' : 'select',
		'defaultValue' : 'default value',
		'name' : 'dummy',
		'clear' : true
	});

	$("span.selectCheckbox").styledButton({
		'action' : function () {
		//Do action on check uncheck on checkboxed
		},
		'orientation' : 'left',
		'clear' : true
	});

} );

$( function() {
    $("#check_uncheck_options").change(function(){
        alert($("#check_uncheck_options").val());
    });    
	$( '.checkAll' ).live( 'change', function() {
		$( '.checkbox_check' ).attr( 'checked', $( this ).is( ':checked' ) ? 'checked' : '' );
		//$( this ).next().text( $( this ).is( ':checked' ) ? 'Uncheck All' : 'Check All' );
	});
	$( '.invertSelection' ).live( 'click', function() {
		$( '.checkbox_check' ).each( function() {
			$( this ).attr( 'checked', $( this ).is( ':checked' ) ? '' : 'checked' );
		}).trigger( 'change' );
	});
	$( '.checkbox_check' ).live( 'change', function() {
	    //$( '.checkbox_check' ).length == $( '.checkbox_check:checked' ).length ? $( '.checkAll' ).attr( 'checked', 'checked' );
		$( '.checkbox_check' ).length == $( '.checkbox_check:checked' ).length ? $( '.checkAll' ).attr( 'checked', 'checked' ): $( '.checkAll' ).attr( 'checked', '' );
	});
});
