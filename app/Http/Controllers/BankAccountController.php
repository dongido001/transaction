<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banks;
use App\Models\BankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //TODO, paginate later...

        $data['bank_accounts'] = BankAccount::all()->reject( function( $account ){
             
             //basically, return only bank accounts that have both bank_name and account_number...
             return ( empty($account->account_name) OR empty($account->account_number) );

        });

        return view('banks.list_bank_accounts', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data['banks'] = Banks::all()->reject( function( $bank ){
             
             //basically, return only banks that have both bank_code and bank_name...
             return ( empty($bank->bank_code) OR empty($bank->bank_name) );

        });

        return view('banks.add_bank_account', $data);
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

        $this->validate($request, [
            'account_number' => 'required',
            'account_name' => 'required',
        ]);
       
       $bank_account = new BankAccount;

       $bank_account->bank_id = $request->bank_id;

       $bank_account->bank_name = Banks::where('id', $request->bank_id)->value('bank_name');
       $bank_account->account_name = $request->account_name; 
       $bank_account->account_number = $request->account_number;
       $bank_account->firstname = $request->first_name;
       $bank_account->lastname = $request->last_name;
       $bank_account->email = $request->email;
       $bank_account->phonenumber = $request->phone_number;
       $bank_account->description = $request->description;

       $bank_account->save();

       if( $bank_account->save() ){
          
           $request->session()->flash('status', 'success');
       }
       else{

           $request->session()->flash('status', 'failure');
       }

       return $this->create();

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
     * Display list of bank_account to a specific bank.
     *
     * @param  int  $bank_id
     * @return json
     */
    public function listAccounts($bank_id)
    {
        //

        $bank_accounts = BankAccount::where('bank_id', $bank_id)->get(
                            ['bank_name', 'account_number', 'account_name', 'id']
                         );

        return response()->json([
            'status' => 'success',
            'data' => $bank_accounts
        ]);
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
}
