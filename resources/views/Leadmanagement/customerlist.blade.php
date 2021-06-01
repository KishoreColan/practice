@extends('layouts.eventMain')

@section('content')
<style type="text/css">
  .redcol{
    color: red;
  }
  .greencol{
    color: #17a2b8;
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
                  <a href="{{ url('customers/all') }}">Show All</a>
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
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL.No.</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Order Status</th>
                    <th>View</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $i = $customer->perPage() * ($customer->currentPage() - 1)?>
                  @foreach($customer as $row)
                    
                    
                    <tr>
                        <td class='sn'>{{ ++$i }}</td>
                        <td class='cusname'>{{$row->name}}</td>
                        <td class='email'>{{$row->email}}</td>
                        <td class='mobile'> {{$row->mobile}}</td>
                        @if($row->order_status == 1)
                          <td class='addres '><span class="redcol">Sold</span> </td>
                          @else
                           <td class='addres '><span class="greencol">Open</span> </td>
                          @endif
                        <td><a href="{{ url('customer/'.$row->customer_id.'/edit') }}"><i class='fas fa-eye'></a></a></td>
                      </tr>

                  
                 
                   @endforeach
                  </tbody>
                </table>

                {{ $customer->links() }}

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