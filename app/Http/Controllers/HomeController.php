<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    
    // Controller responsável por mostrar tela inicial com API do YouTube
    public function index(Request $request) {
        $user = $request->get("user");
        return view("home", ["user_name"=>$user->nome]);
    }
    
    // Controller resposável por chamar view com formulário de login
    public function login() {
        return view("login");
    }
    
    // Controller responsável por fazer o login
    public function login_post(Request $request) {
        $email = $request->input('email');
        $senha = $request->input('senha');
        $response = Http::post(config('services.nodejsapi') . '/users/login', [
            'email' => $email,
            'senha' => $senha,
        ])->body();
        $result = json_decode($response);
        if($result->status === "error") {
            echo json_encode(["status"=>"error","msg"=>$result->msg]);
            return;
        }
        session(["user_jwt"=>$result->token,"user_info"=>json_encode($result->user)]);
        echo json_encode(["status"=>"success"]);
    }
    
    
}
