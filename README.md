# api-youtube
Usar api do google youtube

Esse pacote tem como objetivo utilizar a api do google "YouTube Data API v3" 

# V-1.0.0
```
Versão simplificada 
    - Controller
    - Inclusão da array 'youtube' no arquivo 'config/services.php'
    - Views (index e watch)
```

## Clone this repo
```
git clone https://github.com/osvaldolaini/api-youtube.git
```

## Put api key in config/services.php file
```
    'youtube' => [
        'api_key' => env('API_KEY'),
        'search_endpoint' => env('SEARCH_ENDPOINT'),
        'channel_id' => env('CHANNEL_ID')
    ]
```

## Put api key in .env file
```
API_KEY=""
SEARCH_ENDPOINT="https://www.googleapis.com/youtube/v3/search"
CHANNEL_ID=""
```

## Guide API
https://developers.google.com/youtube/v3/guides/implementation