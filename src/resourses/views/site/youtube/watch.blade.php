
@extends('site.app')
@section('body')

    {{-- Sub page Header --}}
    @include('site.sections.subpage_header')
    @php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    @endphp
    <!--================Blog Area =================-->
    <section class="blog_area section_padding custom-section mt-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="card mb-4" style="width: 100%">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="https://www.youtube.com/embed/{{ $singleVideo->items[0]->id }}" width="560" height="600" frameborder="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5>{{ $singleVideo->items[0]->snippet->title }}</h5>
                            <p class="text-secondary h6">Publicado em {{utf8_encode(strftime('%d %b %Y' , strtotime($singleVideo->items[0]->snippet->publishedAt)))}} 
                               </p>
                            <p>{{ $singleVideo->items[0]->snippet->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title"><i class="fas fa-star"></i> Mais vistos </h3>
                            <div class="row"> 
                                @foreach ($videoViewsLists->items as $key => $item)
                                <div class="media post_item"> 
                                    <img src="{{ $item->snippet->thumbnails->medium->url }}" 
                                                    alt="{{ $config->slug }}-{{ \Illuminate\Support\Str::slug(\Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...'),'-') }}">
                                    <div class="media-body">
                                        <a href="{{ url('youtube/' . $item->id->videoId) }}">
                                            <h3>{{ \Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...') }}</h3>
                                        </a>
                                        <p>{{ utf8_encode(strftime('%d %b %Y', strtotime($item->snippet->publishTime))) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div> 
                        </aside>
                        <aside class="single_sidebar_widget" style="background-color: transparent !important;">
                            @include('site.partials.adsNews')
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title"><i class="fas fa-thumbs-up"></i> Você pode gostar </h3>
                            <div class="container">
                                <div class="row"> 
                                    @foreach ($videoDateLists->items as $key => $item)
                                    <div class="media post_item"> 
                                        <img src="{{ $item->snippet->thumbnails->medium->url }}" 
                                                        alt="{{ $config->slug }}-{{ \Illuminate\Support\Str::slug(\Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...'),'-') }}">
                                        <div class="media-body">
                                            <a href="{{ url('youtube/' . $item->id->videoId) }}">
                                                <h3>{{ \Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...') }}</h3>
                                            </a>
                                            <p>{{ utf8_encode(strftime('%d %b %Y', strtotime($item->snippet->publishTime))) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div> 
                            </div>
                        </aside>
                        <aside class="single_sidebar_widget" style="background-color: transparent !important;">
                            @include('site.partials.adsNews')
                        </aside>
                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <div id="custom-newsletter">
                                <div class="newsletter" id="newsletter">
                                    <div class="newsletter_form_container">
                                        <form method="post" class="form-outline-style" id="newsletterForm" >
                                            <div class="d-flex flex-row align-items-start justify-content-start">
                                                <input type="email" class="newsletter_input" name="email"
                                                    placeholder="Insira seu email" required="required">
                                                <button class="newsletter_button">
                                                    <i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <div id="newsletter-message-warning" class="mt-4"></div>
                                        <div id="newsletter-message-success">
                                            <p>Assinatura concluída, obrigado!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
    @include('site.sections.contact')


@stop