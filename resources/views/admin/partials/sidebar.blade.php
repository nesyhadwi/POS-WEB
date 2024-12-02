<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-smile"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Restauran <sup>App</sup></div>
    </a>
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">
        Menu
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.data_users') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.data_product') }}">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Product</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    
</ul>
<style>
    .sidebar {
        background: #343a40; /* Darker background for better contrast */
    }

    .sidebar .nav-link {
        color: #ffffff; /* White text for links */
        transition: background-color 0.3s; /* Smooth transition */
    }

    .sidebar .nav-link:hover {
        background-color: #495057; /* Lighter background on hover */
        color: #ffffff; /* Keep text white on hover */
    }

    .sidebar .nav-link i {
        margin-right: 10px; /* Space between icon and text */
    }

    .sidebar-heading {
        font-weight: bold; /* Make the heading bold */
        font-size: 1.1rem; /* Increase font size */
        color: #ffffff; /* White text for the heading */
        padding: 10px 15px; /* Add padding */
    }

    .sidebar-brand {
        padding: 15px; /* Padding for the brand */
    }

    .sidebar-brand-icon {
        font-size: 1.5rem; /* Increase icon size */
    }
</style>