<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/storage/informer/informer.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/storage/css/newstorage.css">
        <script language="javascript" src="/storage/js/jquery-1.11.0.min.js"></script>
        <script language="javascript" src="/storage/informer/informer.js"></script>
        <script>
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr("content") }
            });
        </script>
    </head>
    <title>Uniservice</title>
    <body>
        <div class="menu">
            <img class = "logo" src="/storage/img/logo.png" />
            @if (Auth::user())
                <a href="/logout"><img class = "logoff pic" src="/storage/img/arrow.png" /></a> 
            @endif
        </div>
        <audio id="audio" loop>
            <source src="/storage/IncomingMessage.ogg"> 
        </audio>
        <div class="top-wrapper">
            <div class="top">
                <div class="reloadstorage"></div>
            </div>
        </div>
        <div class="inner">
            @include('/storage/storage_table')
            <div class="navigation">
                <img class="left-button grey" src="/storage/img/arrow-left-grey.png" />
                <img class="right-button grey" src="/storage/img/arrow-right-grey.png" />
                <img class="unavail-button send-status" src="/storage/img/unavail-button-big.png" status="5" />
                <img class="built-button send-status" src="/storage/img/built-button-big.png" status="4" />
            </div>
        </div>
    <script language="javascript" src="/storage/js/storage.js"></script>
    </body>
</html>