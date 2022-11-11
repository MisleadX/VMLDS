<!DOCTYPE html>
<html lang="en">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    @show

    <title>{{ env('WEBSITE_NAME') }} | @yield('title')</title>

    @section('css')
        <link rel="stylesheet" href="{{ asset('/assets/cms/css/app.css') }}">
        <style type="text/css">
            @font-face {
                font-family: 'Aquino';
                font-style: normal;
                font-weight: normal;
                src: url('{{ asset('assets/web/fonts/Aquino-Demo.woff') }}');
            }

            body {
                position: relative;
                min-height: 100vh;
                max-width: 1280px;
                margin: 0 auto !important;
                font-family: 'sans-serif';
            }

            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
            }

            nav {
                font-size: 24px;
                font-family: 'Aquino';
            }

            .navbar-brand {
                font-size: 24px;
                color: #000000;
            }

            .navbar-nav .nav-item .nav-link {
                color: #788BFF;
                /* color: #FFFFFF; */
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            #navbarNav ul {
                display: flex;
                flex-direction: column;
            }

            @media (min-width: 993px) {
                #navbarNav ul {
                    display: flex;
                    flex-direction: row;
                    gap: 30px;
                }
            }

            .navbar .navbar-toggler[aria-expanded="true"] nav {
                background: #FFFFFF;
            }

            .nopadding {
                padding: 0 !important;
                margin: 0 !important;
            }

            .footer {
                background: #788BFF;
            }

            .content-section {
                padding-bottom: 5rem;
            }
        </style>
    @show
    @section('script-top')
    @show
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container-lg">
            <a class="navbar-brand" href="#">VML</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse pl-lg-5" id="navbarNav">
                <ul class="navbar-nav mx-lg-4 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('homepage') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-section">
        @yield('content')
    </div>

    <footer>
        <div class="text-center p-3 footer text-white">
            Copyright &copy; {{ date('Y') }} <b>VML Digital Solution</b>
        </div>
    </footer>

    @section('script-bottom')
        <script src="{{ asset('/assets/cms/js/app.js') }}"></script>
        <script src="{{ asset('/assets/cms/js/moment.min.js') }}"></script>
        <script type="text/javascript">
            var nav = document.querySelector('nav');
            var navbarNavLink = document.querySelectorAll('#navbarNav .nav-link');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 60) {
                    nav.classList.add('bg-white', 'shadow')
                } else {
                    nav.classList.remove('bg-white', 'shadow');
                }
            });

            $('.navbar-toggler').click(function() {
                if ($(".navbar-toggler").attr("aria-expanded")) {
                    nav.classList.add('bg-white', 'shadow');
                }
            });
        </script>
        @if (session()->has('message'))
            <?php
            switch (session()->get('message_alert')) {
                case 2:
                    $type = 'success';
                    break;
                case 3:
                    $type = 'info';
                    break;
                default:
                    $type = 'danger';
                    break;
            }
            ?>
            <script type="text/javascript">
                'use strict';
                $.notify({
                    // options
                    message: '{!! session()->get('message') !!}'
                }, {
                    // settings
                    type: '{!! $type !!}',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                });
            </script>
        @endif
        <script type="text/javascript">
            'use strict';

            function showErrorMessage(err) {
                let textError = '';
                if (typeof err.responseJSON !== 'undefined') {
                    if (typeof err.responseJSON.errors !== 'undefined') {
                        $.each(err.responseJSON.errors, function(index, item) {
                            textError = item[0];
                            $.notify({
                                // options
                                message: item[0]
                            }, {
                                // settings
                                type: 'danger',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                            });
                        });
                    } else if (typeof err.responseJSON.message === 'string') {
                        textError = err.responseJSON.message;
                        $('#errorForm').html(err.responseJSON.message);
                        $.notify({
                            // options
                            message: err.responseJSON.message
                        }, {
                            // settings
                            type: 'danger',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                        });
                    } else if (typeof err.responseJSON.message === 'object') {
                        textError = err.responseJSON.message[0];
                        $.notify({
                            // options
                            message: err.responseJSON.message[0]
                        }, {
                            // settings
                            type: 'danger',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                        });
                    }
                }

                return textError;
            }
        </script>
    @show
</body>

</html>
