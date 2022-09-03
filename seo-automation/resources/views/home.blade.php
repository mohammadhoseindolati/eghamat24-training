<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seo Automation</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto main text-center my-5">
                    <form action="/analyze" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="mt-5 mb-3">Site Address</label>
                            <input type="text" name="url" class="form-control" id="exampleFormControlInput1" class="my-1" placeholder="https://example.com/">
                        </div>
                        <div class="btn-box my-5">
                            <button class="btn btn-primary">Analyze</button>
                        </div>
                    </form>
                    @if( count($errors->all()) > 0 )
                        <ul class="bg-danger p-2 mt-2">
                            @foreach($errors->all() as $error)
                                <li class="p-2">{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
