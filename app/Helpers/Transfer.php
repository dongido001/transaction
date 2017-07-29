<?php


namespace App\Helpers;

use Unirest;

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
                    'Accept' => 'application/json', 
                    'Content-Type' => 'application/json', 
                    'Authorization' => $this->getAccessCode()
                 ];

      $body = Unirest\Request\Body::json($params);

      $response = Unirest\Request::post($this->api_url . $url, $headers, $body);

      return $response->body;
  }

  /**
  * Get access token from the api so we can query the endpoints without problems.
  * 
  */  
  public function getAccessCode(){

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

     return $this->RequestGetter('/v1/transfer', $this->request_payload);

  }   

  /**
  * Validates authentication sent to client when Transaction process was triggerd.
  *
  * @param $transaction_ref - String, Transaction reference ID.
  * @param $auth_type - String, OTP or Account_Credit or AnyType of auth that comes in :D
  */  
  public function validateTransactionAuth($tranaction_ref, $auth_type, $auth_value)
  {
     
     $payload = json_encode(
        [
            "transactionRef" => $tranaction_ref, //Flutterwave reference from /v1/transfer call
            "authType"       => $auth_type, //OTP or ACCOUNT_CREDIT
            "authValue"      => $auth_value, //Auth value
        ]
     );

     return self::RequestGetter('/v1/transfer/charge/auth/account', $payload);

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

      $payload =
      	[
            "firstname"                => "Onwuka",
            "lastname"                 => "Gideon",
            "email"                    => "dongidomed@gmail.com",
            "phonenumber"              => "+2348059794251",
            "recipient_bank"           => "044",
            "recipient_acccount_number"=> "0690000004",
            "charge_with"              => "account",
            "recipient"                => "account",
            "sender_account_number"    => "0690000005",
            "sender_bank"              => "044",
            "apiKey"                   => "ts_X9TLQQQJTMDHVA18YN4Hc",
            "amount"                   => 5000,
            "fee"                      => 45,
            "medium"                   => "web",
            "redirectUrl"              => "https://google.com"
       ];

      return $this->RequestGetter('/v1/transfer', $payload);
        
  }

}