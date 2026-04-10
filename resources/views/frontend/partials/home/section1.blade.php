<?php
/**
 * @link https://framework.iziweb.net
 * @copyright Copyright (c) 2021 Izi Software LLC
 * @license https://framework.iziweb.net/license
 * @author Giang A Tin <vantruong1898@gmail.com>
 * @since 2.0
 * @ide PhpStorm 2021
 * @workplace Home Office
 */
?>
<div class="gbb-row-wrapper">
    <div class="gbb-row bg-size-cover " style="">
        <div class="bb-inner default">
            <div class="bb-container container">
                <div class="row">
                    <div class="row-wrapper clearfix">
                        <div class="widget gsc-heading align-center style-2 text-dark wow fade-up">
                            <h2 class="title"><span><span class="text-theme home-title">xuất khẩu lao động nhật bản Uy tín<br/>thi tuyển liên tục.</span></span></h2>
                            <div class="title-icon"><span><i class="fa fa-heartbeat"></i></span></div>
                        </div>

                        <div class="gsc-column col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="clearfix"></div>
                                    <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="row">
                                            <div class="column-inner bg-size-cover ">
                                                <div class="column-content-inner">
                                                    <div>
                                                        <div class="widget block clearfix gsc-block-view gsc-block-drupal block-view title-align-left text-dark remove-margin-off">
                                                            <div class="views-element-container wow fade-up animated">
                                                                <div class="">
                                                                    <div class="no-padding owl-carousel init-carousel-owl owl-loaded owl-drag"
                                                                         data-items="1"
                                                                         data-items_lg="1"
                                                                         data-items_md="1"
                                                                         data-items_sm="1"
                                                                         data-items_xs="1"
                                                                         data-loop="0"
                                                                         data-speed="2000"
                                                                         data-auto_play="1"
                                                                         data-auto_play_speed="1000"
                                                                         data-auto_play_timeout="4000"
                                                                         data-auto_play_hover="1"
                                                                         data-navigation="0"
                                                                         data-rewind_nav="1"
                                                                         data-pagination="0"
                                                                         data-mouse_drag="0"
                                                                         data-touch_drag="0">
                                                                        @foreach ($album as $item)
                                                                        <div class="item">
                                                                            <div>
                                                                                <div class="gallery-block">
                                                                                    <div class="gallery-images lightGallery">
                                                                                        <div>
                                                                                            @php  ($data = $item->loadMedia(['original']) )
                                                                                            @php  ($i = 1 )
                                                                                            @foreach ($data->media as $row)
                                                                                            <div class="image-item">
                                                                                                <a href="/uploads/{{  $row->getDiskPath() }}" class="zoomGallery {{$i !== 1? 'hidden': '' }}" title="" data-rel="lightGallery">
                                                                                                    {!! $i == 1? '<span class="icon-expand"><i class="fa fa-expand"></i>': '' !!} <img class="lozad hidden" data-src="/uploads/{{  $row->getDiskPath() }}" alt="{{ $item->title }}"> </a>
                                                                                                @if ($i == 1)
                                                                                                <img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('noimage') }}" alt="{{ $item->title }}" typeof="foaf:Image">
                                                                                                @else

                                                                                                @endif
                                                                                            </div>
                                                                                            @php ($i++)
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gallery-content">
                                                                                        <h3 class="post-title"><a href="/album/{{ $item->slug }}" rel="bookmark"><span>{{ $item->name }}</span></a></h3> </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gsc-column col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                            <div class="column-inner bg-size-cover ">
                                <div class="column-content-inner">
                                    <div class="clearfix"></div>
                                    <div class="gsc-column col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="row">
                                            <div class="column-inner bg-size-cover ">
                                                <div class="column-content-inner">
                                                    @foreach (\sliders(\setting('video_featured')) as $item)
                                                    <div class="widget gsc-video-box wow fade-up clearfix style-1 wow fade-up animated" data-wow-delay="0.2s">
                                                        <div class="video-inner">
                                                            <div class="image text-center"> <img class="lozad" data-src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('thumbnail')  }}" alt="{{ $item->title }}">
                                                                <a class="popup-video gsc-video-link" href="{{ $item->link }}"><span class="icon"><i class="fa fa-play"></i></span></a> </div>
                                                        </div>
                                                        <div class="video-content">
                                                            <div class="video-content-background"></div>
                                                            <div class="left">
                                                                <div class="video-title">{{ $item->description }}</div>
                                                                <div class="video-desc">{{ $item->title }}</div>
                                                            </div>
                                                            <div class="right">
                                                                <a class="popup-video gsc-video-link" href="{{ $item->link }}"> <i class="fa fa-play"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
