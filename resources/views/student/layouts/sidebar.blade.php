 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('student.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15"> </div>
        <div class="sidebar-brand-text mx-3">IOLC</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('student/dashboard*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('student.dashboard') }}"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ (request()->is('student/goals*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('student.goals.index') }}"> <i class="fas fa-fw fa-cog"></i> <span>All Goals</span></a>
    </li>
    <li class="nav-item {{ (request()->is('student/taken_goals*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('student.taken_goals.index') }}"> <i class="fas fa-fw fa-chart-area"></i> <span>Taken Goals</span></a>
    </li>
    <li class="nav-item {{ (request()->is('student/plans*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('student.plans.index') }}"> <i class="fas fa-fw fa-folder"></i> <span>Plans</span></a>
    </li>
    
    {{-- <li class="nav-item ">
        <a class="nav-link" href="{{route('admin.goals.index') }}"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Goals</span></a>
    </li> --}}

    
</ul>
<!-- End of Sidebar -->