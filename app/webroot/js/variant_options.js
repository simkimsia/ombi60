$(document).ready(function() {
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
        
        // we allow total 3 displayed
        var hardLimit = parseInt(3);
        // intial page load shows how many?
        var initialOptionsCount = parseInt($('.initial_product_option').length);
        // limit of newly added
        var additionalOptionsLimit = parseInt(hardLimit - initialOptionsCount);
        
        // the undeleted initial + the newly_added
        var newAndUndeletedCount = parseInt($('#vcount').val());
        // the newly added
        var additionalLiveCount = parseInt($('#newly_added_count').val());
        
        // so newly_added cannot be more than limit of newly added
        if (additionalLiveCount  < additionalOptionsLimit) {
            
            val = newAndUndeletedCount;
            
            val = parseInt(val) + parseInt(1);
            $('#vcount').val(val);
            $('#newly_added_count').val(additionalLiveCount + parseInt(1));
            // update the newly added and undeleted
            newAndUndeletedCount = parseInt($('#vcount').val());
            // update the newly added 
            additionalLiveCount = parseInt($('#newly_added_count').val());
            
            tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
            $(tmpChild).show();
            $(tmpChild).attr('id', randomnumber);
            $(firstcontainer).append(tmpChild);
            $("#" + randomnumber + " .minus").attr('id', "minus_"+randomnumber);
            $("#" + randomnumber + " .custom").attr('id', "showCustom_"+randomnumber);
            $("#" + randomnumber + " .custom").attr('name', "data[Product][new_options]["+randomnumber+"][custom_field]");
            
            $("#" + randomnumber + " .OptValue").attr('name', "data[Product][new_options]["+randomnumber+"][value]");
            $("#" + randomnumber + " .PluOptName").addClass('OptName');
            $("#" + randomnumber + " .OptName").removeClass('PluOptName');
            $("#" + randomnumber + " .OptName").attr('name', "data[Product][new_options]["+randomnumber+"][field]");
            $("#" + randomnumber + " .OptName").attr('onChange', "checkCustomAdd("+randomnumber+")");
            
            updateOptions($("#" + randomnumber + " .OptName"));               
        }
        // if newly added equal or more than newly added limit we hide the Add another option link
        if (additionalLiveCount  >= additionalOptionsLimit) {
                $('#plus').hide();
        }
        return false;
}

function minus() {
        
        // we allow total 3 displayed
        var hardLimit = parseInt(3);
        // intial page load shows how many?
        var initialOptionsCount = parseInt($('.initial_product_option').length);
        // limit of newly added
        var additionalOptionsLimit = parseInt(hardLimit - initialOptionsCount);
        
        // the undeleted initial + the newly_added
        var newAndUndeletedCount = parseInt($('#vcount').val());
        // the newly added
        var additionalLiveCount = parseInt($('#newly_added_count').val());
        
        // we need to preserve at least 1 newly added or undeleted option
        if (newAndUndeletedCount == 1) {
            alert('Cannot delete last product option. Product must have atleast 1 option.');
            return false;
        }
        
        
        id = $($(this)).attr('id');
        tmp = id.split('_');
        
        $("#"+tmp[1]).hide();
        $("#deleteOption_"+tmp[1]).val(1);
        $('#undo_'+tmp[1]).show();//return false;
        val = newAndUndeletedCount;
        val = parseInt(val) - parseInt(1);
        $('#vcount').val(val);
        
        // update the newly added and undeleted
        newAndUndeletedCount = parseInt($('#vcount').val());
        if ($(this).hasClass('newly_added')) {
            // update the newly added
            $('#newly_added_count').val(additionalLiveCount - parseInt(1));
            additionalLiveCount = parseInt($('#newly_added_count').val());
        }
        
        
        
        if (additionalLiveCount  < additionalOptionsLimit) {
                $('#plus').show();
        }
        return false;
}

function undo() {
        
        // we allow total 3 displayed
        var hardLimit = parseInt(3);
        // intial page load shows how many?
        var initialOptionsCount = parseInt($('.initial_product_option').length);
        // limit of newly added
        var additionalOptionsLimit = parseInt(hardLimit - initialOptionsCount);
        
        // the undeleted initial + the newly_added
        var newAndUndeletedCount = parseInt($('#vcount').val());
        // the newly added
        var additionalLiveCount = parseInt($('#newly_added_count').val());
        
        id = $($(this)).attr('id');
        tmp = id.split('_');
        
        $("#"+tmp[1]).show();
        $("#deleteOption_"+tmp[1]).val(0);
        $('#undo_'+tmp[1]).hide();//return false;
        val = $('#vcount').val();
        val = parseInt(val) + parseInt(1);
        $('#vcount').val(val);
        
        // update the newly added and undeleted
        newAndUndeletedCount = parseInt($('#vcount').val());
        // update the newly added 
        additionalLiveCount = parseInt($('#newly_added_count').val());
        
        if (additionalLiveCount  < additionalOptionsLimit) {
                $('#plus').show();
        } else {
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
    //console.log(val);
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