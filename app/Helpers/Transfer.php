<?php


namespace App\Helpers;

class TransferHelper{

   public $request_payload;

   function __construct() {

       this->$request_payload = json_encode( [
             "apiKey" => env('PAYSTACK_APIKEY'),
             "secret" => env('PAYSTACK_SECRET')
          ]
       );
   }

  /**
  * Makes request to the Api end points.
  *
  * @param $url - String, probably the end point link.
  * @param $params - Array, The Request content
  */  
  public static function RequestGetter( $url, $params = [] ){

     $return = \Web::instance()->request(
          
          $f3->get('API_BASE_URL') . $url,
           [
              'header'=> [
                  'Accept: application/json',
                  'Authorization: '.self::getAccessCode($f3),
                  'Content-Type: application/json',
               ],
              'method'  => 'POST',
              'content' => $params,
          ]
      );
     
     return $return['body'];

  }

  /**
  * Get access token from the api so we can query the endpoints without problems.
  * 
  */  
  public static function getAccessCode(){

     $return = \Web::instance()->request(
          
          $f3->get('API_BASE_URL') . '/v1/merchant/verify',
          array(
              'header'=>array(
                  'Content-Type: application/json',
              ),
              'method'  =>'POST',
              'content' => this->$request_payload,
          )
      );
     

     return json_decode(($return['body']), true)['token'];

  }  

  /**
  * Get list of banks available on the Api.
  * 
  */  
  public static function getBanks(){

    return self::RequestGetter('/banks', []);
    
  }

  /**
  * Checks if account number is correct.
  *
  * @param $account_number, String
  * @param $bank_code, String
  */  
  public static function authenticateAccountNumber($account_number, $bank_code){

     return self::RequestGetter('/v1/transfer', this->$request_payload);

  }   

  /**
  * Validates authentication sent to client when Transaction process was triggerd.
  *
  * @param $transaction_ref - String, Transaction reference ID.
  * @param $auth_type - String, OTP or Account_Credit or AnyType of auth that comes in :D
  */  
  public static function validateTransactionAuth($tranaction_ref, $auth_type, $auth_value)
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
  public static function makeTransfer($sender_bank, $sender_account_number, $recipient_bank, $recipient_account_number, $amount, $comment){

      $payload = json_encode( 
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
        ]
     );

      return self::RequestGetter('/v1/transfer', $payload);
        
  }