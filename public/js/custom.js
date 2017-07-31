
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

  $("#single_transfer_submit").attr("disabled", true);

  var post_data = $( this ).serializeArray();

  function submit(result){
      
     if( result.status == "success"){

         alert("An OTP has been sent to your phone, please comfirm");

         //show modal for OTP
         $("#OTP_FORM").modal('show');

         $("#transaction_ref").val(result.data.transfer.flutterChargeReference);

     }
     else{
        
         alert(result.data);
     }

     $("#single_transfer_submit").attr("disabled", false);
  }

  $.post( "/transfer/api_single", post_data, submit);
}
$("#form_single_transfer_submit").submit(makeSingleTransfer);


function comfirmOTP(){
  
   event.preventDefault();

   var post_data = $( this ).serializeArray();

   var success = '<div class="alert alert-success" role="alert" id="otp_reference" value="">'
                 +'<strong>Transfer successful: </strong>'
                 +'</div>';

   var error   = '<div class="alert alert-danger" role="alert" id="otp_reference" value="">'
                 +'<strong>Transfer was not successful: </strong>'
                 +'</div>';

   $("#OTP_COMFIRM_SUBMIT").attr("disabled", true);

   function submit(data){

      if( data.status == 'success'){

         $("#transfer_status").append(success);

         //hide modal for OTP
         $("#OTP_FORM").modal('hide');

         $("#OTP_COMFIRM_SUBMIT").attr("disabled", false);

      }
      else{

         //$("#transfer_status").append(error);

         alert(data.data);

         $("#OTP_COMFIRM_SUBMIT").attr("disabled", false);

      }

      
   }
   $.post( "/transfer/comfirm_otp", post_data, submit);
}
$("#OTP_COMFIRM_MODAL").submit(comfirmOTP);