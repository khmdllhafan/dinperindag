<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="<?= base_url('user/dinasluar'); ?>"><i class="fas fa-external-link-alt"></i> <span>Dinas
                        Luar</span></a>
            </li>
            <li>
                <a href="<?= base_url('user/logout'); ?>" class="logout"><i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>
        </ul>
    </div>
    <nav class="navbar">
        <span class="nav-title">Dashboard</span>
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
    <div class="table-container">
        <div class="flex-1 flex flex-col overflow-y-auto bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
            style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">Grafik
                Laporan Bulanan Perjalanan Dinas</h3>
            <canvas id="myChart" class="p-4 rounded-lg"></canvas>
            <script>
                window.onload = function() {
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            datasets: [{
                                label: 'Jumlah Laporan Perjalanan Dinas',
                                data: [],
                                backgroundColor: 'rgba(54, 163, 235, 0.84)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: 200
                                }
                            }
                        }
                    });

                    fetch('<?= base_url('user/api/getChartData'); ?>')
                        .then(response => response.json())
                        .then(data => {
                            myChart.data.datasets[0].data = data;
                            myChart.update();
                        })
                        .catch(err => console.error('Error loading chart data:', err));
                }
            </script>


        </div>
        <div style="margin-bottom: 10px; display: flex; gap: 10px; align-items: center;">
            <input type="text" id="searchInput" placeholder="Cari data"
                style="width: 300px; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            <button id="searchBtn"
                style="padding: 8px 16px; border: none; background-color: #00c3ff; color: white; border-radius: 5px; cursor: pointer;">
                Search
            </button>
        </div>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kegiatan</th>
                    <th>Tujuan</th>
                    <th>No.SP</th>
                    <th>Tanggal</th>
                    <th>Tanggal Pulang</th>
                    <th>Pembuat</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dinasluar) && is_array($dinasluar)): ?>
                    <?php foreach ($dinasluar as $row): ?>
                        <tr>
                            <td><?= esc($row['id'] ?? '') ?></td>
                            <td><?= esc($row['nama'] ?? '') ?></td>
                            <td><?= esc($row['kegiatan'] ?? '') ?></td>
                            <td><?= esc($row['tujuan'] ?? '') ?></td>
                            <td><?= esc($row['no_sp'] ?? '') ?></td>
                            <td><?= esc($row['tanggal'] ?? '') ?></td>
                            <td><?= esc($row['tanggal_pulang'] ?? '') ?></td>
                            <td><?= esc($row['pembuat'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada data perjalanan dinas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tempat pagination -->
        <div id="pagination" style="margin-top: 20px; text-align: center;"></div>

        <script>
            const rowsPerPage = 5;
            const table = document.getElementById('dataTable');
            const tbody = table.querySelector('tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr'));
            const pagination = document.getElementById('pagination');
            let currentPage = 1;
            let filteredRows = [...allRows]; // default: semua baris

            function showPage(page, data = filteredRows) {
                const totalPages = Math.ceil(data.length / rowsPerPage);
                if (page < 1) page = 1;
                if (page > totalPages) page = totalPages;

                // Sembunyikan semua
                allRows.forEach(row => row.style.display = 'none');

                // Tampilkan yang sesuai halaman
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                data.slice(start, end).forEach(row => row.style.display = '');

                renderPagination(page, data);
            }

            function renderPagination(currentPage, data = filteredRows) {
                const totalPages = Math.ceil(data.length / rowsPerPage);
                pagination.innerHTML = '';

                // Prev button
                const prevBtn = document.createElement('button');
                prevBtn.textContent = 'Prev';
                prevBtn.disabled = currentPage === 1;
                styleButton(prevBtn, currentPage !== 1);
                prevBtn.addEventListener('click', () => showPage(--currentPage, data));
                pagination.appendChild(prevBtn);

                // Number buttons
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    btn.style.margin = '0 5px';
                    btn.style.padding = '6px 12px';
                    btn.style.borderRadius = '5px';
                    btn.style.border = '1px solid #ccc';
                    btn.style.backgroundColor = i === currentPage ? '#007bff' : '#f0f0f0';
                    btn.style.color = i === currentPage ? 'white' : 'black';
                    btn.style.cursor = 'pointer';
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        showPage(i, data);
                    });
                    pagination.appendChild(btn);
                }

                // Next button
                const nextBtn = document.createElement('button');
                nextBtn.textContent = 'Next';
                nextBtn.disabled = currentPage === totalPages;
                styleButton(nextBtn, currentPage !== totalPages);
                nextBtn.addEventListener('click', () => showPage(++currentPage, data));
                pagination.appendChild(nextBtn);
            }

            function styleButton(button, enabled) {
                button.style.margin = '0 5px';
                button.style.padding = '6px 12px';
                button.style.borderRadius = '5px';
                button.style.border = '1px solid #ccc';
                button.style.backgroundColor = enabled ? '#f0f0f0' : '#ddd';
                button.style.color = enabled ? 'black' : '#888';
                button.style.cursor = enabled ? 'pointer' : 'not-allowed';
            }

            function searchTable() {
                const input = document.getElementById('searchInput').value.toLowerCase();
                filteredRows = allRows.filter(row => row.innerText.toLowerCase().includes(input));
                currentPage = 1;
                showPage(currentPage, filteredRows);
            }

            document.getElementById('searchInput').addEventListener('keyup', searchTable);
            document.getElementById('searchBtn').addEventListener('click', searchTable);

            // Awal tampilkan semua
            showPage(currentPage);
        </script>

    </div>

</body>

</html>