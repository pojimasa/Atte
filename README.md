# Atte（勤怠管理アプリ）
ある会社の勤怠管理を記録するアプリです。
<img width="1470" alt="スクリーンショット 2024-06-19 0 54 00" src="https://github.com/pojimasa/Atte/assets/162285883/58c3552e-7290-42f0-a07b-b8a71f7b3629">

## 作成した目的
社員の勤怠情報を入力してもらうことで、それぞれの社員がいつどれだけの時間、勤務・休憩をしたのかを管理しやすくするため。
お給料の管理なども、勤怠情報を見るだけで、誰にどれだけの支給をすれば良いのかが分かりやすい。
アプリが全て勤怠情報を管理してくれるため、負担を減らすことができる。（紙での勤怠管理と比較）

## アプリケーションURL
phpMyAdmin: http://localhost:8080/
開発環境： http://localhost/
まず初めに: http://localhost/register
から、会員登録画面に推移していただきたいです。

## 機能一覧
会員登録、ログインページではlaravelの認証機能を利用
ログアウトはヘッダーにあるログアウトボタンから、『　本当にログアウトしますか？　　はい・いいえ　　』　の画面に推移
『はい』を押すと、ログインページに切り替わる
『いいえ』を押すと、ログアウトボタンを押す際のページに戻る
勤務開始・勤務終了は日を跨いだ時点で翌日の出勤操作に切り替わる
勤務開始は、１日１回しかできない
休憩開始・休憩終了は、１日で何度も休憩が可能
日付別勤怠情報取得
attendanceページでは、５件のページネーションを取得
ユーザー一覧ページでは、削除ボタンを押すと選択したユーザーの会員登録情報までが削除される
ユーザー勤怠情報管理ページでは、ログインしたユーザーの、今までの勤怠情報を月ごとに閲覧できる

## 使用技術(実行環境)
PHP 8.3.4
Laravel Framework 8.83.27
mysql 8.0.26

## テーブル設計
<img width="1470" alt="スクリーンショット 2024-06-19 1 30 02" src="https://github.com/pojimasa/Atte/assets/162285883/d1bdf1e3-e798-40e3-9d78-53ef53e6f5b6">

## ER図

# 環境構築
　　　　Dockerビルド
1.git clone git@github.com:coachtech-material/laravel-docker-template.git
2.DockerDesktopの立ち上げ
3.docker-compose up -d --build

　　　　Laravel環境構築
1.docker-compose exec php bash(PHPコンテナ内にログイン)
2.composer install (composer.jsonに記載されたパッケージのリストをインストール)
3.cp .env.example .env(環境変数を変更)
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=laravel_db
  DB_USERNAME=laravel_user
  DB_PASSWORD=laravel_pass

4.アプリケーションキーの作成
php artisan key:generate
5.マイグレーションの実行
php artisan migrate
6.シーディングの実行
php artisan db:seed
