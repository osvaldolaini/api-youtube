@extends('site.app')
@section('body')

    {{-- Sub page Header --}}
    @include('site.sections.subpage_header')
    @php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    @endphp

    <!-- ======= Modalities Section ======= -->
    <section class="custom-section page-youtube">
        <div class="container mt-4">
            <div class="row"> 
                @foreach($videoLists->items as $key => $item)
                    <div class="col-sm-12 col-lg-4"> 
                        <a href="{{url('youtube/'.$item->id->videoId)}}">
                            <div class="card mb-4">
                                <img src="{{ $item->snippet->thumbnails->medium->url }}" class="img-fluid" alt="{{$config->slug}}-{{\Illuminate\Support\Str::slug(\Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...'), "-")  }}">
                                <div class="card-body">
                                    <h5 class="card-titled">{{ \Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...') }}</h5>
                                </div>
                                <div class="card-footer h6">
                                    Publicado em {{utf8_encode(strftime('%d %b %Y' , strtotime($item->snippet->publishTime)))}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="button service_button"><a href="https://www.youtube.com/channel/{{$channelId}}/videos">Veja todos os nossos vídeos</a></div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->
    @include('site.sections.contact')

@stop
