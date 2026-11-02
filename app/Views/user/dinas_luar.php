<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dinas_luar.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="sidebar">
        <header>
            <img src="<?= base_url('images/logo.png'); ?>" alt="Logo Disperindag" class="logo">DISPERINDAG
        </header>
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span><?= session()->get('username') ?? 'Guest'; ?></span>
            <span style="color: lightgreen;">online</span>
        </div>

        <div id="clock-container">
            <p id="clock"></p>
        </div>

        <script>
            function updateClock() {
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0');
                var minutes = now.getMinutes().toString().padStart(2, '0');
                var seconds = now.getSeconds().toString().padStart(2, '0');
                var timeString = hours + ":" + minutes + ":" + seconds;

                document.getElementById('clock').innerText = timeString;
            }

            // Perbarui jam setiap detik
            setInterval(updateClock, 1000);
            updateClock();
        </script>
        <?php $uri = service('uri')->getSegment(1); ?>

        <ul>
            <li class="<?= ($uri == 'dashboard') ? 'active' : ''; ?>">
                <a href="<?= base_url('user/dashboard'); ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li class="<?= ($uri == 'dinasluar') ? 'active' : ''; ?>">
                <a href="<?= base_url('user/dinasluar'); ?>"><i class="fas fa-external-link-alt"></i> <span>Dinas</span></a>
            </li>
            <li>
                <a href="<?= base_url('user/logout'); ?>" class="logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
            </li>
        </ul>
    </div>
    <nav class="navbar">Dinas Luar</nav>
    <div class="content">
        <form class="form-container" method="post" action="<?= base_url('user/dinasluar/simpan'); ?>">
            <h1>Tambah Perjalanan Dinas</h1>

            <label for="no_sp">No Surat Perintah (SP)</label>
            <input type="text" id="no_sp" name="no_sp" placeholder="Masukkan No Surat" required>

            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jenis_dinas">Dinas</label>
            <select id="jenis_dinas" name="jenis_dinas" required>
                <option value="" disabled selected hidden>Pilih Dinas</option>
                <option value="Dinas Luar">Dinas Luar</option>
                <option value="Dinas Dalam">Dinas Dalam</option>
            </select>

            <label for="nama">Nama Pegawai</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>

            <label for="tujuan">Tujuan</label>
            <input type="text" id="tujuan" name="tujuan" placeholder="Masukkan Tujuan" required>

            <label for="kegiatan">Kegiatan</label>
            <input type="text" id="kegiatan" name="kegiatan" placeholder="Masukkan Kegiatan" required>

            <label for="tanggal_pulang">Tanggal Pulang</label>
            <input type="date" id="tanggal_pulang" name="tanggal_pulang" required>

            <label for="pembuat">Pembuat</label>
            <input type="text" id="pembuat" name="pembuat" placeholder="Nama Pembuat" required>

            <button type="submit">OK</button>
        </form>

    </div>

</body>

</html>