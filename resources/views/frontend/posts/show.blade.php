@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ $post->category->cat_name }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.posts.index') }}">
                                    Volver a Noticias
                                </a>
                            </div>
                            <div
                                class="p-5 text-center bg-image rounded-3"
                                style="
                                @if($post->post_img)
                                    background-image: url('{{$post->post_img->getUrl()}}');
                                @endif
                                    height: 400px;
                                    background-size: cover;
                                    box-shadow: inset 0 0 5px 5px #ffffff;
                                    "
                            >
                                <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);
                                                     padding: 1rem;
                                                     border-radius: 10px;">
                                    <div class=item-align-left>
                                        <div class="text-white">
                                            <h1 class="text-left">{{ $post->post_title }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3>Información</h3>
                                <div class="alert alert-secondary" role="alert">
                                    {{ $post->post_header }}
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <a class="btn btn-default" href="{{ route('frontend.posts.index') }}">
                                    Volver a Noticias
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        Artículo subido por {{ $post->user->name }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
