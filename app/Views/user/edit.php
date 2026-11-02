<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/edit.css'); ?>">
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
                <a href="<?= base_url('dashboard'); ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li class="<?= ($uri == 'dinasluar') ? 'active' : ''; ?>">
                <a href="<?= base_url('dinasluar'); ?>"><i class="fas fa-external-link-alt"></i> <span>Dinas Luar</span></a>
            </li>
            <li>
                <a href="<?= base_url('logout'); ?>" class="logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
            </li>
        </ul>
    </div>
    <nav class="navbar">
        <span class="nav-title">Edit</span>
    </nav>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" style="
            color: green;
            background-color: #e6f9e6;
            border: 1px solid green;
            padding: 12px 20px;
            margin: 20px;
            border-radius: 5px;
            font-weight: bold;
        ">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <nav class="navbar">Dashboard</nav>
    <div class="content">
        <form class="form-container" method="post" action="<?= base_url('dinasluar/simpan'); ?>">
            <h1>Edit Perjalanan Dinas</h1>

            <?php if (session()->getFlashdata('errors')): ?>
                <div style="color:red;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('dinasluar/update/' . $dinas['id']) ?>" method="post">
                <label>No Surat</label>
                <input type="text" name="no_surat" value="<?= esc($dinas['no_surat']) ?>" required><br>

                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?= esc($dinas['tanggal']) ?>" required><br>

                <label>Jenis Dinas</label>
                <select name="jenis_dinas" required>
                    <option value="dinas_luar" <?= $dinas['jenis_dinas'] == 'dinas_luar' ? 'selected' : '' ?>>Dinas Luar</option>
                    <option value="dinas_dalam" <?= $dinas['jenis_dinas'] == 'dinas_dalam' ? 'selected' : '' ?>>Dinas Dalam</option>
                </select><br>

                <label>Nama Pegawai</label>
                <input type="text" name="nama_pegawai" value="<?= esc($dinas['nama_pegawai']) ?>" required><br>

                <label>Tujuan</label>
                <input type="text" name="tujuan" value="<?= esc($dinas['tujuan']) ?>" required><br>

                <label>Kegiatan</label>
                <input type="text" name="kegiatan" value="<?= esc($dinas['kegiatan']) ?>" required><br>

                <label>Tanggal Pulang</label>
                <input type="date" name="tanggal_pulang" value="<?= esc($dinas['tanggal_pulang']) ?>" required><br>

                <label>Pembuat</label>
                <input type="text" name="pembuat" value="<?= esc($dinas['pembuat']) ?>" required><br>

                <div class="form-buttons">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <a href="<?= base_url('dashboard') ?>" class="btn-back"><i class="fas fa-arrow-left"></i>Kembali</a>
                </div>
            </form>
        </form>

    </div>
</body>

</html>