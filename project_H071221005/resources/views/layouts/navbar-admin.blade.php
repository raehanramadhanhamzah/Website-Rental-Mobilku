<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('homeAdmin')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-car"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Rental Mobilku</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Heading -->
<div class="sidebar-heading">
    Menu
</div>

<li class="nav-item active">
    <a class="nav-link" href="{{route('dashboardAdmin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="{{route('carListAdmin')}}">
    <i class="fas fa-fw  fa-solid fa-car"></i>
        <span>Car List</span></a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="{{route('driverListAdmin')}}">
        <i class="fas fa-fw fa-id-card"></i>
        <span>Driver List</span></a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="{{route('paymentsAdmin')}}">
        <i class="fas fa-fw fa-solid fa-money-bill"></i>
        <span>Payment</span></a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="{{route('userProfileList')}}">
        <i class="fas fa-fw  fa-solid fa-user"></i>
        <span>User Profile</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Management
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link " href="{{route('carManageAdmin')}}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Car Management</span>
    </a>
    
</li>
<li class="nav-item">
    <a class="nav-link " href="{{route('driverManageAdmin')}}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Driver Management</span>
    </a>
    
</li>
<li class="nav-item">
    <a class="nav-link " href="{{route('paymentManageAdmin')}}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Payment Management</span>
    </a>
    
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->