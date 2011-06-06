$(document).ready(function() {
  $('.plus').bind('click', add);
  $('.minus').bind('click', remove);
});

function add() {
    firstcontainer = '#setCondition';
    
    nodeChildren = $(firstcontainer).children();
    tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
    //a clone of the current node’s last child
    curChild = $(tmpChild).clone();
    var $currentValue = $(firstcontainer).children().length;    
    
    //remove child element from parent elem
    //if scrolling stops, return removed child node
    $(firstcontainer).append(curChild);
    
    $('#setCondition .plus').bind('click', add);
    $('#setCondition .minus').bind('click', remove);
    return false;
}

function remove() {  
  
  if ($('#SmartCollectionId').val() != undefined) {
    console.log($('#SmartCollectionId').val());
    console.log('Here');
  }
  return false;
  firstcontainer = '#setCondition';
  nodeChildren = $(firstcontainer).children();
  if (($(firstcontainer).children().length - 1) >= 1) {
    tmpChild = $(nodeChildren)[$(nodeChildren).length-1];
    $(tmpChild).remove();
  }
}