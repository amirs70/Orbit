@php use App\Orbit\core\Orbit; @endphp
@extends("orbit::v1.template.base")
@section("body_class", "login-page bg-body-secondary")
@section("content")
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ url("/") }}" class="link-danger text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0">
                        <span class="float-start">{{ config("app.name") }}</span>
                        <div class="d-block float-end">
                            <img width="50px" src="{{ orbit_asset("/img/logo.png") }}" alt="logo"></div>
                    </h1>
                </a></div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @include("orbit::v1.template.alerts")
                <form action="{{ route("orbit.login.post") }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input name="email_or_phone" id="loginEmail" type="text" class="form-control" value="" placeholder="">
                            <label for="loginEmail">Email or phone</label></div>
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input name="password" id="loginPassword" type="password" class="form-control" placeholder="">
                            <label for="loginPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock"></span></div>
                    </div>
                    @if(request()->has("after"))
                        <input type="hidden" name="after" value="{{ request()->get("after") }}">
                    @endif
                    <div class="row">
                        <div class="social-auth-links text-center mb-3 d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i> <span>Sign In</span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-outline-info text-start">
                        <i class="bi bi-bandaid me-2"></i> <span>I forgot my password</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @yield("content")
@overwrite
