<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\temp_book;
use App\Models\bus_book;
use App\Models\passenger;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $buses = Bus::paginate(5);
         // foreach ($buses as $row) {
         //   $tempBook = temp_book::where('bus_id', $row->id)->first() ;
         //   $seattemp[] = $tempBook->seats_booked ;
            
         // }
         // dd($seattemp);
        return view('busbooking.bus_list',compact('buses'));
    }

    public function payprocess()
    {
        return view('busbooking.payload');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('hiddenid');
        $seat_req = $request->input('seat_required');
        // dd($seat);
        $businfo = Bus::where('id', $id)->first();
        //dd($getdatas);
         return view('busbooking.booking',compact('businfo','seat_req'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);

         $tempbook = new temp_book;
         $tempbook->bus_id = $request->busid;
         $tempbook->user_id = $request->authname;
         $tempbook->seats_booked  = $request->no_of_book;
         $tempbook->total_price = $request->price;
         $tempbook->booking_status  = "1";
         $tempbook->seat_no = implode(',', $request->seat);
         $tempbook->save();

        return redirect()->route('payment')->with("tempid",$tempbook->id);
    }

    public function paybook($tempid=null)
    {
        if (!$tempid==null) {
           //dd($tempid);
            $tempBook = temp_book::where('temp_id', $tempid)->first();

            $busBook = new bus_book;
            $busBook->bus_id = $tempBook->bus_id;
            $busBook->user_id = $tempBook->user_id;
            $busBook->seats_booked  = $tempBook->seats_booked;
            $busBook->total_price = $tempBook->total_price;
            $busBook->booking_status  = "2";
            // $busBook->seat_no = implode(',', $request->seat);
            $book = $busBook->save();

            $seats = explode(',', $tempBook->seat_no);

            //dd($seats);
            //dd(count($seats));

            for($i=0; $i<count($seats); $i++){

                //dd($i);
                //echo $seats[$i]."<br>";
                $passengerTb = new passenger;
                $passengerTb->booking_id = $busBook->id;
                $passengerTb->set_no = $seats[$i];
                $passen = $passengerTb->save();
            }

            if($book && $passen){
                temp_book::where('temp_id', $tempid)->delete();

                 return redirect('Bus');
            }
            
        }
        else{
            dd("bookimg canceled");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //
    }
}
