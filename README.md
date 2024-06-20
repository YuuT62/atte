##Atte（アット）

ある企業の勤怠管理システム

![atteトップ画面](https://github.com/YuuT62/atte/assets/57668081/fa70fe7a-0bea-4379-953e-3153f8ad3534)

##作成した目的

人事評価のため（実践学習ターム）

#アプリケーションのURL

開発・検証環境：http://ec2-35-78-115-12.ap-northeast-1.compute.amazonaws.com

本番環境：http://ec2-18-183-158-31.ap-northeast-1.compute.amazonaws.com

※メール認証機能はAWSの「Amazon Simple Email Service」を使用しており、本稼働アクセスのリクエスト未実施（サンドボックス状態）のため、認証されたメールアドレス以外は登録できない状態です。

##機能一覧

・ログイン機能

・ログアウト機能

・新規ユーザー作成

・打刻ページ表示機能

・勤務開始、終了機能

・休憩開始、終了機能

・日付別勤怠ページ表示機能

・ユーザの一覧ページ表示機能

・ユーザ毎の勤怠一覧ページ表示機能

##使用技術

・ PHP 7.4.9

・ Laravel 8.83.8

・ MySQL 8.0.26

##テーブル設計

![atte-table](https://github.com/YuuT62/atte/assets/57668081/e2bd9885-f8b8-4caf-8ff1-a2c0afe3477e)

##ER図

![atte](https://github.com/YuuT62/atte/assets/57668081/da2c3b88-5ef6-402a-b558-fa238789db1b)

##環境構築

git clone git@github.com:YuuT62/atte.git

cd atte/

docker-compose up -d --build

*MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

##Laravel環境構築

docker-compose exec php bash

composer install

.env.exampleファイルから.envファイルを作成し、環境変数を変更

　12行目)　DB_HOST=mysql

　14行目)　DB_DATABASE=laravel_db

　15行目)　DB_USERNAME=laravel_user

　16行目)　DB_PASSWORD=laravel_pass

　32行目)　MAIL_HOST=mailcatcher

  　37行目)　MAIL_FROM_ADDRESS=hoge@example.com

php artisan key:generate

php artisan migrate

php artisan db:seed

##mysql

　アクセスURL：http://localhost:8080/

##MailCatcher

　アクセスURL：http://localhost:1080/

　※テスト用のメール受取ボックス（新規ユーザー作成時の認証メールが上記URL先のメールボックスで受け取られます）

※Windowsの場合、ファイル権限エラーでアクセスできないことがあるため、以下のコマンドで回避

sudo chmod -R 777 src/*


