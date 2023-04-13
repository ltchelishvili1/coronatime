


<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<style>
    @import url('https://fonts.cdnfonts.com/css/sansation');

    body {
        font-family: inter;
    }
</style>

<body class="grid justify-center">
    <div class="grid justify-center">
     <span class="mt-10 mb-36"> <x-assets.coronatime-logo /></span>  
      <h1 class="font-black text-2xl mb-14">{{$title}}</h1>
    </div>
    <div>
        {{$slot}}
    </div>
</body>

</html>