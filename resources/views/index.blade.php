<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>{{ config('app.name') }}</title>
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app"></div>
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
