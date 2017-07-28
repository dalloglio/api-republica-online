@component('mail::message')
# Contato

Seu anúncio recebeu uma nova mensagem:

Nome: {{ $contact->name }}<br>
E-mail: {{ $contact->email }}<br>
Mensagem: {{ $contact->message }}<br>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
Saiba mais
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
