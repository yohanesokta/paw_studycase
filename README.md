# FRESH LOANDRY
> Laundry Online yang bertujuan untuk mempermudah proses pemesanan, pelacakan status, hingga pencatatan transaksi secara digital. Dengan diterapkannya sistem ini, kami berharap layanan laundry dapat menjadi lebih cepat, teratur, transparan, dan nyaman digunakan oleh semua pihak.

### TEAMS & CONTRIBUTOR
- [Yohanes Oktanio](https://github.com/yohanesokta) | 240411100095
- [Surya Maulana Akhmad](https://github.com/suryamaulana98) | 240411100160
- [Rizki Pratama Sunarko](https://github.com/rizkisunarko) | 240411100181
- [Anas](https://github.com/Anasasemjaran) | 240411100200
- [M Andri Firmansyah](https://github.com/Andri-24) | 240411100139
# PASCA RUNNING

>  hal yang wajib di lakukan untuk bisa menjalankan adalah pastikan web server kalian mendukung mod_rewrite. Hal ini umum dilakukan di production ready aplikasi. ini bukan plugin tapi fitur apache yang harus di aktifkan, syukurlah kalo misal pake nginx tinggal config 

**Cara Mengaktifkan Mod Rewrite**

1. Buka httpd.conf ( xampp biasa di C:\xampp\apache\conf\httpd.conf )
2. cari bagian
```
#LoadModule rewrite_module modules/mod_rewrite.so
```
hapus tanda pagar , pastikan tidak ada tanda pagar untuk itu!

2. cari semua bagian AllowOverride pastikan all tidak denide atau yang lain
3. cari semua Require all pastikan granted 

atau lihat di tutorial jaman batu [disini](https://www.youtube.com/watch?v=OCDPTTuvAZ4)

# CARA RUNNING



1. clone proyek ke htdocs webserver ( wajib di htdocs gk usa move move )
```bash
git clone https://github.com/yohanesokta/paw_studycase.git
```
2. setup database ( incomming )
3. open proyek sesuai folder