$(document).ready(function() {
        if ($('#vcount').val() == 0) {
            plus();
        }
        
        $('#plus').live('click', plus);
        $('.minus').live('click', minus);
        $('.OptName').live('focus', function () {        
                updateOptions($(this));
        });
        $('.undo').live('click', undo);
});


function updateOptions(e) {
        var options = $('.OptName:not(.PluOptName)');
        var selectedOptions = new Array();
        var current = e.val();
        $.each(options, function(i, v) {
                if ($(v).val() != current) {
                        selectedOptions.push($(v).val());
                }
        });
        $.each(e.children(), function (i, v) {
                $(v).attr('disabled', false);
                if (in_array($(v).val(), selectedOptions)) {
                        if ($(v).val() != "custom") {
                                $(v).attr('disabled', true);
                        }
                }
        });
        
        
}

function in_array (needle, haystack, argStrict) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: vlado houba
    // +   input by: Billy
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: true
    // *     example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
    // *     returns 2: false
    // *     example 3: in_array(1, ['1', '2', '3']);
    // *     returns 3: true
    // *     example 3: in_array(1, ['1', '2', '3'], false);
    // *     returns 3: true
    // *     example 4: in_array(1, ['1', '2', '3'], true);
    // *     returns 4: false
    var key = '',
        strict = !! argStrict;

    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }

    return false;
}

function plus () {
        
        //var randomnumber = Math.floor(Math.random()*100001);
        var currentTime = new Date()
        var randomnumber = currentTime.getTime();
        firstcontainer   = $('#vOpts');                
        
        nodeChildren = $('ul.addMultiple').clone(true);
        check = $('#vOpts ul.addMultiple').length + 1;
        
        if ($('#vcount').val()  < 3) {
            
            val = $('#vcount').val();
            val = parseInt(val) + parseInt(1);
            $('#vcount').val(val);
             
            tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
            //console.log($(tmpChild).children());return false;
            $(tmpChild).show();
            $(tmpChild).attr('id', randomnumber);
            $(firstcontainer).append(tmpChild);
            //var $inputs = $(tmpChild);
            
            $("#" + randomnumber + " .minus").attr('id', "minus_"+randomnumber);
            $("#" + randomnumber + " .custom").attr('id', "showCustom_"+randomnumber);
            
            
            //$("#" + randomnumber + " .OptValue").attr('name', "data[VariantOption]["+randomnumber+"][value]");
            $("#" + randomnumber + " .PluOptName").addClass('OptName');
            $("#" + randomnumber + " .PluOptName").attr('name', "data[Product][new_options]["+randomnumber+"][field]");
            
            $("#" + randomnumber + " .custom").attr('name', "data[Product][new_options]["+randomnumber+"][custom_field]");
            
            $("#" + randomnumber + " .OptValue").attr('name', "data[Product][new_options]["+randomnumber+"][value]");
            
            $("#" + randomnumber + " .OptName").removeClass('PluOptName');
            //$("#" + randomnumber + " .OptName").attr('name', "data[VariantOption]["+randomnumber+"][field]");
            $("#" + randomnumber + " .OptName").attr('onChange', "checkCustomAdd("+randomnumber+")");
            if ($('#vcount').val() > 1) {
                $("#" + randomnumber + " .OptName").val('custom');
                $("#" + randomnumber + " .custom").show();
                $("#" + randomnumber + " .custom").val('Default');
                $("#" + randomnumber + " .OptValue").val('Default Value');
            }
            updateOptions($("#" + randomnumber + " .OptName"));               
        }
        if ($('#vcount').val() == 3) {
                $('#plus').hide();
        }
        return false;
}

function minus() {
        if ($('#vcount').val() == 1) {
            alert('Cannot delete last product option. Product must have atleast 1 option.');
            return false;
        }
        /*check = $('#vOpts table.addMultiple').length;
        if ((check + $('#vOpts td.alreadAddedOptions').length)  == 1) {
                
        }*/
        
        id = $($(this)).attr('id');
        tmp = id.split('_');
        
        if (!$($(this)).attr('rel')) {
            $("#"+tmp[1]).remove();
        } else {        
            $("#"+tmp[1]).hide();
        }
        $("#deleteOption_"+tmp[1]).val(1);
        $('#undo_'+tmp[1]).show();//return false;
        val = $('#vcount').val();
        val = parseInt(val) - parseInt(1);
        $('#vcount').val(val);
        
        if ($('#vcount').val() < 3) {
                $('#plus').show();
        }
        return false;
}

function undo() {        
        if ($('#vcount').val() == 3) {
            alert('Product could not have more than 3 options, please remove at-least one option.');
            return false;
        }
        id = $($(this)).attr('id');
        tmp = id.split('_');
        
        $("#"+tmp[1]).show();
        $("#deleteOption_"+tmp[1]).val(0);
        $('#undo_'+tmp[1]).hide();//return false;
        val = $('#vcount').val();
        val = parseInt(val) + parseInt(1);
        $('#vcount').val(val);
        
        if ($('#vcount').val() == 3) {
                $('#plus').hide();
        }
        return false;
}


function checkCustom(val, i) {
    
        if (val == "custom") {
                $('#showCustom_'+i).show();
                $('#showCustom_'+i).focus();
        } else {
                
                $('#showCustom_'+i).hide();
        }
}

function checkCustomAdd(val) {
        if ($("#" + val+ " .OptName").val() == "custom") {
                $("#" + val+ " .OptValue").val("Default Value");
                $('#showCustom_'+val).show();
                $('#showCustom_'+val).focus();
        } else {
                option = $("#" + val+ " .OptName").val();
                $("#" + val+ " .OptValue").val("Default "+option);
                $('#showCustom_'+val).hide();
        }
}
