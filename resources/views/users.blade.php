@extends('layouts.main')

@section('title', 'YouTube API')

@section('content')
@include('layouts/navbar')

<div id="modal1" class="modal">
    <div class="modal-content" id="modal1_content">
    </div>
</div>



<div class="body" id="body">
    <div class="has-text-right">
        <a class="button is-link" href="{{ url('/users/create') }}">Adicionar usuario</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user["nome"] }} {{ $user["sobrenome"] }}</td>
                <td>{{ $user["tipo"] }}</td>
                <td>{{ $user["telefone"] }}</td>
                <td>{{ $user["email"] }}</td>
                <td><a class="button is-info is-small" href="{{ url('/users/edit/' . $user['id']) }}">Editar</a></td>
                <td><a class="button is-link is-small" onclick="showHistory({{ $user['id'] }})">Histórico</a></td>
                <td><a class="button is-danger is-small" onclick="deleteUser({{ $user['id'] }})">Excluir</a></td>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<script>
    async function showHistory(id) {
        modal = document.querySelector("#modal1");
        modal_content = document.querySelector("#modal1_content");
        result = await fetch('@php echo url('/') @endphp/history/' + id, {
            method: 'GET'
        }).then(function(response) {
            return response.text();
        });
        modal_content.innerHTML = result;
        modal_content.classList.add("animate-fade-in");
        modal.style.display = "block";

        window.onclick = function(event) {
            if (event.target == modal) {
                modal_content.innerHTML = '';
                modal.style.display = "none";
            }
        }
    }
    async function deleteUser(id) {
        modal = document.querySelector("#modal1");
        modal_content = document.querySelector("#modal1_content");
        modal_content.innerHTML = '<form method="post" action="{{ url('/users/delete') }}">@csrf <input type="hidden" name="id" value="' + id + '" /><div>Tem certeza que deseja deletar esse usuário?</div><div><button class="button is-danger" id="btn_login" type="submit">Deletar</button> <button class="button" id="btn_login" onclick="modal_content.innerHTML = \'\';modal.style.display = \'none\';">Cancelar</button></div></form>';
        modal_content.classList.add("animate-fade-in");
        modal.style.display = "block";

        window.onclick = function(event) {
            if (event.target == modal) {
                modal_content.innerHTML = '';
                modal.style.display = "none";
            }
        }
    }
</script>

@endsection