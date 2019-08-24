<!DOCTYPE html>
<html lang="en">
    <head>
        @php
            $settings = Laralum\Settings\Models\Settings::first();
        @endphp
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@lang('laralum_profile::general.edit_profile') - {{ $settings->appname }}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ \Laralum\Laralum\Packages::css() }}">

    </head>
    <body>

        <h1>@lang('laralum_profile::general.edit_profile')</h1>
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

        <form method="POST" enctype="multipart/form-data" action="{{ route("laralum_public::profile.update") }}">
            @lang('laralum_profile::general.edit_profile') ({{ $user->email }})
            <br><br>
            {!! csrf_field() !!}

            {{-- <label for="picture">@lang('laralum_profile::general.profile_picture')</label>
            <input type="file" id="file" name="picture" value="{{old('picture')}}" class="custom-file-input">
            <br>
            <input type="checkbox" name="save_picture" id="save_picture" class="custom-control-input" @if(old('save_picture',$user->hasAvatar())) checked @endif>
            <span>@lang('laralum_profile::general.save_picture')</span>
            <br> --}}

            <label for="name">@lang('laralum::general.name')</label>
            <input id="name" type="text" name="name" value="{{ old('name', isset($user->name) ? $user->name : '' ) }}" class="form-control">
            <br>
            <label for="password">@lang('laralum::general.password')</label>
            <input id="password" type="password" name="password" value="">
            <br>
            <label for="password_confirmation">@lang('laralum::general.password_confirmation')</label>
            <input id="password_confirmation" type="password" name="password_confirmation" value="">
            <br>
            <label for="current_password">@lang('laralum::general.current_password')</label>
            <input id="current_password" type="password" name="current_password" value="">
            <br>

            <a href="#">@lang('laralum::general.cancel')</a>
            <button type="submit" class="btn btn-success float-right clickable">@lang('laralum::general.update')</button>
        </form>
        {{-- <script>
            $(function () {
                $('#file').click(function () {
                    $('#save_picture').attr('checked', true);
                });
            });
        </script> --}}
    </body>
</html>
