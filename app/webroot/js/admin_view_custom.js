 $(document).ready(function(){
  
 //function to post admin settings form
      $('#adminCustomViewSubmit').live('click',function () {
          //console.log($('#ProductAdminViewCustomForm').attr('action'));
          postForm($('#ProductAdminViewCustomForm').attr('action'),$('#ProductAdminViewCustomForm').serializeArray(),'#productsearchlist');
          
          return false;
      });
      
      $('.tiny_with_thumb').live('click',function () {
         //console.log($(this).attr('id'));
         //console.log($(this).attr("id").match(/[\d]+$/));
        
         var product_id = $(this).attr("id").match(/[\d]+$/);
         //console.log($(this).children('a').attr('href'));
         var url = $(this).children('a').attr('href');
         
        
          $.ajax({
           method: "get",
           url: url,

           success: function(data, textStatus, XMLHttpRequest) {
            
                 $('#searchresult').html(data);
                 $('#possible-product-'+product_id).addClass('added'); 
           },
           
          });
        
          return false; 
      }); 
      
      
       $('.product_in_collection').live('click',function () {
         /*console.log($(this).attr('id'));
         console.log($(this).attr("id").match(/[\d]+$/)); */
        
         var product_id = $(this).attr("id").match(/[\d]+$/);
         //console.log($(this).children('a').attr('href'));
         var url = $(this).children('a').attr('href');
         
        
          $.ajax({
           method: "get",
           url: url,

           success: function(data, textStatus, XMLHttpRequest) {
            
                 $('#searchresult').html(data);
                 $('#possible-product-'+product_id).removeClass('added'); 
          
           },
           
          });
        
          return false; 
      }); 
      
      setTimeout(function(){
            $(".flashMessage").fadeOut("slow", function () {
            $(".flashMessage").remove();
           }); }, 8000);
     
     
 });
 
 
 //function to post data at given url
 function postForm(url,data,elementToUpdate) {
      $.ajax({
            type: 'POST',
            url: url,
            data: data,

            success: function(data) {
               //alert('success');
               //alert(data);
               if (elementToUpdate) {
                  $(elementToUpdate).html(data);
               }

              /* if (data) {
                  handler(data,'post');
               } */

             },

             error: function(XMLHttpRequest, textStatus, errorThrown) {
                 $("#messages").html('<div class="flashMessage" id="flashMessage">'+'Unable to process your request.Please try again later.'+"</div>");
             },
             //dataType: "json",
       });
 }
 
 function handler(data,method) {
   alert(data);
   alert(method);
 }
