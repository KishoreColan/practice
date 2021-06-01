<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customers;
use Auth;

class customerslist extends Controller
{
     public function index() 
    {
        $customer = customers::where('sales_person_id',Auth::id())->get();
        return response()->json(["message"=>"Customer List Belongs to This user","Customer List" => $customer]);
        
    }
    public function show() 
    {
        $customer = customers::get();
        return response()->json(["message"=>"All Customer","Customer List" => $customer]);
        
    }
}
