Так як проект створювався без Docker ось конфігурація бази даних 


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=testapidb
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120


запустити сервер
php artisan serve

запустити dev
npm run dev

запустити чергу
php artisan queue:work




