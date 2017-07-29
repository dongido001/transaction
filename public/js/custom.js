
function populate_bank_account(){

   function append(data){
   	  
      data = data.data;

      var options = "<option selected>Please select</option>";
      
   	  data.forEach( function(account){
          
         options += "<option value='"+ account.id +"'> "+ account.account_name + "</option>";

   	  });
      
      $("#parent_bank_account").html(options);

   }

   $.get( "/bank_account/"+ $(this).val(), append);

}
$("#parent_banks").change(populate_bank_account);



function populate_target_bank_account(){

   function append(data){
   	  
      data = data.data;

      var options = "<option selected>Please select</option>";
      
   	  data.forEach( function(account){
          
         options += "<option value='"+ account.id +"'> "+ account.account_name + "</option>";

   	  });
      
      $("#target_account_numbers").html(options);

   }

   $.get( "/bank_account/"+ $(this).val(), append);

}
$("#target_banks").change(populate_target_bank_account);