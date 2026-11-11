<?php
require_once __DIR__ . "/../config/auth.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Saya</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header>
        <h1>BIODATA SAYA</h1>
        <p>Website Biodata Sederhana</p>
        <p>Mata Kuliah Web Programming 1</p>
    </header>

    <hr>

    <nav>
        <a href="#biodata">Biodata</a> |
        <a href="#tentang">Tentang Saya</a> |
        <a href="#pendidikan">Pendidikan</a> |
        <a href="#hobi">Hobi</a> |
        <a href="#skill">Skill</a> |
        <a href="#sosial-media">Social Media</a>
        <a href="layout.php">Layout Experiment</a>
        <a href="data_mahasiswa.php">Data Mahasigma</a>
        <a href="form_mahasiswa.php">Tambah Mahasigma</a>
        <a href="../crud/index.php">CRUD Mahasiswa</a>
        <a href="../crud-media/index.php">CRUD Media</a>
    <a href="../proses/logout.php">Logout</a>
</nav>

    <hr>

    <main>

        <section id="biodata">
            <h2>Data Pribadi</h2>

            <img src="../assets/images/foto.jpg"
                 alt="Foto Profil Saya"
                 width="150">

            <br><br>

            <table border="1">
                <tr>
                    <td><b>Nama</b></td>
                    <td>Fajri Fakhrurrozi</td>
                </tr>

                <tr>
                    <td><b>NIM</b></td>
                    <td>4112755201250009</td>
                </tr>

                <tr>
                    <td><b>Program Studi</b></td>
                    <td>Informatika</td>
                </tr>

                <tr>
                    <td><b>Fakultas</b></td>
                    <td>Faculty of Information Computer and Technology</td>
                </tr>

                <tr>
                    <td><b>Email</b></td>
                    <td>defajri30@gmail.com</td>
                </tr>

                <tr>
                    <td><b>Tempat Lahir</b></td>
                    <td>Karawang</td>
                </tr>
            </table>
        </section>

        <hr>

        <section id="tentang">
            <h2>Tentang Saya</h2>

            <p>
                Halo, nama saya Fajri Fakhrurrozi. Saya merupakan mahasiswa
                Program Studi Informatika. Saya tertarik mempelajari
                teknologi, pemrograman, dan pengembangan aplikasi web.
            </p>
        </section>

        <hr>

        <section id="pendidikan">
            <h2>Riwayat Pendidikan</h2>

            <ol>
                <li>SDN Sukamulya 3</li>
                <li>MTs Al-Kautsar 1</li>
                <li>SMK Indonesia Mas</li>
                <li>S1 Informatika - Universitas Horizon Indonesia</li>
            </ol>
        </section>

        <hr>

        <section id="hobi">
            <h2>Hobi</h2>

            <ul>
                <li>Badminton</li>
                <li>Mendengarkan Musik</li>
                <li>Trading</li>
                <li>Touring</li>
            </ul>
        </section>

        <hr>

        <section id="skill">
            <h2>Skill</h2>

            <ul>
                <li>HTML</li>
                <li>Microsoft Office</li>
                <li>Public Speaking</li>
            </ul>
        </section>

        <hr>

        <section id="sosial-media">
            <h2>Social Media</h2>

            <p>
                Instagram:
                <a href="https://www.instagram.com/_fajriajah?stkn=dXJ4ZWpscnViODVn" target="_blank">
                    My Instagram Guwejh
                </a>
            </p>

            <p>
                LinkedIn:
                <a href="https://www.linkedin.com/" target="_blank">
                    My LinkedIn Guwejh
                </a>
            </p>

            <p>
                GitHub:
                <a href="https://github.com/fajrixploid" target="_blank">
                    My GitHub Guwejh
                </a>
            </p>
        </section>
    </main>

    <hr>

    <footer>
        <p>Copyright &copy; 2026 - Fajri Fakhrurrozi</p>
        <p>Web Programming 1</p>
    </footer>

</body>
</html>