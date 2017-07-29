<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banks;

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

        dd($request);

        $request->session()->flash('status', 'success');

        return $this->index();
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
    }

}
