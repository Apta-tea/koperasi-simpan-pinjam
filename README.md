## About The APP

Sistem informasi koperasi simpan pinjam berbasis web versi ke 2 dengan framework laravel 9, diintegrasikan dengan template stisla credit buat [nauvalazhar](https://github.com/nauvalazhar), dengan frontend bootstrap serta livewire.js. Untuk preview aplikasi ver-1 di: https://youtu.be/Un3VIiD2pN4

## How to Install

-   clone the repo, exp: git clone https://github.com/Apta-tea/koperasi-simpan-pinjam.git
-   import the db from miniksp.sql to ur database, php artisan migrate not make all the view (bcz im too lazy to redesign
    all of them). Hint: but u can use email & pass from the user seeder table file, 2 access the program. :P
-   rename or copy .env.example to .env , edit the file 2 add database name exp: DB_DATABASE=miniksp
-   specify your app url exp: APP_URL=http://localhost/koperasi-simpan-pinjam/public
-   composer update
-   php artisan key:generate
-   thats all folks
-   buy me a cup of coffee? [&#9749;](https://teer.id/apta-tea)
-   any bug, just info me on repo issues

## License

[Creative Commons Attribution 4.0 cc-by-4.0](https://creativecommons.org/licenses/by/4.0/)
