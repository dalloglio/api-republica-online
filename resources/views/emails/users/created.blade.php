@component('mail::message')
# Seja bem vindo

Olá {{ $user->name }}, a sua conta no {{ config('app.name') }} foi criada com sucesso e agora você já pode utilizar todos os recursos do site. Aproveite também para criar o seu primeiro anúncio.

Seus dados de acesso:<br>
E-mail: {{ $user->email }}<br>
Senha: a senha que você cadastrou.

@component('mail::button', ['url' => $url, 'color' => 'blue'])
Criar um anúncio
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
