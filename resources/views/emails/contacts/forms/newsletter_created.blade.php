@component('mail::message')
# {{ $form->title }}
## {{ $form->description }}

<p>Um novo usuário <se></se> registrou para receber os boletins informativos do site. Segue abaixo as informações preenchidas:</p>

<p><strong>Nome:</strong> {{ $contact->name }}</p>
<p><strong>E-mail:</strong> {{ $contact->email }}</p>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
