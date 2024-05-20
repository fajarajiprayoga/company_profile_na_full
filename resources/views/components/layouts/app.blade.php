<?php 
use Illuminate\Support\Facades\Route;

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (!empty($metadescription) && !empty($metakeyword))
            <meta name="description" content="{{$metadescription}}">
            <meta name="keywords" content="{{$metakeyword}}">
        @else
            <meta name="description" content="PT Mekar Armada Jaya or New Armada is an international manufacturer of high-quality bodywork, vehicle components, and equipment. Creating safe, comfortable, and high-quality vehicles to achieve customer satisfaction. Producing high-quality global components, parts, and tools.">
            <meta name="keywords" content="New Armada, PT Mekar Armada Jaya, New Armada Karoseri">
        @endif

        <meta name="robots" content="index">
        <meta name="author" content="Fajar Aji Prayoga">
        <meta name="google-site-verification" content="SqqhEoMn1V-HGrHKWQ-T3aSX4iEgco2bEDbkAv-iByA" />

        <link rel="icon" href="{{asset('favicon/apple-touch-icon.png')}}" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">

        <title>{{ $title ?? 'New Armada' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css" integrity="sha512-pZlKGs7nEqF4zoG0egeK167l6yovsuL8ap30d07kA5AJUq+WysFlQ02DLXAmN3n0+H3JVz5ni8SJZnrOaYXWBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Viewer JS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css" integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Flowbite Tailwind Plugins -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
        @vite('resources/css/app.css')
        @livewireStyles
        @filamentStyles

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Own Carousel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Leaflet JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>

        {{-- Glide JS --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.theme.min.css">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body>
        {{ $slot }}
        
        @livewireScripts
        @filamentScripts
        @vite('resources/js/app.js')
        <!-- Flowbite Tailwind Plugins -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <!-- Jquery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <!-- Owl Carousel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Viewer JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
        {{-- Glide JS --}}
        <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>

        <script>
        $(document).ready(function(){

            $('#carousel').owlCarousel({
                loop:true,
                autoplay:false,
                autoplayTimeout: 10600,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            });
            $('#product-carousel').owlCarousel({
                loop:true,
                autoplay:true,
                autoplayTimeout: 10000,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            });
            $('#gallery-carousel-wrapper').owlCarousel({
                center: true,
                margin: 0,
                stagePadding: 20,
                loop:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:4
                    }
                }
            });
            $('.gallery-product-wrapper').owlCarousel({
                margin: 50,
                stagePadding: 20,
                loop:true,
                mouseDrag:true,
                autoplay:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:4
                    }
                }
            });            
        })
    </script>

    <script>
        var gallery_home = document.getElementById('gallery-carousel-wrapper');
        if (gallery_home) {
            const gallery = new Viewer(document.getElementById('gallery-carousel-wrapper'));
        }

        var gallery_detail = document.getElementById('gallery-product-wrapper-id');
        if (gallery_detail){
            const gallery_detail = new Viewer(document.getElementById('gallery-product-wrapper-id'));
        }
    </script>

    @stack('scripts')

    </body>
</html>
