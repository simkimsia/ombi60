$(document).ready(function() {
  //var scid = $('#smartCollectionId').val();
  //$('#edit_'+scid).bind('click', edit);
  $('.plus').bind('click', add);
  $('.minus').bind('click', remove);
  
  $('#saveConditionForm').submit(function() {
    var url = $(this).attr('action');
    $.ajax({
      type: 'POST',
      url: '/admin/smart_collections/save_condition',
      data: $('#saveConditionForm').serializeArray(),
      success: function(t) {
        $('#product-list').html(t);
      },
      error: function () {
        alert('Sorry, something went wrong!');
      }
    });
    return false;
  });
});

function add() {
    firstcontainer = '#setCondition';
    nodeChildren = $(firstcontainer).children();
    tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
    //a clone of the current node’s last child
    curChild = $(tmpChild).clone();
    curid = $(curChild).attr("rel");
    val = parseInt(curid) + parseInt(1);
    $(curChild).attr("rel", val);
    $(curChild).attr("id", "form_"+val);

    var currentValue = $(firstcontainer).children().length;    
    
    //remove child element from parent elem
    //if scrolling stops, return removed child node
    $(firstcontainer).append(curChild);
    
    $('#setCondition .plus').bind('click', add);
    $('#setCondition .minus').bind('click', remove);
    $('#form_'+val+' .minus').attr('id', val);
    return false;
}

function remove() {
  
  if ($(this).attr('id') != undefined && $(this).attr('id')!="") {
    firstcontainer = '#setCondition';
    nodeChildren = $(firstcontainer).children(); 
    if ((nodeChildren.length) <= 1) {
      return false;
    }
    reply = confirm('Are you sure, you want to remove this condition?');
    if (reply) {
      id = $(this).attr('id');
      scid = $('#smartCollectionId').val();
      //console.log(baseUrl);
      var url = $(this).attr('href');

      $.ajax({
        type: 'POST',
        url: url + '/' + id + '/' + scid,
        success: function(data) {
          $('#product-list').html(data);
        },
        error: function () {
          alert('Sorry, something went wrong!');
        }
      });
      $('#form_'+id).remove();
      return false;
    } else {
      return false;
    }
    firstcontainer = '#setCondition';
    nodeChildren = $(firstcontainer).children(); 
    if ((nodeChildren.length - 1) >= 1) {
      tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
      $(tmpChild).remove();
    }
    return false;
  }
  firstcontainer = '#setCondition';
  nodeChildren = $(firstcontainer).children(); 
  if ((nodeChildren.length - 1) >= 1) {
    tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
    $(tmpChild).remove();
  }
  return false;
}    

function edit() {
  var scid = $('#smartCollectionId').val();
  $('#sDescription').hide();
  $('#edit-form').show();
}