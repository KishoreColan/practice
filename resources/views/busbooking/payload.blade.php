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
                <h3 class="card-title">Ticket Payment Process</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="load">
                <p>Please Click Finish to Complete Process</p>
                <div id="loadgif">
                   <img src="{{ URL::asset('assets/gif/load.gif')}}" alt="test" width="100%">
                </div>
                <h3>Payment Processing...</h3>
                <div class="finish">
                  
                  <a href="{{url('/Bus/booked',Session::get('tempid'))}}" type="button" class=" btn btn-success" id="finish">Finish</a>
                </div>
              </div>
             
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