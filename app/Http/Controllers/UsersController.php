<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    // Controller responsável por mostrar todos os usuários
    public function index(Request $request) {
        $user = $request->get("user");
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->get(config('services.nodejsapi') . '/users');
        $users = json_decode($response,true);
        return view("users", ["user_name"=>$user->nome,"users"=>$users]);
    }

    // Controller responsável por mostrar formulário para criar novo usuário
    public function create(Request $request) {
        $user = $request->get("user");
        return view("users_create", ["user_name"=>$user->nome]);
    }

    // Controller responsável por criar novo usuário
    public function store(Request $request) {
        $validated = $request->validate([
            'nome' => 'required',
            'sobrenome' => 'required',
            'tipo' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $nome = $request->input('nome');
        $sobrenome = $request->input('sobrenome');
        $tipo = $request->input('tipo');
        $telefone = $request->input('telefone');
        $email = $request->input('email');
        $senha = $request->input('senha');

        $user = $request->get("user");
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->post(config('services.nodejsapi') . '/users',[
            "nome"=>$nome,
            "sobrenome"=>$sobrenome,
            "tipo"=>$tipo,
            "telefone"=>$telefone,
            "email"=>$email,
            "senha"=>$senha
        ]);
        $result = $response->json();
        if($result["status"] == "ok") {
            return redirect("/users/create")->with("message",json_encode(["status"=>"success","msg"=>"Usuário cadastrado com sucesso"]));
        }
        return redirect("/users/create")->with("message",json_encode(["status"=>"danger","msg"=>"Ocorreu um erro"]));
    }

    // Controller responsável por mostrar formulário para editar usuário
    public function edit(Request $request, $id) {
        $user = $request->get("user");
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->get(config('services.nodejsapi') . '/users/' . $id);
        $result = $response->body();
        $user_info = json_decode($result);
        return view("users_edit", ["user_name"=>$user->nome,"user_info"=>$user_info]);
    }

    // Controller responsável por editar usuário
    public function update(Request $request) {
        $validated = $request->validate([
            'nome' => 'required',
            'sobrenome' => 'required',
            'tipo' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            '_user_id' => 'required'
        ]);

        $nome = $request->input('nome');
        $sobrenome = $request->input('sobrenome');
        $tipo = $request->input('tipo');
        $telefone = $request->input('telefone');
        $email = $request->input('email');
        $_user_id = $request->input('_user_id');

        $user = $request->get("user");
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->put(config('services.nodejsapi') . '/users/' . $_user_id,[
            "nome"=>$nome,
            "sobrenome"=>$sobrenome,
            "tipo"=>$tipo,
            "telefone"=>$telefone,
            "email"=>$email,
        ]);
        $result = $response->json();
        if($result["status"] == "ok") {
            return redirect("/users/edit/" . $_user_id)->with("message",json_encode(["status"=>"success","msg"=>"Usuário editado com sucesso"]));
        }
        return redirect("/users/edit/" . $_user_id)->with("message",json_encode(["status"=>"danger","msg"=>"Ocorreu um erro"]));
    }

    // Controller responsável por deletar usuário
    public function delete(Request $request) {
        $id = $request->input('id');
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->delete(config('services.nodejsapi') . '/users/' . $id);
        return redirect("/users");
    }

    // Controller responsável por fazer logout
    public function logout() {
        session()->flush();
        return redirect("/");
    }

}
