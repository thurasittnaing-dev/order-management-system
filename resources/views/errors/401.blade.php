<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 16px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 45px;
            opacity: 0.7;
        }

        body {
            display: flex;
            width: 100vw;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        a {
            text-align: cornflowerblue;
        }

        .center {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div>
        @php
            $route = '';
            switch (auth()->user()->role) {
                case 'admin':
                    $route = route('main-dashboard');
                    break;

                case 'waiter':
                    $route = route('rooms');
                    break;

                case 'office':
                    $route = route('main-dashboard');
                    break;

                case 'kitchen':
                    $route = route('orders');
                    break;

                default:
                    $route = route('main-dashboard');
                    break;
            }
        @endphp
        <h1>401 Unauthorized</h1>
        <div class="center">
            <a href="{{ $route }}" class="">go back</a>
        </div>
    </div>
</body>

</html>
