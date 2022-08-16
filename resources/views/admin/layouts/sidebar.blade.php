 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15"> </div>
        <div class="sidebar-brand-text mx-3">IOLC</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.dashboard') }}"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/units*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.units.index') }}"> <i class="fas fa-fw fa-chart-area"></i> <span>Add Unit</span></a>
    </li> 
    <li class="nav-item {{ (request()->is('admin/topics*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.topics.index') }}"> <i class="fas fa-fw fa-table"></i> <span>Add Topic</span></a>
    </li> 
    <li class="nav-item {{ (request()->is('admin/goals*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.goals.index') }}"> <i class="fas fa-fw fa-bell"></i> <span>Goals</span></a>
    </li> 
    <li class="nav-item {{ (request()->is('admin/students*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.students.index') }}"> <i class="fas fa-fw fa-envelope"></i> <span>Students</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/plans*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.plans.index') }}"> <i class="fas fa-fw fa-list"></i> <span>Membership Plans</span></a>
    </li>

    
</ul>
<!-- End of Sidebar -->