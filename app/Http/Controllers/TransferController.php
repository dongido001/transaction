<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banks;

class TransferController extends Controller
{
    //

    public function index() {
    	
    	$data['banks'] = Banks::all();

    	return view('transfer/index', $data); 
    }
}
