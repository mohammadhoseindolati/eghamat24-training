<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($infos as $info)

    @php

        echo "page :".$info['page']."</br>" ;
        echo "status :".$info['status']."</br>" ;
        echo "title :".$info['title']."</br>" ;
        echo "meta-description :".$info['meta-desc']."</br>" ;
        echo "images :".$info['images'][0]."</br>" ;
        echo "videos :".$info['videos'][0]."</br>" ;

    @endphp
    @endforeach
</body>
</html>
