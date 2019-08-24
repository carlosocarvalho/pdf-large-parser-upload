{{--
In this page you should display the user notifications.

Available variables:

$notification - Stores the notification

Most of them include inside the data attribute:

subject => The notification subject (title)
message => Stores the message information.
user => Stores the user id who sent the message (or null to be sent by the system)
--}}

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>User Notifications</title>
    </head>
    <body>
        <h1>User Notifications</h1>
        <h2>{{ $notification->data['subject'] }}</h2>
        @if(array_key_exists('user', $notification->data) and $notification->data['user'])
            <h4>{{ $notification->created_at->diffForHumans() }} by {{ $notification->data['user']['name'] }}</h4>
        @else
            <h4>{{ $notification->created_at->diffForHumans() }} by {{ \Laralum\Settings\Models\Settings::first()->appname }}</h4>
        @endif
        <p>
            {{ $notification->data['message'] }}
        </p>
    </body>
</html>
