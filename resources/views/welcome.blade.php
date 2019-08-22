<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <header class="bs-docs-footer" style="background: #F6F6F4; text-align:center">
            <div class="container">
                <address>
                    <strong>Jesús Enrique Jimenez Posada</strong><br>
                    <small><strong>Ingeniero de sistemas</strong></small><br>
                    <a href="mailto:jesus.950810@gmail.com">jesus.950810@gmail.com</a><br>
                    <b>3058143543</b>
                </address>
            </div>
        </header>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <h1>Prueba Merqueo</h1>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{url('api/documentation')}}"> <h3>Documentacion API (Swagger)</h3></a>
                        <img src="{{asset('images/merqueo.gif')}}" alt="" width="300" class="img-thumbnail">
                        <div class="row">
                            <small>Developer Senior</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
