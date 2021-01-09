docker kill php_server
rem docker run -tid -p 8000:80 --rm --name php_server -v "d:\dev\projects\whiskeytrader-server\src":/var/www/html php:7-apache
docker run -tid -p 8000:80 --rm --name php_server -v "d:\dev\projects\whiskeytrader-server\src":/var/www/html wt-php
