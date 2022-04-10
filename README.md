# babytalk

## 概要

育児中の過ごし方やご飯の量など、情報共有できるコミュニティサイト

## 使い方

アカウント作成し、新規投稿や各ユーザーの投稿が閲覧できます。<br>
気になった投稿にはコメントもできます。

## 開発環境

laravel 8.0<br>
MySQL<br>
AWS(S3)<br>

## clone後に実行すること

cloneしたら下記を実行(composer,Node.jsは事前にインストールされている事が前提)<br>

○ライブラリのインストール<br>
→下記のコマンドを実行<br>
　　$composer install <br>

○.env.exampleを複製<br>
複製した.env.exampleファイルを.envに名前変更<br>
→下記のコマンドを実行<br>
　　　$php artisan key:generate<br>

○.envファイルの情報変更<br>
→下記の環境変数を設定<br>

APP_NAME=babytalk<br>
APP_ENV=develop<br>
APP_KEY=xxxxx<br>

DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=xxxx<br>
DB_USERNAME=xxxx<br>
DB_PASSWORD=xxxx<br>

↓Gmailで各自設定<br>
MAIL_MAILER=smtp<br>
MAIL_HOST=smtp.gmail.com<br>
MAIL_PORT=587<br>
MAIL_USERNAME=xxxx<br>
MAIL_PASSWORD=xxxx<br>
MAIL_ENCRYPTION=tls<br>
MAIL_FROM_ADDRESS=xxxx<br>
MAIL_FROM_NAME=babytalk<br>

↓AWSの登録が必要　使用量に応じて課金される（S3）<br>
AWS_ACCESS_KEY_ID=xxxx<br>
AWS_SECRET_ACCESS_KEY=xxxx<br>
AWS_DEFAULT_REGION=xxxx<br>
AWS_BUCKET=xxxx<br>
AWS_USE_PATH_STYLE_ENDPOINT=false<br>

○migrationファイルからテーブル作成<br>
→下記のコマンドを実行<br>
 $php artisan maigrate　<br>

○seederで初期値を登録（prefectureテーブル・babyage_scopeテーブル）<br>
→下記のコマンドを実行<br>
$php artisan db:seed<br>

○サーバーの起動<br>
→下記のコマンドを実行(MAMPを使用してもよい)<br>
$php artisan serve<br>
