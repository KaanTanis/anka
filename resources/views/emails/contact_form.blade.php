@component('mail::message')
# İletişim Formu

<strong>İsim: </strong> {{ $request['name'] }}
<br>
<strong>Email: </strong> {{ $request['email'] }}
<br>
<strong>Konu: </strong> {{ $request['subject'] }}
<br>
<strong>Mesaj: </strong> <br> {{ $request['message'] }}
@endcomponent
