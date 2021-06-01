@extends('layouts.eventMain')

@section('content')
<style type="text/css">
  .table th,.table td{
        border-top: none !important;
        text-align: left;
  }
  .rigth{
    float:right;
  }
  .table thead th{
    border-bottom: none;
  }
</style>
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
            <h1>Customer List</h1>
          </div>
          <div class="col-sm-6 create">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">
                      <a href="{{ url('customers/list') }}">Back</a>
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
                <h3 class="card-title">Your Customer Details Listed Below</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               @foreach($customer as $row)
                <table id="example2" class="table">
                  <thead>
                  <tr>
                    <th><h3>Customer Detials</h3></th>
                  </tr>
                  </thead>
                  <tbody>
                 
   
                    <tr>
                        <th>Customer Name</th>
                        <td class='cusname'>{{$row->name}}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td class='email'>{{$row->email}}</td>
                    </tr>
                    <tr>
                      <th>Mobile</th>
                      <td class='mobile'> {{$row->mobile}}</td>
                    </tr>
                        
                      <tr>
                        <th>Address</th>
                        <td class='addres'> {{$row->address}}</td>
                      </tr>
                       

                        <tr>
                          <th>Oredr Status</th>
                          @if($row->order_status == 1)
                          <td class='addres '><span class="alert alert-danger">Sold</span> </td>
                          @else
                           <td class='addres '><span class="alert alert-info">Open</span> </td>
                          @endif
                        </tr>
                        
                   
                  </tbody>
                </table>
                <div>
                   @if($row->order_status == 0)

                          <a href="{{url('customers/complete',$row->customer_id)}}" class="btn btn-success rigth">Complete</a>
                        @endif
                </div>

                @endforeach

               {{--<form action="{{url('customer',$row->customer_id)}}" method="put">
                                                 @csrf
                              
                                                   <input type="submit" name="submit" value="Complete" class="btn btn-success rigth">
                                                 </form>--}}

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

    {{--<div class="popup_1">
          
            <div id = "main_popup">
              <div id="event_popup_1">
                <h3>Delete Conformation</h3>
                <p>Are You Sure to delete the product</p>
                <button type="button" class="hide_popup_1 hide_popup" id="yes"><label>Yes</label></button>
                <button class="hide_popup_1 hide_popup" id="no"><label>No, Thanks</label></button>
              </div>
            </div>
          </div>--}}

 
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