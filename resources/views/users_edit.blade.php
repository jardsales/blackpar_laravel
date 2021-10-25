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
    <form autocomplete="off" method="post" action="{{ url('/users/update') }}" id="user-create-form">
        @csrf
        <input type="hidden" name="_user_id" value="{{ $user_info->id }}" />
        <div class="field">
            <label class="label">Nome</label>
            <div class="control">
                <input name="nome" value="{{ $user_info->nome }}" class="input" type="text" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field">
            <label class="label">Sobrenome</label>
            <div class="control">
                <input name="sobrenome" value="{{ $user_info->sobrenome }}" class="input" type="text" placeholder="Insira o nome"required />
            </div>
        </div>
        <div class="field">
            <label class="label">Tipo</label>
            <div class="control">
                <div class="select">
                    <select name="tipo" required>
                        <option value="{{ $user_info->tipo }}">{{ ucfirst($user_info->tipo) }}</option>
                        @php if($user_info->tipo != "usuario") { echo '<option value="usuario">Usuário</option>'; } @endphp
                        @php if($user_info->tipo != "admin") { echo '<option value="admin">Admin</option>'; } @endphp
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label">Telefone</label>
            <div class="control">
                <input name="telefone" value="{{ $user_info->telefone }}" class="input" type="text" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field">
            <label class="label">E-mail</label>
            <div class="control">
                <input name="email" value="{{ $user_info->email }}" class="input" type="text" placeholder="Insira o nome" required />
            </div>
        </div>
        <div class="field has-text-right">
            <div class="control">
                <button type="submit" class="button is-link">Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection