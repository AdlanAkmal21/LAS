<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Application System (LAS)</title>
    @include('components.stylesheet')
</head>
<body id="page-top" onload="startTime()">

@yield('content')

<div class="loader-wrapper">
<span class="loader"><span class="loader-inner"></span></span>
</div>

@include('components.script')
</body>
</html>