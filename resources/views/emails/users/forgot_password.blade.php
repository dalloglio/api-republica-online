@component('mail::message')
# Olá

Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.

@component('mail::button', ['url' => $url])
Nova Senha
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
