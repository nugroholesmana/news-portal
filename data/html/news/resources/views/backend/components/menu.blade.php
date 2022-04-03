<li class="nav-item {{ Request::is('admin*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('admin') }}">
        <i class="fa fa-user nav-icon" aria-hidden="true"></i> 
        <span>Admin</span>
    </a>
</li>
<li class="nav-item {{ Request::is('article*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('artikel') }}">
        <i class="fa fa-list nav-icon" aria-hidden="true"></i> 
        <span>Article</span>
    </a>
</li>



