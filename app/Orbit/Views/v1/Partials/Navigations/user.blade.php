@php @endphp
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">
        <img src="{{ orbit_asset("img/user1-128x128.jpg") }}" class="user-image rounded-circle shadow" alt="User Image">
        <span class="d-none d-md-inline">{{ $user->full_name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
        <li class="user-header text-bg-dark">
            <img src="{{ orbit_asset("img/user1-128x128.jpg") }}" class="rounded-circle shadow" alt="User Image">
            <p>
                {{ $user->full_name }} - Web Developer
                <small>Member since {{ date("M. Y", $user->created_at) }}</small>
            </p>
        </li> <!--end::User Image--> <!--begin::Menu Body-->
        <li class="user-body"> <!--begin::Row-->
            <div class="row">
                <div class="col-4 text-center"><a href="#">Followers</a></div>
                <div class="col-4 text-center"><a href="#">Sales</a></div>
                <div class="col-4 text-center"><a href="#">Friends</a></div>
            </div> <!--end::Row-->
        </li> <!--end::Menu Body--> <!--begin::Menu Footer-->
        <li class="user-footer"><a href="#" class="btn btn-default btn-flat">Profile</a>
            <a href="#" class="btn btn-default btn-flat float-end">Sign out</a></li> <!--end::Menu Footer-->
    </ul>
</li>
