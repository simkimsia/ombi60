$(document).ready(function() {
        $('#plus').live('click', plus);
        $('.minus').live('click', minus);
});


function plus () {
        var randomnumber = Math.floor(Math.random()*100001); 
        firstcontainer = $('#vOpts');                
        nodeChildren = $('div.addMultiple').clone(true);
        check = $('#vOpts div.addMultiple').length + 1;
        
        if ((check + $('#vOpts div.alreadAddedOptions').length)  <= 3) {                        
                tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
                $(tmpChild).show();
                $(tmpChild).attr('id', randomnumber);
                $(firstcontainer).append(tmpChild);
                $("#" + randomnumber + " .minus").attr('id', "minus_"+randomnumber);
                $("#" + randomnumber + " .custom").attr('id', "showCustom_"+randomnumber);
                $("#" + randomnumber + " .custom").attr('name', "data[VariantOption]["+randomnumber+"][fieldcustom]");
                
                $("#" + randomnumber + " .OptValue").attr('name', "data[VariantOption]["+randomnumber+"][value]");
                $("#" + randomnumber + " .OptName").attr('name', "data[VariantOption]["+randomnumber+"][field]");
                $("#" + randomnumber + " .OptName").attr('onChange', "checkCustomAdd("+randomnumber+")");
                
        }
        return false;
}

function minus() {
    id = $($(this)).attr('id');
    tmp = id.split('_');
    $("#"+tmp[1]).remove();
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