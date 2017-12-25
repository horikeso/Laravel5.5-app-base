Laravel初期設定（このdoc以外がLaravelを設置して微調整したものです）
APP_KEYは必ず設定しなおしてください。（設定参考）
doc以外を捨ててしまった場合に1から作りだす手順（サーバー側の設定は行う必要があります）
(実装した基本機能は触れません)

## Laravel設置

```
composer create-project --prefer-dist laravel/laravel:5.5.0 .
```

## 設定

APP_KEYはアプリ毎に再設定すること。
```
php artisan key:generate
```

```
rm .env
mv .env.example .env.local
```

configフォルダ内のファイルに記載されているenv関数の第２引数は「デフォルト値」です。この値は指定したキーの環境変数が存在しない場合に返されます。(サーバーを通さないphpunit等ではAPP_ENVが未定義のため.envを読み込みに行くが、これを配置しないならconfigのenvのみの設定が使用されるのでその場合のために設定しておくこと。)

## Nginx用の設定

nginx.conf
```
        # 413 Request Entity Too Large
        client_max_body_size 20M;

        root   /home/public/app/public;
        index  index.php index.html index.htm;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            root           /home/public/app/public;
~~~~~~~~
            fastcgi_param APP_ENV local; # この設定により読み込む.envが変わる
~~~~~~~~
        }
```

```
nginx -s reload
```

## テスト

```
vendor/bin/phpunit
```