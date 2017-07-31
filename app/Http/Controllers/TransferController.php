<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banks;
use App\Models\BankAccount;
use App\Helpers\TransferHelper;
use App\Models\Transfer;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd( (new TransferHelper)->getAccessCode() );
        // dd( (new TransferHelper)->validateTransactionAuth('THRI/FLW36169178', 'OTP', '21462474') );
        // dd( (new TransferHelper)->validateCardTransactionAuth('THRI/FLW36169178', 'OTP', '21462474') );s
        // dd( (new TransferHelper)->disburse() );
        // dd( (new TransferHelper)->validateAccountToAccountTransfer('0217053951','315') );
        // dd( (new TransferHelper)->authenticateAccountNumber('0028001752','063') );
        // dd( (new TransferHelper)->makeTransfer('','','','','','') );
        // dd( (new TransferHelper)->makeCardToAccountTransfer('315','0217053951','','',500,'') );

        $data['banks'] = Banks::all()->reject( function( $bank ){
             
             //basically, return only banks that have both bank_code and bank_name...
             return ( empty($bank->bank_code) OR empty($bank->bank_name) );

        });

        return view('transfer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Make single Transfer, from one account to another
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        //

        // $request->session()->flash('status', 'success');

        return $this->index();
    }

    /**
     * Make single Transfer, from one account to another
     * 
     *  $sender_bank, $sender_account_number, $recipient_bank, $recipient_account_number, $amount, $comment
     * @return json
     */
    public function apiSingleTransfer(Request $request)
    {
        //
        
        //TODO, return error when one or more field is not filled...
        $amount = $request->amount;
        $comment = $request->comment;

        $sender_bank = Banks::where('id', $request->parent_bank)->value('bank_code'); //bank_code
        $sender_account_number =  BankAccount::where('id', $request->parent_bank_account)->value('account_number');  
  
        $target_bank = Banks::where('id', $request->target_bank)->value('bank_code'); //bank_code
        $target_account_number = BankAccount::where('id', $request->target_account_number)->value('account_number');

        $result = (new TransferHelper)->makeCardToAccountTransfer(
                           $sender_bank, $sender_account_number, 
                           $target_bank,$target_account_number, $amount, $comment
                         );

        return response()->json( $result );
    }


    /**
     * Comfirm transaction
     * 
     *  $sender_bank, $sender_account_number, $recipient_bank, $recipient_account_number, $amount, $comment
     * @return json
     */
    public function comfirmOtp(Request $request)
    {

        $transaction_ref = $request->transaction_ref;
        $auth_value = $request->auth_value;

        $result = (new TransferHelper)->validateCardTransactionAuth($transaction_ref, $auth_value);
        
        if( $result->status == "success"){
           
           Transfer::where('reference', $transaction_ref)->update( ['status' => 'success'] );
        }
        else{

            Transfer::where('reference', $transaction_ref)->update( ['status' => 'failed'] );
        }

        return response()->json( $result );
    }

    /**
     * Make bulk Transfer, from one account to many accounts
     * 
     * @return \Illuminate\Http\Response
     */
    public function bulk()
    {
        //
    }

    /**
     * shows transaction history
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        //

        $data['transfers'] = Transfer::all();

        return view('transfer.transfer_history', $data);

    }

}
