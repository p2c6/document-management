<x-mail::message>
Your account has been created!

Welcome to our platform, {{ $fullName }}.

Your email: {{ $email }}.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
