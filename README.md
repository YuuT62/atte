##Atte（アット）

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

##使用技術

・ PHP 7.4.9

・ Laravel 8.83.8

・ MySQL 8.0.26

##ER図

![atte](https://github.com/YuuT62/atte/assets/57668081/da2c3b88-5ef6-402a-b558-fa238789db1b)


##URL

開発環境：http://localhost/

打刻ページ：/

日付別勤怠ページ：/attendance

ユーザの一覧ページ：/user_list

ユーザ毎の一覧ページ：/user

ユーザ登録ページ：register

ログインページ：login

※Windowsの場合、ファイル権限エラーでアクセスできないことがあるため、以下のコマンドで回避

sudo chmod -R 777 src/*

#AWSのURL

開発・検証環境：http://ec2-35-78-115-12.ap-northeast-1.compute.amazonaws.com

　テストユーザーのアカウント情報
 
 　・メールアドレス：test@example.com
  
   ・パスワード：P@ssw0rd

本番環境：http://ec2-18-183-158-31.ap-northeast-1.compute.amazonaws.com

※AWS上のメール認証機能は「Amazon Simple Email Service」を使用しており、本稼働アクセスのリクエスト未実施（サンドボックス状態）のため、認証されたメールアドレス以外は登録できない状態です。


