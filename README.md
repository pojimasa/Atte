# Atte（勤怠管理アプリ）
## 作成した目的
## アプリケーションURL
## 機能一覧
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

## テーブル設計

## 使用技術(実行環境)
PHP 8.3.4
Laravel Framework 8.83.27
mysql 8.0.26
## ER図
/Users/kawanosora/coachtech/laravel/test-laravel/index.drawio.png

URL
phpMyAdmin: http://localhost:8080/
開発環境： http://localhost/
