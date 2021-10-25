@extends('layouts.main')

@section('title', 'YouTube API')

@section('content')
@include('layouts/navbar')

@if(session('message'))
@php
$message = json_decode(session('message'));
@endphp
<div id="notf-box">
    <div class='notification is-{{ $message->status }} mt-5 animate-fade-in' id='notf-box-cont'><button class='delete' onclick='document.querySelector("#notf-box").innerHTML=""'></button>{{ $message->msg }}</div>
</div>
@endif


<div class="body" id="body">
    <form autocomplete="off" method="post" action="{{ url('/users/store') }}" id="user-create-form">
        @csrf
        <div class="field">
            <label class="label">Nome</label>
            <div class="control">
                <input name="nome" class="input" type="text" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field">
            <label class="label">Sobrenome</label>
            <div class="control">
                <input name="sobrenome" class="input" type="text" placeholder="Insira o nome"required />
            </div>
        </div>
        <div class="field">
            <label class="label">Tipo</label>
            <div class="control">
                <div class="select">
                    <select name="tipo" required>
                        <option value="">Selecione um tipo</option>
                        <option value="usuario">Usuário</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label">Telefone</label>
            <div class="control">
                <input name="telefone" class="input" type="text" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field">
            <label class="label">E-mail</label>
            <div class="control">
                <input name="email" class="input" type="text" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field">
            <label class="label">Senha</label>
            <div class="control">
                <input name="senha" class="input" type="password" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field has-text-right">
            <div class="control">
                <button class="button is-link">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
@endsection