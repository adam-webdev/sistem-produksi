### Cara Menjalankan program

1. Download dan Extract folder
2. Buka folder dan terminal lalu ketikan composer update 
3. selanjutnya ketikan copy `.env.example .env` masih di terminal yang sama
4. lalu buka .env koneksikan database buat database baru di phpmyadmin
5. lalu jalankan perintah `php artisan key:generate`
6. lalu `php artisan migrate`
7. selanjutanya `php artisan db:seed`
8. Terakhir jalankan program dengan perintah `php aritsan serve`
