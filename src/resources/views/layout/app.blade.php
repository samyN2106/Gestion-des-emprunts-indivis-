<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <style>
        .header__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
}

.card:hover a {
  text-decoration: underline;
}

.container {
  width: min(1440px, 80%);
}

@media screen and (min-width: 768px) {
  .header__grid {
    grid-template-columns: 1fr 2fr 1fr;
  }
}

@media screen and (min-width: 1024px) {
  .aside__img {
    left: 50%;
    transform: translatex(-50%);
  }
}
    </style>

{{-- <div > --}}
   
    @yield('content')
{{-- </div> --}}


    


</body>
</html>