  <?php 
  if (!isset($PARENTTAG)) { //pasang kondisi jika variable parenntag belum disetting controller
    $PARENTTAG = '';
  }
   ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('/')}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">School System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?= $PARENTTAG=='home'?'menu-open':'' ?>">
            <a href="{{url('/')}}" class="nav-link <?= $PARENTTAG=='home'?'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='class'?'menu-open':'' ?>">
            <a href="{{url('/class')}}" class="nav-link <?= $PARENTTAG=='class'?'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Class
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='employee'?'menu-open':'' ?>">
            <a href="{{url('/employee')}}" class="nav-link <?= $PARENTTAG=='employee'?'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Teacher
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='parent'?'menu-open':'' ?>">
            <a href="{{url('/parent')}}" class="nav-link <?= $PARENTTAG=='parent'?'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Parent
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='student'?'menu-open':'' ?>">
            <a href="{{url('/student')}}" class="nav-link <?= $PARENTTAG=='student'?'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Student
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>