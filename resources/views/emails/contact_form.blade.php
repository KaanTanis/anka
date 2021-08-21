@component('mail::message')
# İletişim Formu

@isset($request['name'])
<strong>İsim: </strong> {{ $request['name'] }}
<br>
@endisset
@isset($request['email'])
<strong>Email: </strong> {{ $request['email'] }}
<br>
@endisset
@isset($request['phone'])
<strong>Telefon: </strong> {{ $request['phone'] }}
<br>
@endisset
@isset($request['phone'])
<strong>Konu: </strong> {{ $request['subject'] }}
<br>
@endisset
@isset($request['message'])
<strong>Mesaj: </strong> {{ $request['message'] }}
@endisset

@endcomponent
