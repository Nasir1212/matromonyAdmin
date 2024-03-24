<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="p3">
      
  <!-- Brand Logo -->
  {{-- <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a> --}}

  <form class="form-inline">
    <div class="input-group">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <li class="nav-item">
                <a href="/" class="nav-link ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                   Dashboard 
                    <span class="right badge badge-danger">4</span>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/list_register_view" class="nav-link ">
                  <i class="nav-icon fas fa-registered"></i>
                  <p>
                   List  Register 
                    
                  </p>
                </a>
              </li>
        
        <li class="nav-item ">
          <a href="#" class="nav-link ">
            {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
            <i class="nav-icon fas fa-solid fa-blog"></i>
            <p>
              Blogs 
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{URL::to("/create_blogs_page")}}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Create a Blog</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{URL::to("/all_blog")}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Blogs</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{URL::to('/clientcontact')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Client Contact
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>
        @if (session('staff') !=true)
        
        <li class="nav-item">
          <a href="{{URL::to('/multi_user_page')}}" class="nav-link">
            <i class="nav-icon fa fa-user" aria-hidden="true"></i>
            <p>
              Multi User
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{URL::to('/buyerpackage')}}" class="nav-link">
            <i class="nav-icon fas fa-people-carry"></i>
           
            <p>
              buyer package

              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </div>
</aside>