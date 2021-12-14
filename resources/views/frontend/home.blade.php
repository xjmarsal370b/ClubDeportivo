@extends('layouts.frontend')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel de Control') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                                   <h1> ¡Bienvenido tu espacio {{ Auth::user()->name }}! </h1>
                        <hr>
                            <div class="row"  id="cat_div" style="margin-bottom: 1.5rem;text-align: center;">
                                    <div class="col-lg-4" >
                                        <a href="{{ route('frontend.profile.index') }}">
                                            <img class="cat_animation" src="{{Storage::url('/LandingPageSI/Frontend_icons/profile.png')}}" width="150px" height="150px" >
                                            <h2>{{ __('My profile') }} »</h2>
                                        </a>

                                    </div>
                                    @can('event_access')
                                        <div class="col-lg-4">
                                            <a href="{{ route('frontend.events.index') }}">
                                                <img class="cat_animation" src="{{Storage::url('/LandingPageSI/Frontend_icons/event.png')}}" width="150px" height="150px" >
                                            <h2>{{ trans('cruds.event.title') }} »</h2>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('result_access')
                                        <div class="col-lg-4">
                                            <a href="{{ route('frontend.results.index') }}">
                                                <img class="cat_animation" src="{{Storage::url('/LandingPageSI/Frontend_icons/restult.png')}}" width="150px" height="150px" >
                                                <h2>{{ trans('cruds.result.title') }} »</h2>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('post_access')
                                        <div class="col-lg-4">
                                            <a href="{{ route('frontend.posts.index') }}">
                                                <img class="cat_animation" src="{{Storage::url('/LandingPageSI/Frontend_icons/post.png')}}" width="150px" height="150px" >
                                                <h2>{{ trans('cruds.post.title') }} »</h2>
                                            </a>
                                        </div>
                                    @endcan
                            </div>
                                </div>
                            </li>
                        @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

