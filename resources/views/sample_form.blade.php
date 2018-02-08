<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hello Vue</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="/js/vue.js"></script>
    <script src="/js/http-vue-loader.js"></script>
    <script src="/js/components/load_example.js" defer></script>
</head>
<body>
{{ $id }}<br>
{{ $random }}<br>
@if ($errors->any() || $direct_errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($direct_errors->all() as $direct_error)
                <li>{{ $direct_error }}</li>
            @endforeach
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="app">
    <example></example>
</div>
<form method="POST" action="{{route('sampleExecute')}}">
    name: <input type="text" name="name" value="{{ (old('name')) ? old('name') : '' }}" maxlength="255"><br>
    password: <input type="password" name="password" value="" maxlength="255"><br>
    {{ csrf_field() }}
    <input type="submit" value="送信">
</form>
</body>
</html>