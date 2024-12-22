# Sistem Penunjang Keputusan

Aplikasi untuk merekomendasikan pilihan sepeda motor bekas terbaik, dengan menggunakan metode vikor sistem penunjang keputusan.

## Langkah penggunaan

Clone project

```bash
  git clone git@github.com:adee012/pemilihan-sepeda-motor.git
```

Install depedensi

```bash
  composer install
  npm install
```

Set up .env file

```bash
  cp .env.example .env
```

Generate Application Key

```bash
  php artisan key:generate
```

Konfigurasi Database

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_user
  DB_PASSWORD=your_database_password
```

Jalankan migrasi database

```bash
  php artisan migrate
```

Jalankan aplikasi

```bash
  php artisan serve
  npm run dev
```

## Authors

-   [github@adee012](https://www.github.com/adee012)
-   [instagram@adedwiputra02](https://www.instagram.com/adedwiputra02/)
