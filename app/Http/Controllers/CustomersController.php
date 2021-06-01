<?php

namespace App\Http\Controllers;

use App\Models\customers;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Auth;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("kishore");
        return view('Leadmanagement.customerregister')->with("message","you are successfully registered");
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
        $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'address' => 'required',

                 ]);
        $user = User::get();
        //$user = Auth::user()->id;
        $cntarray = array();

        $customerdata = [
           'name' =>$request->name,
           'email' =>$request->email,
           'mobile' =>$request->mobile,
           'address' =>$request->address,
           'order_status ' =>"0"
        ];

        foreach ($user as $value) {
           //echo $value->id."<br>";
          $count =  customers::where('sales_person_id',$value->id)->count();
          //echo $count."<br>";
          $cntarray[$value->id] = $count;
        }
        //print_r($cntarray);
        //echo "minimum ".min($cntarray);
        $userid = array_keys($cntarray, min($cntarray));
        $usercount = count($userid) ;
        if ($usercount > 1) {
            echo "inerseted next".$userid[0];
            $customerdata['sales_person_id'] = $userid[0];
        }
        elseif ($usercount == 1) {
            echo "inerseted next".$userid[0];
            $customerdata['sales_person_id'] = $userid[0];
        }

        //dd($customerdata);
        customers::create($customerdata);

        return redirect('customer')->with("message","You are Sucessfully registered");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

     public function customerList() 
    {
        $customer = customers::where('sales_person_id',Auth::id())->paginate(5);
        return view('Leadmanagement.customerlist',compact('customer'));
    }

    public function allCustomers(){

        $customer = customers::paginate(5);
        return view('Leadmanagement.allcustomer',compact('customer'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = customers::where('customer_id',$id)->get();
        // dd($customer);
        return view('Leadmanagement.customerview',compact('customer'));
      
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(customers $customers)
    {
        //
    }

    public function statusChange($id)
    {
        //dd($id);
        $updated = customers::where('customer_id', $id)->update([
           'order_status' =>"1"
        ]);
        if ($updated) {
           return redirect('customers/list')->with("message","Order Sucessfully completed");
        }
        
    }
}
