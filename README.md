# README #
Langkah-langkah berikut diasumsikan bahwa Anda **telah melakukan konfigurasi git awal** pada perangkat Anda.  Jika Anda sama sekali belum pernah menggunakan git sebagai version control [pelajari ini](https://help.github.com/articles/set-up-git).

1. Untuk melakukan clone ke perangkat Anda, lakukan dengan perintah:

```
#!git

git clone https://user_anda@bitbucket.org/trustytahr/dsp-lpj.git [nama_folder]
```
2. Kolaborasikan pekerjaan Anda dengan developer lain.  Setelah diuji commit pekerjaan Anda dengan langkah berikut:

```
#!git

git add path/pekerjaan/yang/akan/di/commit
git commit -m "berikan comment atas pekerjaan yang Anda sudah pekerjaan tersebut, meliputi source code baru, modifying code, atau yang lain"
git fetch origin
git merge origin/master # dengan asumsi remote branch bernama master
git push -u origin master
```

Kesepakatan aturan dalam menulis source code:

1. Karena menggunakan CodeIgniter silakan mengikuti konvensi CI dalam penulisan kelas, method, attribute, dan hal yang lain.  Sebagai contoh nama method harus bisa menggambarkan fungsionalitas/bussiness logic program, penulisan dengan snake case bukan dengan camel case.

2. Gunakan case sensitive, secara khusus untuk pengguna OS Windows, apabila menggunakan small case atau upper case harus konsisten dalam pemanggilan variabelnya, karena apabila hal ini tidak dilakukan program tidak akan berjalan dalam OS Unix termasuk OS X.  

3. Dokumentasi terletak pada folder **docs/documentation**

4. Perubahan atau altering table pada folder **docs/db**

5. Plugin yang menggunakan composer terletak pada folder **vendor**, apabila menambahkan plugin jangan lupa untuk melakukan modify pada *composer.json*.

6. Library yang umum terletak pada folder **assets**.

7. Apabila ada error silakan tulis pada **issues**.

### Repositori ini untuk membangun aplikasi ###

* Monitoring dan Upload Data LPJ Bendahara yang dikirimkan oleh KPPN
* Version 1.0
* Pengguna meliputi KPPN, Kanwil DJPBN, dan Direktorat PKN
* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### How do I get set up? ###

* Summary of set up
* Configuration
* Dependencies
* Database configuration
* How to run tests
* Deployment instructions

### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Who do I talk to? ###

* Repo owner or admin
* Other community or team contact