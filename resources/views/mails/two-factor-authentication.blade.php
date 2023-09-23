<x-mail::message>
    # Hello {{ $user }}

    You are receiving this mail because you made a request to login to your account at {{ config('app.name') }}.

    Your Two Factor Authentication code is:

    <x-mail::panel>
        {{ $code }}
    </x-mail::panel>

    This code expires in 5 minutes.

    Do not share the above code and please ignore this message if you didn't make this request and we won't allow the request.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>