<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/components/components-font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/components/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('css/components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/components/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('css/default/components.min.css') }}" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="{{ asset('css/default/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('css/login-5.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
</head>

<body class=" login">
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset">
                <div class="login-bg" style="background-image:url({{ asset('img/bg1.jpg') }})">

                </div>
            </div>
            <div class="col-md-6 login-container bs-reset">
                <div class="login-content">
                    <h1>Jido</h1>
                    <p> Administración </p>

                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Complete los campos de nombre de usuario y contraseña</span>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" class="login-form">
                        @csrf

                        @if (session()->has('message'))
                            <div class="alert alert-danger" role="alert">
                                <li>{{ session()->get('message') }}</li>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" name="user" placeholder="usuario" required value="{{Request::old('matricula')}}"
                                    class="form-control form-group" autocomplete="off">
                            </div>
                            <div class="col-xs-6">
                                <input type="password" name="password" placeholder="contraseña" required value="{{Request::old('senha')}}" class="form-control form-group"
                                    autocomplete="off">
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-info" type="submit">Iniciar sesión</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('css/components/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('css/components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('css/components/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('css/components/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('css/components/blockUI/jquery.blockUI.js') }}" type="text/javascript"></script>
        <script src="{{ asset('css/components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}" type="text/javascript">
        </script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('css/components/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('css/components/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('css/components/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('css/components/jquery-backstretch/jquery.backstretch.min.js') }}" type="text/javascript">
        </script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('scripts/login-5.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->


        <script>
            // init background slide images
            $('.login-bg').backstretch([
                "{{ asset('img/jido1.png') }}",
                "{{ asset('img/bg2.jpg') }}",
            ], {
                fade: 1000,
                duration: 5000,
                centeredX: false,
            });
        </script>
</body>

</html>
