@php use App\Orbit\ui\ParentChildMenu\NavigationMenu\Navigation; @endphp
@extends("orbit::v1.template.base")
@php $app_wrapper = true; @endphp
@section("body_class", "bg-body-secondary")
@section("content")
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Start navbar links -->
            <ul class="navbar-nav">
                @yield("before_primary_nav")
                <li class="nav-item d-none d-md-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                @yield("after_primary_nav")
            </ul>
            <!-- End navbar links -->
            {{--<ul class="navbar-nav ms-auto">{!! Navigation::printAll() !!}</ul>--}}
            <ul class="navbar-nav ms-auto">
                @foreach(Navigation::getAll() as $nav)
                    @if($nav->hasLivewire())
                        @livewire($nav->getLivewireComponent(), ["navHandler" => $nav->getHandler()])
                    @else
                        {!! $nav->getView() !!}
                    @endif
                @endforeach
            </ul>
        </div>
        <!--end::Container-->
    </nav>

    @yield("before_app_main")
    <div class="app-main">
        @include("orbit::v1.Partials.content_header")
        @yield("content")
    </div>
@overwrite
