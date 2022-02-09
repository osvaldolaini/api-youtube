<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;


class YouTubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Busca todos os vídeos do canal
     */
    public function index()
    {
        $videoLists = $this->_videoLists();
        /*Testar o que está recebendo*/
        // echo '<pre>';
        // print_r($videoLists);
        // exit;
        return view('site.youtube.index', [
            'title_postfix' => 'Nossos vídeos',
            'videoLists'    =>  $videoLists,
            'channelId'     => config('services.youtube.channel_id'),
            'tags'          =>  '$config->tags',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     * Busca o vídeo solicitado 
     * 
     */
    
    public function watch($id)
    {
        $videoDateLists = $this->_videoListsOrder('date');
        $videoViewsLists = $this->_videoListsOrder('viewCount');
        $singleVideo = $this->_singleVideo($id);
        return view('site.youtube.watch', [
            'title_postfix'     =>  $singleVideo->items[0]->snippet->title,
            'videoDateLists'    =>  $videoDateLists,
            'videoViewsLists'   =>  $videoViewsLists,
            'singleVideo'       =>  $singleVideo,
            'tags'              =>  '$config->tags',
        ]);
    }
    // We will get search result here
    protected function _videoLists($channelId)
    {
        $order = 'date';
        $part = 'snippet';
        $country = 'BD';
        $maxResults = 6; // Quantidade de vídeos na tela
        $type = 'video'; // Você pode selecionar qualquer um ou todos, estamos recebendo apenas vídeos
        $apiKey = config('services.youtube.api_key');
        $youTubeEndPoint = config('services.youtube.search_endpoint');
        $channelId = config('services.youtube.channel_id');
        
        $url = "$youTubeEndPoint?regionCode=$country&order=$order&channelId=$channelId&part=$part&maxResults=$maxResults&type=$type&key=$apiKey";
        $response = Http::get($url);
        $results = json_decode($response);
        // Criar um arquivo json para ver nossa resposta
        //File::put(storage_path() . '/app/public/results.json', $response->body());
        return $results;
    }
    // We will get search result here
    protected function _videoListsOrder($order)
    {
        $part = 'snippet';
        $country = 'BD';
        $maxResults = 4; // Quantidade de vídeos na tela
        $type = 'video'; // Você pode selecionar qualquer um ou todos, estamos recebendo apenas vídeos
        $apiKey = config('services.youtube.api_key');
        $youTubeEndPoint = config('services.youtube.search_endpoint');
        $channelId = config('services.youtube.channel_id');
        
        $url = "$youTubeEndPoint?regionCode=$country&order=$order&channelId=$channelId&part=$part&maxResults=$maxResults&type=$type&key=$apiKey";
        $response = Http::get($url);
        $results = json_decode($response);
        return $results;
    }

    protected function _singleVideo($id)
    {
        $apiKey = config('services.youtube.api_key');
        $part = 'snippet';
        $url = "https://www.googleapis.com/youtube/v3/videos?part=$part&id=$id&key=$apiKey";
        $response = Http::get($url);
        $results = json_decode($response);

        // Criará um arquivo json para ver os detalhes do nosso vídeo único
        File::put(storage_path() . '/app/public/single.json', $response->body());
        return $results;
    }
}
