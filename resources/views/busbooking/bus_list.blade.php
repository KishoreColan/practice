@extends('layouts.eventMain')

@section('content')

<div class="container-fluid">
	    <div class="row">

		    <div>

			    	@if (Session::has('message')) 
					
						<div class='popup_2'>
							<div id = 'main_popup_2'>
								<div id='mssg_popup_2'>

									<p class='but'><button class='hide_popup_2 hide_popup' id='cancel'><label>X</label></button></p>
									<h3 class='success'>{{ Session::get('message') }}</h3>
									
								</div>
							</div>
						</div>

					@endif

		    </div>
	    </div>
   </div>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 prod_head">
            <h1>Event List</h1>
          </div>
          <div class="col-sm-6 create">
            <ol class="breadcrumb float-sm-right">
             	<li class="breadcrumb-item">
	              	<select id="select">
	              		<option class="opt0">{{--<?php echo isset($_SESSION['db'])?$_SESSION['db']:"Select";?>--}}</option>
	              		<option value="task_db">Task DB</option>
	              		<option value="task2_db">Task2 DB</option>
	              		<option value="task3_db">Task3 DB</option>
	              		<option value="archive_db">Archive DB</option>
	              	</select>
	              	<a href="archive.php?message=submit" class="archive"><i class="fa fa-archive" aria-hidden="true"></i> Archive</a>
	              	<a href="event_create.php">+ Create Event</a>
              	</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Event Details Listed Below</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL.No.</th>
                    <th>Bus Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Available Seats</th>
                    <th>Price</th>
                    <th>Bus Available</th>
                    <th>Booking</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $i = $buses->perPage() * ($buses->currentPage() - 1)?>
                 	@foreach($buses as $row)
                 		
                 		
                 		<tr>
		                    <td class='sn'>{{ ++$i }}</td>
		                    
		                    <td class='name'>{{$row->bus_name}}</td>
		                    <td class='from'>{{$row->bus_from}}</td>
		                    <td class='to'> {{$row->bus_to}}</td>
                        <td class='sets' id="seat_{{$row->id}}">{{$row->seats_available}}</td>
		                    <td class='price'>Rs. {{$row->price}}</td>
		                    <td class='bus_avail'>
                        @if($row->bus_available == "available")
                          <span class="avail"></span>
                        @else
                          <span class="notavail"></span>
                        @endif
                        </td>
		                    <td>
                            <button type="submit" class='show_popup1 td_row1 book' id='{{$row->id}}' > Book Now </button>

                        </td>
	                  	</tr>

			            
                 
                   @endforeach
                  </tbody>
                </table>

                {{ $buses->links() }}

                <input type="hidden" name="hide" id="hide">

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- Delete popup -->

    <div class="popup_1">
	
		<div id = "main_popup">
			<div id="event_popup_1" class="seat">
				<h4>Please Select Seats Required</h4>
        <form action="{{url('/Bus/booking')}}" method="post">
        @csrf
				<p class="input"><input type="number" name="seat_required" class="col-md-3" id="input_seat" /></p>
        <div class="errdiv"><span class="seaterr"></span></div>
				<button type="button" class="hide_popup_1 hide_popup seatpopup" id="canc"><label>Cancel</label></button>
				<input type="submit" class=" seatpopup" id="proceed" value="proceed">
        <input type="hidden" name="hiddenid" id="idhide">
        </form>
			</div>
		</div>
	</div>

 
  </div>
 {{-- <?php

		$deleteid = isset($_GET['uid'])?$_GET['uid']:"";

		//echo $deleteid;

		$sql = "DELETE from event_tb WHERE event_id = $deleteid";

		if(mysqli_query($con, $sql)){

			header('Location: ?message=Product deleted successfully...');
		}

	?>

  <?php

  	include '../includepages/footer.php';
  ?> --}}



@endsection