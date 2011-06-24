$(document).ready(function() {
        $('#plus').live('click', plus);
        $('.minus').live('click', minus);
        $('.OptName').live('focus', function () {        
                updateOptions($(this));
        });
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
        var randomnumber = Math.floor(Math.random()*100001); 
        firstcontainer = $('#vOpts');                
        
        //console.log($('#checks').val());return false;
        nodeChildren = $('table.addMultiple').clone(true);
        check = $('#vOpts table.addMultiple').length + 1;
        
        if ((check + $('#vOpts td.alreadAddedOptions').length)  <= 3) {
                
                tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
                $(tmpChild).show();
                $(tmpChild).attr('id', randomnumber);
                $(firstcontainer).append(tmpChild);
                $("#" + randomnumber + " .minus").attr('id', "minus_"+randomnumber);
                $("#" + randomnumber + " .custom").attr('id', "showCustom_"+randomnumber);
                $("#" + randomnumber + " .custom").attr('name', "data[VariantOption]["+randomnumber+"][fieldcustom]");
                
                $("#" + randomnumber + " .OptValue").attr('name', "data[VariantOption]["+randomnumber+"][value]");
                $("#" + randomnumber + " .PluOptName").addClass('OptName');
                $("#" + randomnumber + " .OptName").removeClass('PluOptName');
                $("#" + randomnumber + " .OptName").attr('name', "data[VariantOption]["+randomnumber+"][field]");
                $("#" + randomnumber + " .OptName").attr('onChange', "checkCustomAdd("+randomnumber+")");
                
                updateOptions($("#" + randomnumber + " .OptName"));
                
                if ((check + $('#vOpts td.alreadAddedOptions').length)  == 3) {
                        $('#plus').hide();
                }
        }

        return false;
}

function minus() {
        check = $('#vOpts table.addMultiple').length;
        if ((check + $('#vOpts td.alreadAddedOptions').length)  == 1) {
                alert('Cannot delete last product option. Product must have atleast 1 option.');
                return false;
        }
        id = $($(this)).attr('id');
        if ($($(this)).attr('rel')) {
                rel = $($(this)).attr('rel');
                tmprel = rel.split('_');
                optId = tmprel[1];
                $.ajax({
                        type: 'GET',
                        url: '/admin/products/remove_variant_option/' + optId,
                        success: function () {
                                $('#plus').show();
                        },
                        error: function () {
                                alert('Sorry, something went wrong!');
                        }
                });
        }
        tmp = id.split('_');
        $("#"+tmp[1]).remove();
        if ((check + $('#vOpts td.alreadAddedOptions').length)  <= 3) {
                $('#plus').show();
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
                $('#showCustom_'+val).show();
                $('#showCustom_'+val).focus();
        } else {
                $('#showCustom_'+val).hide();
        }
}