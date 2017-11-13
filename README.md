# Yii2 Lesson 8
>Исходные фалы урока № 8 "Основы yii2", для "Большого конкурса Loftblog".

Для запуска выполните:

- git clone https://github.com/zindzay/Yii2-Lesson-8.git app_catalog
- cd app_catalog
- composer install
- mysql -u root -p
- create database app_catalog default character set utf8 default collate utf8_unicode_ci;
- ./yii migrate --migrationPath=@yii/rbac/migrations
- ./yii migrate
- php -S localhost:8000 -t web/
