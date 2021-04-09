<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatroom</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app">
        @if (request()->has('name'))
            <chat-room></chat-room>
        @else
            <input-name></input-name>
        @endif
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
