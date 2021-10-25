@extends('layouts.main')

@section('title', 'Fazer login')

@section('content')
<div class="my-5 has-text-centered">
    <h1>Fazer login</h1>
</div>
<div id="notf-box"></div>
<form class="col s12" id="login_form" method="post" autocomplete="off">
    @csrf
    <div class="field">
        <label class="label">Email</label>
        <div class="control">
            <input class="input" name="email" type="text" placeholder="Digite seu e-mail">
        </div>
    </div>
    <div class="field">
        <label class="label">Senha</label>
        <div class="control">
            <input class="input" name="senha" type="password" placeholder="Digite sua senha">
        </div>
    </div>
    <div class="field mb-5 has-text-centered">
        <div class="control">
            <button class="button is-link" id="btn_login">Login</button>
        </div>
    </div>
</form>
<script>
    form = document.getElementById("login_form");
    form.addEventListener("submit",async function(e) {
        e.preventDefault();
        document.querySelector("#btn_login").classList.add("is-loading");
        result = await fetch('@php echo url('/') @endphp/login', {
            method: 'POST',
            body: new URLSearchParams(new FormData(document.getElementById("login_form")))
        }).then(function(response) {
            return response.json();
        });
        document.querySelector("#btn_login").classList.remove("is-loading");
        if(result.status == "error") {
            return document.querySelector("#notf-box").innerHTML = "<div class='notification is-danger mb-5 animate-fade-in' id='notf-box-cont'><button class='delete' onclick='document.querySelector(\"#notf-box\").innerHTML=\"\"'></button>" + result.msg + "</div>";
        }
        document.querySelector("#login_form").innerHTML = "<progress class='progress is-small is-link' max='100'>15%</progress>";
        document.location.href = "@php echo url('/') @endphp";
    });
</script>
@endsection