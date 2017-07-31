
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


function makeSingleTransfer(){
  
  event.preventDefault();
  
   var html = '<div class="alert alert-info" role="alert" id="otp_reference" value="">'
              +'<strong>Transfer in progress: </strong> sending ...'
              +'</div>';

       $("#transfer_status").append(html);

  //$("#single_transfer_submit").attr("disabled", true);

  var post_data = $( this ).serializeArray();

  function submit(result){
      
     if( result.status == "success"){

         alert("transfer successfull");

         //show modal for OTP
         $("#OTP_FORM").modal('show');

         $("#transaction_ref").val(result.data.transfer.flutterChargeReference);

         $("#transfer_status").append("good stuff");
     }
     else{
        
         alert(result.data);
         $("#transfer_status").append("something went wrong..");
     }

     $("#single_transfer_submit").attr("disabled", false);
  }

  $.post( "/transfer/api_single", post_data, submit);
}
$("#form_single_transfer_submit").submit(makeSingleTransfer);


function comfirmOTP(){
  
   event.preventDefault();

   var post_data = $( this ).serializeArray();


   function submit(data){

      alert(data);
   }
   $.post( "/transfer/comfirm_otp", post_data, submit);
}
$("#OTP_COMFIRM_MODAL").submit(comfirmOTP);