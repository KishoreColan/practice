@extends('layouts.eventMain')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bus Booking</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Bus Booking</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Book Your Tickets</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="POST" action="{{ url('Bus') }}"  enctype="multipart/form-data" id="book_form">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label >Bus Name</label>
                    <input type="text" class="form-control" name="busname" value="{{ $businfo->bus_name }}" readonly>
                    <p class="err" id="nameerr"> </p>
                  </div>
                  <div class="form-group">
                    <label >From</label>
                    <input type="text" class="form-control" name="busfrom" value="{{ $businfo->bus_from }}"  autocomplete="off" readonly>
                    <p class="err" id="priceerr"></p>
                  </div>
                  <div class="form-group">
                    <label >Destination</label>
                    <input type="text" class="form-control" name="busdestination" value="{{ $businfo->bus_to }}" autocomplete="off" readonly>
                    <p class="err" id="priceerr"></p>
                  </div>

                  <div class="form-group busform">
                  	<div class="form-group col-sm-6 booking">
                    <label >Total no. of Booking</label>
                    <input type="text" class="form-control" name="no_of_book" value="{{ $seat_req }}" readonly id="no_of_book">
                    <p class="err" id="bookerr"></p>
                  </div>
                  <div class="form-group col-sm-6 booking">
                    <label >Total Price</label>
                    <input type="text" class="form-control" name="price" value="{{$seat_req * ($businfo->price)}}" placeholder="dd-mm-yyyy" autocomplete="off" readonly>
                    <p class="err" id="priceerr"></p>
                  </div>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label class="col-md-12">Seat No.</label>
                    <div class="busform">
                    
                    @for ($i=1;$i<=$seat_req;$i++)
                    <div class="col-md-3">
                    <select class="form-control seat_select " name="seat[]" id="select_{{$i}}">
                    		<option value="">Select</option>
                    	  @for ($z =1; $z <=  $businfo->seats_available ; $z++)
					         <option value="{{ $z }}" id="opt_{{$i}}_{{ $z }}" class="opt">{{ $z }}</option>
					      @endfor  
                    </select>
                    <p class="err" id="err_{{$i}}"></p>
                    </div>
                    @endfor
                    </div>
                    
                  </div>

                  <input type="hidden" class="form-control" name="authname" value="{{ Auth::user()->id }}" readonly>

                  <input type="hidden" class="form-control" name="busid" value="{{ $businfo->id }}" readonly>

                <div class="card-footer">
                  <button type="button" class="btn btn-primary" name="submit" id="book_submit">Submit</button>
                </div>

                <div class="popup_1">
	
					<div id = "main_popup">
						<div id="event_popup_1" class="seat">
							<h4>Conformation</h4>
							<p class="input">Please Conform to Pay</p>
			        		<div class="errdiv"><span ></span></div>
							<button type="button" class="hide_popup_1 hide_popup seatpopup" id="canc"><label>Cancel</label></button>
							<input type="submit" class=" seatpopup" id="conf" value="conform">
						</div>
					</div>
				</div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      

      @if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
    </section>

   

@endsection
