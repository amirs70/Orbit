@php use App\Orbit\ui\ParentChildMenu\SidebarMenu\Sidebar; @endphp
@extends("orbit::v1.template.with_header")

@section("body_class", "sidebar-expand-lg bg-body-tertiary")

@section("before_primary_nav")
    <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
        </a>
    </li>
@endsection

@section("before_app_main")
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="{{ route("orbit.dashboard") }}" class="brand-link">
                <img src="{{ orbit_asset("img/logo.png") }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"/>
                <span class="brand-text fw-light">{{config("app.name")}}</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    {!! Sidebar::render() !!}
                    {{--<li class="nav-header">Nav Header</li>--}}
                    {{--<li class="nav-item">
                        <a href="./index.html" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>Level 1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>Treeview <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>
                                        Level 2 (Badge)
                                        <span
                                            class="nav-badge badge text-bg-secondary me-3">6</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>Level 1 Active</p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon bi bi-circle-fill"></i>
                            <p>
                                Treeview Sidebar Open
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2 Active</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                        </ul>
                    </li>--}}
                </ul>
            </nav>
        </div>
    </aside>
@endsection
@section("content")
    <div class="app-main">
        <div class="app-content">
            @yield("content")
        </div>
    </div>
@overwrite
