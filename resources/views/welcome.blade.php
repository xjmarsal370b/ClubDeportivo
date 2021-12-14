<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Club Deportivo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <style>
        </style>
        <style>
            body {
                padding-top: 3rem;
                padding-bottom: 3rem;
                color: #5a5a5a;
            }


            /* CUSTOMIZE THE CAROUSEL
            -------------------------------------------------- */

            /* Carousel base class */
            .carousel {
                margin-bottom: 4rem;
            }
            /* Since positioning the image, we need to help out the caption */
            .carousel-caption {
                bottom: 3rem;
                z-index: 10;
            }

            /* Declare heights because of positioning of img element */
            .carousel-item {
                height: 32rem;
            }
            .carousel-item > img {
                position: absolute;
                top: 0;
                left: 0;
                min-width: 100%;
                height: 32rem;
            }

            #c1 {
                background-image: url("{{Storage::url('/LandingPageSI/Carousel/C_img_1.jpg')}}");
                background-size: cover;
            }
            #c2 {
                background-image: url("{{Storage::url('/LandingPageSI/Carousel/C_img_2.jpg')}}");
                background-size: cover;
            }
            #c3 {
                background-image: url("{{Storage::url('/LandingPageSI/Carousel/C_img_3.jpg')}}");
                background-size: cover;
            }
            .c_mask {
                background-color: rgba(0, 0, 0, 0.6);
                padding: 1rem;
                border-radius: 10px;
            }

            /* MARKETING CONTENT
            -------------------------------------------------- */

            /* Center align the text within the three columns below the carousel */
            .marketing .col-lg-4 {
                margin-bottom: 1.5rem;
                text-align: center;
            }
            .marketing h2 {
                font-weight: 400;
            }
            /* rtl:begin:ignore */
            .marketing .col-lg-4 p {
                margin-right: .75rem;
                margin-left: .75rem;
            }
            .cat_animation:hover {
                cursor: pointer;
                animation-name: bounce;
                transition: ease;
                animation-timing-function: ease;
                animation-duration: 1.5s;
                transform-origin: bottom;
            }
            @keyframes bounce {
                0%   { transform: scale(1,1)    translateY(0); }
                10%  { transform: scale(1.1,.9) translateY(0); }
                30%  { transform: scale(.9,1.1) translateY(-50px); }
                50%  { transform: scale(1,1)    translateY(0); }
                57%  { transform: scale(1,1)    translateY(-7px); }
                64%  { transform: scale(1,1)    translateY(0); }
                100% { transform: scale(1,1)    translateY(0); }
            }
            /* rtl:end:ignore */


            /* Featurettes
            ------------------------- */

            .featurette-divider {
                margin: 5rem 0; /* Space out the Bootstrap <hr> more */
            }

            /* Thin out the marketing headings */
            .featurette-heading {
                font-weight: 300;
                line-height: 1;
                /* rtl:remove */
                letter-spacing: -.05rem;
            }


            /* RESPONSIVE CSS
            -------------------------------------------------- */

            @media (min-width: 40em) {
                /* Bump up size of carousel content */
                .carousel-caption p {
                    margin-bottom: 1.25rem;
                    font-size: 1.25rem;
                    line-height: 1.4;
                }

                .featurette-heading {
                    font-size: 50px;
                }
            }

            @media (min-width: 62em) {
                .featurette-heading {
                    margin-top: 7rem;
                }
            }

        </style>
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sports Club</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mb-2 mb-md-0 justify-content-end">

                        @if (Route::has('login'))
                                @auth
                                <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="nav-link">Mi espacio</a>
                                </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="nav-link">Regístrate</a>
                                        </li>
                                    @endif
                                @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
                <main>
                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item" id="c1">

                                <div class="container" >
                                    <div class="carousel-caption text-start">
                                        <div class="mask c_mask">
                                            <h1>Nos tomamos enserio el deporte</h1>
                                            <p>Nos tomamos en serio la actividad física y deportiva porque es un antídoto contra todo tipo de enfermedades, porque es una aliada contra el
                                                COVID y porque es un remedio contra los problemas de fatiga pandémica y de salud mental</p>
                                            <p><a class="btn btn-lg btn-primary" href="#cat_div">Categorias</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" id="c2">
                                <div class="container">
                                    <div class="carousel-caption text-start">
                                        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);
                                                                 padding: 1rem;
                                                                 border-radius: 10px;">
                                            <h1>Únete a nosotros</h1>
                                            <p>Forma parte de Sports Club registrándote en nuestra página y espera a que tu solicitud sea aceptada</p>
                                            @if (Route::has('login'))
                                                @auth
                                                        <p><a class="btn btn-lg btn-primary disable" href="{{ url('/home') }}">Oh! Ya eres miembro</a></p>
                                                @else
                                                    @if (Route::has('register'))
                                                            <p><a class="btn btn-lg btn-primary disable" href="{{ route('register') }}">Regístrate</a></p>
                                                    @endif
                                                @endauth
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item active"  id="c3">
                                <div class="container">
                                    <div class="carousel-caption text-start">
                                        <div class="mask c_mask" style="">
                                            <h1>El club deportivo más grande de Andalucía</h1>
                                            <p>Con más de doscientas hectáreas de zonas deportivas, desde canchas de tenis a campos de fútbol y golf, disfruta de las nuevas instalaciones de Sports Club en la costa</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <!-- Marketing messaging and featurettes
                    ================================================== -->
                    <!-- Wrap the rest of the page in another container to center all the content. -->
                    <div class="container marketing" >

                        <!-- Three columns of text below the carousel --><!-- /.row -->


                        <!-- START THE FEATURETTES -->

                        <hr class="featurette-divider">

                        @foreach($events as $event)
                        <div class="row featurette">
                            <div class="col-md-7">
                                <h2 class="featurette-heading">{{ $event->event_name }}</h2>
                                <p class="lead">{{ $event->desc_event }}</p>
                            </div>
                            <div class="col-md-5">
                                <div class="featurette-img" style=" @if($event->event_img) background-image: url('{{ $event->event_img->getUrl() }}' ); @endif
                                    background-size: cover;
                                                                   width: 500px;
                                                                   height: 500px;
                                                                   box-shadow: inset 0 0 5px 5px #ffffff;">
                                </div>
                            </div>
                        </div>

                        <hr class="featurette-divider">
                        @endforeach

                        <!-- /END THE FEATURETTES -->

                    </div><!-- /.container -->


                    <!-- FOOTER -->
                    <footer class="container">
                        <p class="float-end"><a href="#">Inicio</a></p>
                        <p>© 2021 JMMS SPORTS CLUB, Inc. · <a href="#">Política de Privacidad</a> · <a href="#">Términos de usuario</a></p>
                    </footer>
                </main>

        </div>
    </body>
</html>
