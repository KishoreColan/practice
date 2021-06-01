  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ URL::asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ URL::asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a id="navbarDropdown" class="d-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>
        {{-- <a href="#" class="d-block"> <?php echo isset( $_SESSION['name'])? $_SESSION['name']:header('Location:login/login.php');?> </a> --}}
        
      </div>
    </div>

      <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link highlight">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

     {{--<li class="nav-item">
                  <a href="#" class="nav-link highlight">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Events
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ url('/event') }}" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Event List</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ url('/event/create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create Event</p>
                      </a>
                    </li>
                  </ul>
                </li>
          
                <li class="nav-item">
                  
                      <a href="{{ url('/Bus') }}" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bus List</p>
                      </a>
                    
                </li>--}}

      <li class="nav-item">
            <a href="{{ url('customers/list') }}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Customer List</p>
            </a>
          
      </li>
           
      <li class="nav-item menu-open">
          <a class="nav-link highlight" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
      </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

  
