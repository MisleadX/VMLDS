@extends(env('WEBSITE_TEMPLATE') . '._base.layout')

@section('title', __('general.home'))

<?php
$homepage = $page['homepage'] ?? [];
?>

@section('css')
    @parent
    <style>
        .homepage {
            height: 500px;
            background: radial-gradient(circle at right center, #788BFF 0%, #788BFF 50%, #788BFF 50%, transparent 0, transparent 0);
        }

        .homepage-desc {
            color: rgba(103, 72, 72, 0.8);
            text-align: justify;
            text-justify: inter-word;
        }

        .homepage-details {
            padding: 0 2rem;
        }

        .carousel-indicators {
            position: relative !important;
            margin: 0 !important;
            -webkit-box-pack: start !important;
            justify-content: start !important;
        }

        .carousel-item {
            color: rgba(103, 72, 72, 0.8);
        }

        .carousel-indicators li {
            width: 1.5rem !important;
            height: 1.5rem !important;
            border-radius: 100% !important;
            background-color: #D9D9D9 !important;
        }

        .carousel-indicators .active {
            background-color: #788BFF !important;
        }

        .title {
            color: #788BFF;
            font-family: 'Aquino';
        }

        .carousel-item {
            height: 100%;
            min-height: 250px;
        }
    </style>
@stop

@section('content')
    <div class="homepage row">
        <div class="col-md-6 align-self-center">
            <div class="homepage-details">
                <h1 class="title">
                    {{ $homepage['title'] ?? '' }}
                </h1>
                <div class="homepage-desc">
                    {!! $homepage['content'] ?? '' !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ isset($homepage['image']) ? asset($homepage['image']) : asset('assets/cms/images/no-img.png') }}"
                class="img-responsive img-fluid w-75" alt="Homepage Logo" />
        </div>
    </div>
    <div class="about row pt-md-2 nopadding">
        <div class="col-md-6 d-flex align-self-center justify-content-center">
            <img src="{{ isset($homepage['image_2']) ? asset($homepage['image_2']) : asset('assets/cms/images/no-img.png') }}"
                class="img-responsive img-fluid w-75" alt="About Logo" />
        </div>
        <div class="col-md-6 align-self-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h1 class="title">{{ $homepage['title_2'] ?? "About Us" }}</h1>
                        {!! $homepage['content_2'] ?? '' !!}
                    </div>
                    <div class="carousel-item">
                        <h1 class="title">{{ $homepage['title_3'] ?? "Our Vision" }}</h1>
                        {!! $homepage['content_3'] ?? '' !!}
                    </div>
                    <div class="carousel-item">
                        <h1 class="title">{{ $homepage['title_4'] ?? "Our Mission" }}</h1>
                        {!! $homepage['content_4'] ?? '' !!}
                    </div>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('script-bottom')
    @parent
@stop
