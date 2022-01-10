<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

</head>

<body style="font-size: 11px;">
    <div id="app">
        <navbar-component></navbar-component>
        <div class="container">
            <br />
            <b-nav tabs>
                <b-nav-item active>Cupones</b-nav-item>
            </b-nav>
            <coupon-component></coupon-component>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>
