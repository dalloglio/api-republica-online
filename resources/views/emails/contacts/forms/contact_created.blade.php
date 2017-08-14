@component('mail::message')
# {{ $form->title }}
## {{ $form->description }}

<p>Uma nova mensagem de contato foi recebida. Segue abaixo as informações preenchidas:</p>

<p><strong>Nome:</strong> {{ $contact->name }}</p>
<p><strong>E-mail:</strong> {{ $contact->email }}</p>
<p><strong>Telefone:</strong> {{ $contact->phone }}</p>
<p><strong>Cidade:</strong> {{ $contact->city }}</p>
<p><strong>Estado:</strong> {{ $contact->state }}</p>
<p><strong>Assunto:</strong> {{ $contact->subject }}</p>
<p><strong>Mensagem:</strong> {{ $contact->message }}</p>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
