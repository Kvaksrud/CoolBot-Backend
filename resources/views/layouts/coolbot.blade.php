
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Patrick Kvaksrud and CoolBot contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>{{env('APP_NAME', 'CoolBot Backend')}}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script type="text/css">
        .mi {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </script>

</head>
<body>
    @auth()
        @include('layouts/navigation')
        <div class="container">
            @include('layouts/header')
            <main>
                @yield('main')
            </main>
        </div>
    @else
        no auth
    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
