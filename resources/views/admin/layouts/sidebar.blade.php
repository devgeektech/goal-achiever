 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15"> </div>
        <div class="sidebar-brand-text mx-3">IOLC</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard') }}"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{route('admin.students.index') }}"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Students</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{route('admin.goals.index') }}"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Goals</span></a>
    </li>

    
</ul>
<!-- End of Sidebar -->