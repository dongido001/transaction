<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of all the banks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        //TODO, paginate later...

        $data['banks'] = Banks::all()->reject( function( $bank ){
             
             //basically, return only bank accounts that have both bank_name and account_number...
             return ( empty($bank->bank_name) OR empty($bank->bank_code) );

        });

        return view('banks.list_banks', $data);
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

       $bank_account->account_name = $request->account_name; 

       $bank_account->account_number = $request->account_number;

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
     * @param  \App\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function show(Banks $banks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function edit(Banks $banks, $id)
    {
        //
       
       dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banks $banks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banks $banks)
    {
        //
    }
}
