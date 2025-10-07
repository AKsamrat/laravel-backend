 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>{{ $title . ' | Shayan Mart' ?? 'Shayan Mart' }}</title>

     <link rel="shortcut icon" href="logo/shayan_2.png" type="image/x-icon">
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
     <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
     <!-- Styles / Scripts -->
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
         @vite(['resources/css/app.css', 'resources/js/app.js'])
     @else
         <link rel="stylesheet" href="tailwind.css">
     @endif
 </head>

 <body class="bg-[#FDFDFC]  text-[#1b1b18] ">



     {{ $slot }}

     <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
 </body>

 </html>
