@component('mail::message')
# {{ $form->title }}
## {{ $form->description }}

<p>Um novo currículo foi recebido. Segue abaixo as informações preenchidas:</p>

<p><strong>Nome:</strong> {{ $contact->name }}</p>
<p><strong>E-mail:</strong> {{ $contact->email }}</p>
<p><strong>Telefone:</strong> {{ $contact->phone }}</p>
<p><strong>Cidade:</strong> {{ $contact->city }}</p>
<p><strong>Estado:</strong> {{ $contact->state }}</p>
<p><strong>Cargo:</strong> {{ $contact->role }}</p>
<p><strong>Sobre:</strong> {{ $contact->about }}</p>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
