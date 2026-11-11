PROJECT AFTERUTS - CATATAN PERBAIKAN PATH

1. Letakkan folder afteruts di C:\laragon\www\afteruts
2. Jalankan Apache dan MySQL dari Laragon.
3. Pastikan database web_programming_1 sudah ada.
4. Pastikan tabel mahasiswa memiliki kolom: id, nim, nama, program_studi, email.
5. Pastikan tabel users memiliki kolom: id, username, password_hash, nama_lengkap.
6. Buka http://localhost/afteruts/pages/login.php
7. Jika user admin belum ada, buka http://localhost/afteruts/proses/buat_user.php satu kali.
   Kredensial awal di source project: admin / admin123.
8. Setelah user berhasil dibuat, hapus atau batasi akses ke buat_user.php.
9. Login, lalu uji halaman lama dan CRUD Mahasiswa.

Catatan: arsip asli tidak menyertakan database/database.sql. Database dan tabel harus
tersedia di MySQL sebelum fitur data/CRUD dapat berjalan.
