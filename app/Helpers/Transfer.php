<?php


namespace App\Helpers;

use Unirest;
use App\Models\BankAccount;
use App\Models\Transfer;

class TransferHelper{

   public $request_payload;

   public $api_url;

   function __construct() {

       $this->request_payload = json_encode( [
             "apiKey" => env('PAYSTACK_API_KEY'),
             "secret" => env('PAYSTACK_API_SECRET')
          ]
       );

       $this->api_url = env('PAYSTACK_API_URL');
   }

  /**
  * Makes request to the Api end points.
  *
  * @param $url - String, probably the end point link.
  * @param $params - Array, The Request content
  */  
  public function RequestGetter( $url, $params = [] ){

      $headers = [
                    "Content-Type" => "application/json", 
                    //'Content-Type' => 'application/json', 
                    "Authorization" => $this->getAccessCode()
                 ];

      $body = Unirest\Request\Body::json($params);

      $response = Unirest\Request::post($this->api_url . $url, $headers, $body );

      return $response->body;
  }

  /**
  * Get access token from the api so we can query the endpoints without problems.
  * 
  */  
  public function getAccessCode(){
    
    //TODO save token locally, then retrieve when needed. since the token lasts for 2hrs 

      $headers = [
                   'Accept' => 'application/json', 
                   'Content-Type' =>  'application/json'
                 ];

      $response = Unirest\Request::post($this->api_url . '/v1/merchant/verify', $headers, $this->request_payload);

     return $response->body->token;

  }  

  /**
  * Get list of banks available on the Api.
  * 
  */  
  public function getBanks(){

    return $this->RequestGetter('/banks', []);
    
  }

  /**
  * Checks if account number is correct.
  *
  * @param $account_number, String
  * @param $bank_code, String
  */  
  public function authenticateAccountNumber($account_number, $bank_code){

     return $this->RequestGetter('/v1/resolve/account', array() );

  }   

  /**
  * Validates authentication sent to client when Transaction process was triggerd.
  *
  * @param $transaction_ref - String, Transaction reference ID.
  * @param $auth_type - String, OTP or Account_Credit or AnyType of auth that comes in :D
  */  
  public function validateTransactionAuth($transaction_ref, $auth_type, $auth_value)
  {
     
     $payload = [

            "transactionRef" => $transaction_ref, //Flutterwave reference from /v1/transfer call
            "authType"       => $auth_type, //OTP or ACCOUNT_CREDIT
            "authValue"      => $auth_value, //Auth value
        ];

     $result =  $this->RequestGetter('/v1/transfer/charge/auth/account', $payload);

     if( $result->status == 'success'){
        
        $result = 'Transaction comfirmed';
     }
     else{

        $result = 'Error: ' . $result->message;
     }

     return $result;

  }  

  /**
  * Makes Transfer of real money from one account to another.
  * 
  * @param $sender_account_number - String.
  * @param $sender_bank - String.
  * @param $recipient_account_number - String.
  * @param $recipient_bank - String.
  */  
  public function makeTransfer($sender_bank, $sender_account_number, $recipient_bank, $recipient_account_number, $amount, $comment){

      $account_details = BankAccount::where('account_number', $sender_account_number)->first();

      $payload =
        [
            "firstname"                => $account_details->firstname,
            "lastname"                 => $account_details->lastname,
            "email"                    => $account_details->email,
            "phonenumber"              => $account_details->phonenumber,
            "recipient_bank"           => $recipient_bank,
            "recipient_account_number" => $recipient_account_number,
            "charge_with"              => "account",
            "recipient"                => "account",
            "sender_account_number"    => $sender_account_number,
            "sender_bank"              => $sender_bank,
            "apiKey"                   => "ts_X9TLQQQJTMDHVA18YN4Hc",
            "amount"                   => $amount,
            "fee"                      => 45,
            "medium"                   => "web",
            "redirectUrl"              => "https://google.com"
       ];

      $result =  $this->RequestGetter('/v1/transfer', $payload);


      if( $result->status == "success"){
         
         //store transaction ref in the DB.
        
         $transfer = new Transfer;
         $transfer->reference = $result->data->flutterChargeReference;
         $transfer->status = 'in_progress';
         $transfer->data = $result->data;

         $transfer->save();

         $result = ['status'=>'success', 'data' => $result->data ];
      }
      else{

         $result = ['status'=>'error', 'data' => $result->message ];
      }

      return $result;
        
  }


  /**
  * Makes Transfer of real money from one account to another.
  * 
  * @param $sender_account_number - String.
  * @param $sender_bank - String.
  * @param $recipient_account_number - String.
  * @param $recipient_bank - String.
  */  
  public function disburse(){

      $payload =
      	[
          // "lock"=> "lock",
          // "amount"=> 400,
          // "bankcode"=>  044,
          // "accountNumber"=> "0690000022",
          // "currency"=> "NGN",
          // "senderName"=> "Onwuka Gideon",
          // "ref"=> "reference"
       ];

      return $this->RequestGetter('/v1/disburse', $payload);
        
  }

  /**
  * Validates Account to Account transfer
  * 
  * @param $sender_account_number - String.
  * @param $sender_bank - String.
  * @param $recipient_account_number - String.
  * @param $recipient_bank - String.
  */  
  public function validateAccountToAccountTransfer(){

      $payload =
        [
          "account_number" => "0921318712",
          "bank_code" => "058"
       ];

      return $this->RequestGetter('/v1/resolve/account', $payload);
        
  }

}