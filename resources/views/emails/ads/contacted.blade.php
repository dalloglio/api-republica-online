@component('mail::message')
# Contato

Seu anúncio recebeu uma nova mensagem:

Nome: {{ $contact->name }}
E-mail: {{ $contact->email }}
Mensagem: {{ $contact->message }}

@component('mail::button', ['url' => $url, 'color' => 'blue'])
Saiba mais
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
