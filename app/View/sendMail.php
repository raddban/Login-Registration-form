<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Send Email</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Web</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/email">Send email</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="/send/sendEmail">
                <h2>Email Us</h2>
                <div class="form-group">
                    <label for="email"></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your email...">
                </div>
                <div class="form-group">
                    <label for="name"></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Your name...">
                </div>
                <div class="form-group">
                    <label for="textarea"></label>
                    <textarea class="form-control" id="textarea" placeholder="Your message..." name="text"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send email</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>