<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    // Controller responsável por mostrar o histórico do usuário atual
    public function index(Request $request) {
        $user = $request->get("user");
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->get(config('services.nodejsapi') . '/history');
        $result = $response->json();
        if($result["status"] == "error") {
            return view("history", ["user_name"=>$user->nome,"error"=>$result["msg"]]);
        }
        $histories = json_decode($response,true)["history"];
        return view("history", ["user_name"=>$user->nome,"histories"=>$histories]);
    }


    // Controller responsável por mostrar histórico de um usuário específico
    public function user(Request $request,$id) {
        $user_jwt = $request->get("user_jwt");
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
        ])->get(config('services.nodejsapi') . '/history/' . $id);
        $result = json_decode($response->body(),true);
        if($result["status"] == "error") {
            echo $result["msg"];
            return;
        }
        $histories = $result["history"];
        echo '<table class="table"><thead><tr><th>Termo</th><th>Data</th></tr></thead><tbody>';
        foreach($histories as $history) {
            echo "<tr>";
            echo "<td>" . $history["query"] . "</td>";
            echo "<td>" . date("d/m/Y H:i", $history["time"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

}
