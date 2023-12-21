<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>{{ $maildata['title'] }}</h1>
    <p>{{ $maildata['name'] }} is registered to our website</p>
    <pre>Details:
        name:{{ $maildata['name'] }},
        email:{{ $maildata['email'] }},
        number:{{ $maildata['number'] }}
    </pre>
</body>

</html>
