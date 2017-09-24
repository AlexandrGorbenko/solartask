<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="css/app.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div id="app" class="container">
            <section class="section">
                <h1 class="title">Test task</h1>
            </section>
            <div class="field">
                <div class="control">
                    <textarea class="textarea" placeholder="Comment"></textarea>
                </div>
            </div>
            <a class="button is-primary">Send</a>


            <ul>
                <li v-for="comment in comments">@{{ comment.text }}</li>
            </ul>



        </div>




        <script src="js/app.js"></script>

    </body>
</html>
