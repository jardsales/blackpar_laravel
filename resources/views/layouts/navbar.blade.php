<div class="navbar1">
    <div class="nav-title">
        <a class="is-size-5 has-text-weight-bold">
            Olá {{ $user_name }}
        </a>
    </div>
    <div class="menu">
        <a href="{{ url('/') }}">YouTube</a>
        <a href="{{ url('/myhistory') }}">Histórico</a>
        @php
        $user = json_decode(session("user_info"));
        if($user->tipo == "admin") {
        @endphp
        <a href="{{ url('/users') }}">Usuários</a>
        @php
        }
        @endphp
    </div>
    <div class="end">
        <a class="button is-info" href="{{ url('/users/logout') }}">
            <strong>Logout</strong>
        </a>
    </div>
</div>