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
	              	<a href="{{ url('/event/create') }}">+ Create Event</a>
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
                    <th>Event Images</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Location</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $i = $events->perPage() * ($events->currentPage() - 1)?>
                 	@foreach($events as $row)
                 		
                 		
                 		<tr>
		                    <td class='sn'>{{ ++$i }}</td>
		                    <td class='img'>
		                    @if (file_exists("thumbimg/".$row->event_image)) 
			                    	<img src="{{ asset('thumbimg/' . $row->event_image) }}">
			           		 @else  
			                    	<img src="{{ asset('thumbimg/No_image.png')}}" width=100px>

			                    
			            	@endif</td>
		                    <td class='title'>{{$row->event_title}}</td>
		                    <td class='start'>{{$row->event_start}}</td>
		                    <td class='end'> {{$row->event_end}}</td>
		                    <td>{{$row->event_location}}</td>
		                    <td><a href="{{ url('event/'.$row->id.'/edit') }}"><i class='fas fa-pen'></a></a></td>
		                    <td>
                          <form action="{{ route('event.destroy',$row->id) }}" id="delete_event_{{$row->id}}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button type="submit" class='show_popup1 td_row1' id='{{$row->id}}' ><i class='fas fa-trash-alt'></i></button>
                          </form>
                        </td>
	                  	</tr>

			            
                 
                   @endforeach
                  </tbody>
                </table>

                {{ $events->links() }}

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
			<div id="event_popup_1">
				<h3>Delete Conformation</h3>
				<p>Are You Sure to delete the product</p>
				<button type="button" class="hide_popup_1 hide_popup" id="yes"><label>Yes</label></button>
				<button class="hide_popup_1 hide_popup" id="no"><label>No, Thanks</label></button>
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
