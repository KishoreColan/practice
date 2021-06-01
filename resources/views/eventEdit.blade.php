@extends('layouts.eventMain')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Event Updation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Event Edit</li>
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
                <h3 class="card-title">Event Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="POST" action="{{ url('event/'.$getdatas->id) }}"  enctype="multipart/form-data">
              @method('PUT')
              @csrf

                <div class="card-body">
                  <div class="form-group">
                    <label >Event Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $getdatas->event_title }}">
                    <p class="err" id="titleerr"></p>
                  </div>
                  <div class="form-group">
                    <label >Event Description</label>
                    <textarea class="form-control" name="descp">{{ $getdatas->event_description }}</textarea>
                    <p class="err" id="descperr"></p>
                  </div>
                  <div class="form-group">
                    <label >Event Start Date</label>
                    <input type="date" class="form-control datepicker" name="start" value="{{ $getdatas->event_start }}" placeholder="dd-mm-yyyy" autocomplete="off">
                    <p class="err" id="starterr"></p>
                  </div>
                  <div class="form-group">
                    <label >Event End Date</label>
                    <input type="date" class="form-control datepicker" name="end" value="{{ $getdatas->event_end }}" placeholder="dd-mm-yyyy" autocomplete="off">
                    <p class="err" id="enderr"></p>
                  </div>
                  <div class="form-group">
                    <label >Event Location</label>
                    <textarea class="form-control" name="location">{{ $getdatas->event_location }}</textarea>
                    <p class="err" id="locaerr"></p>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Event Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image">
                        <label ><img src="{{ URL::asset('thumbimg/'.$getdatas->event_image) }}"></label>
                        @if(Session::has('failed'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('failed')}}
                            </div>
                        @endif
                        <p class="err" id="imageerr"></p>
                      </div>
                     
                    </div>
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
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