{{--
In this page you should display the user notifications.

Available variables:

$notifications - Stores all the logged in user notifications

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
        <ul>
            @forelse ($notifications as $notification)
                <li>
                    @if ($notification->unread())
                        (Unread)
                    @else
                        (Read)
                    @endif
                    <a href="{{ route('laralum_public::notifications.show', ['notification' => $notification->id]) }}">
                        {{ $notification->data['subject'] }}
                    </a>
                    - {{ $notification->created_at->diffForHumans() }}
                </li>
            @empty
                <li>
                    No notifications found
                </li>
            @endforelse
        </ul>
    </body>
</html>
