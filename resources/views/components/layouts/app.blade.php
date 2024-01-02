<?php 
use Illuminate\Support\Facades\Route;

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('assets/logo/logona.png') }}" type="image/x-icon"/>

        <title>{{ $title ?? 'New Armada' }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css" integrity="sha512-pZlKGs7nEqF4zoG0egeK167l6yovsuL8ap30d07kA5AJUq+WysFlQ02DLXAmN3n0+H3JVz5ni8SJZnrOaYXWBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Flowbite Tailwind Plugins -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
        @vite('resources/css/app.css')
        @livewireStyles

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Own Carousel -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body>
        {{ $slot }}

        @livewireScripts
        <!-- Flowbite Tailwind Plugins -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <!-- Jquery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <!-- Owl Carousel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
        $(document).ready(function(){
            $('#carousel').owlCarousel({
                loop:true,
                autoplay:true,
                autoplayTimeout: 10000,
                nav: false,
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
        })
    </script>
    </body>
</html>
