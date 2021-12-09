<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="author" content="Aquarela Personalizados @aquarela.personalizado" />
        <meta name="description" content="Aquarela Personalizados - Etiquetas Escolares Personalizadas: Organização e identificação do material escolar de suas crianças! ✓ Entrega em todo o Brasil ✓ Dinheiro ✓ PIX ✓ Cartão ✓ Parcelamento" />
        <link rel="canonical" href="https://www.aquarelapersonalizados.com.br/etiquetas-personalizadas" />
        <meta property="og:locale" content="pt_BR" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Aquarela Personalizados - Etiquetas Escolares Personalizadas" />
        <meta property="og:description" content="Aquarela Personalizados - Etiquetas Escolares Personalizadas: Organização e identificação do material escolar de suas crianças! ✓ Entrega em todo o Brasil ✓ Dinheiro ✓ PIX ✓ Cartão ✓ Parcelamento" />
        <meta property="og:url" content="https://www.aquarelapersonalizados.com.br/etiquetas-personalizadas" />
        <meta property="og:site_name" content="Aquarela Personalizados" />

        <meta name="keywords" content="Personalização, Etiquetas escolares, etiquetas, escolares, papelaria personalizada" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="/favicon.ico">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-M2Y1YVXWCP"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-M2Y1YVXWCP');
        </script>
    </head>
    <body class=" antialiased text-white leading-normal tracking-normal bg-gradient-to-r from-aqua-pink to-aqua-blue">
        @inertia
    </body>
</html>
