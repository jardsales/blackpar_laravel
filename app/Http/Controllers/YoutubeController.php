<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{

    // Controller responsável por conenctar com a API do YouTube em NodeJS
    public function search(Request $request) {
        $user_jwt = $request->get("user_jwt");    
        $q = $request->input('q');
        $n = $request->input('n');
        $response = Http::withHeaders([
            'X-Access-Token' => $user_jwt,
            ])->get(config('services.nodejsapi') . '/youtube?q=' . urlencode($q) . '&n=' . urlencode($n));
            $videos = $response->json()["items"];
            echo "<div class='yt-videos-box'>";
            foreach($videos as $video) {
                switch ($video["id"]["kind"]) {
                    case 'youtube#video':
                    echo "<div onclick='showVideo(\"" . $video["id"]["videoId"] . "\")' class='yt-video-item'>
                    <div><img src='" . $video["snippet"]["thumbnails"]["medium"]["url"] . "' /></div>
                    <div>" . $video["snippet"]["title"] . "</div>
                    <div class='channelTitle'>" . $video["snippet"]["channelTitle"] . "</div>
                    </div>";
                    break;
                    case 'youtube#channel':
                    echo "<div class='yt-video-item'><a href='https://youtube.com/channel/" . $video["id"]["channelId"] . "' target='_blank'>
                    <div><img class='circle' src='" . $video["snippet"]["thumbnails"]["medium"]["url"] . "' /></div>
                    <div><em>" . $video["snippet"]["title"] . "</em></div></a>
                    </div>";    
                    break;
                }
            }
            echo "</div>";
        }
    }