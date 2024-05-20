### Laravel Entry Point
- Entry point atau jalur masuk utama dar laravel adalah index.php di folder public, contoh melakukan request ke /hello maka sebenarnya mengakses /index.php/hello.
- jika ingin menambahkan static file bisa di tambahkan di folder public, maka bisa diakses langsung di url browser

### Keyword
- :: (untuk mengakses method atau property static, berdasarkan classnya)
- -> (untuk mengakses method atau property dari sebuah object, berdasarkan objectnya)
- => (key dan value, contoh untuk array)

#### Melakukan compile file js dan css yang ada di folder resources
npm run prod (perintah lain ada di package.json)

#### Melakukan compile semua view atau blade template, akan disimpan di storage/framework/views
php artisan view:cache

#### Menghapus seluruh hasil compile
php artisan view:clear

#### Menjalankan file test tertentu
php artisan test --filter ExampleTest
