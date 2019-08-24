<!DOCTYPE html>
<html lang="en">
    <head>
        @php
            $settings = Laralum\Settings\Models\Settings::first();
        @endphp
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@lang('laralum_profile::general.profile') - {{ $settings->appname }}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ \Laralum\Laralum\Packages::css() }}">

    </head>
    <body>

        <h1>@lang('laralum_profile::general.profile')</h1>
        @if(Session::has('success'))
            <hr>
            <p style="color:green">
                {{Session::get('success')}}
            </p>
            <hr>
        @endif
        @if(Session::has('info'))
            <hr>
            <p style="color:blue">
                {{Session::get('info')}}
            </p>
            <hr>
        @endif
        @if(Session::has('error'))
            <hr>
            <p style="color:red">
                {{Session::get('error')}}
            </p>
            <hr>
        @endif
        @if(count($errors->all()))
            <hr>
            <p style="color:red">
                @foreach($errors->all() as $error) {{$error}}<br/>@endforeach
            </p>
            <hr>

        @endif
        <card>
            <center>
                <img src="{{ $user->avatar() }}" alt="@lang('laralum_profile::general.profile_picture')" style="max-width:100px;max-height:100px;border-radius:50px">
                <p style="font-size:20px;">{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
                <a href="{{ route('laralum_public::profile.edit') }}">@lang('laralum::general.edit')</a>
            </center>
        </card>
    </body>
</html>
