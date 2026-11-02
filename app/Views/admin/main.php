<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/digital-7-mono" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/righteous" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/krona-one" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hover-darken:hover {
            filter: brightness(0.9);
        }

        .active-darken:active {
            filter: brightness(0.8);
        }

        .short-col {
            width: 50px;
        }

        .long-col {
            width: 200px;
        }

        .longer-col {
            width: 250px;
        }

        .font-digital {
            font-family: 'Digital-7 Mono', sans-serif;
            font-size: 36px;
            color: #fff;
            background-color: transparent;
            text-align: center;
            padding: 10px 0;
            letter-spacing: 3px;
        }

        .header-font {
            font-family: 'Righteous', sans-serif;
        }

        .name-app {
            font-family: 'Krona One', sans-serif;
        }

        .active-button {
            position: relative;
            background-color: #00e5ff;
            color: #000;
            font-weight: bold;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
            padding-left: 2rem;
        }

        .active-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -21px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 21px solid transparent;
            border-bottom: 21px solid transparent;
            border-right: 21px solid #00e5ff;
        }
    </style>
    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        }

        function showContent(contentId, title) {
            document.querySelectorAll('.content').forEach(content => content.classList.add('hidden'));
            document.getElementById(contentId).classList.remove('hidden');
            document.getElementById('header-title').textContent = title;
        }

        function buttonActive(title) {
            document.querySelectorAll('nav button').forEach(btn => {
                btn.classList.remove('active-button');
            });

            const activeButton = document.getElementById(title);
            if (activeButton) {
                activeButton.classList.add('active-button');
            }
        }


        async function fetchDataAndRender(url, tableId, columns, paginationId) {
            try {
                const response = await fetch(url);
                const data = await response.json();
                console.log(`Data fetched from ${url}:`, data); // Debugging

                // Pagination variables
                const rowsPerPage = 5; // Set limit to 5 rows per page
                let currentPage = 1;

                // Function to render table rows
                function renderTableRows(page) {
                    const start = (page - 1) * rowsPerPage;
                    const end = start + rowsPerPage;
                    const paginatedData = data.slice(start, end);

                    const tableBody = document.getElementById(tableId);
                    tableBody.innerHTML = paginatedData.map((item, index) => `
                        <tr>
                            <td class="border-b px-2 py-2 short-col">${start + index + 1}</td>
                            ${columns.map(col => `<td class="border-b px-4 py-2">${item[col] || '-'}</td>`).join('')}
                        </tr>
                    `).join('');
                }

                // Function to update pagination buttons
                function updatePaginationButtons() {
                    const totalPages = Math.ceil(data.length / rowsPerPage);
                    const paginationContainer = document.getElementById(paginationId);

                    // If no data, clear pagination and return
                    if (data.length === 0) {
                        paginationContainer.innerHTML = '';
                        return;
                    }

                    // Render pagination buttons
                    paginationContainer.innerHTML = `
                        <button id="${paginationId}-prev-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md hover-darken active-darken" ${currentPage === 1 ? 'hidden' : ''}>Previous</button>
                        <span class="mx-2">Page ${currentPage} of ${totalPages}</span>
                        <button id="${paginationId}-next-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md hover-darken active-darken" ${currentPage === totalPages ? 'hidden' : ''}>Next</button>
                    `;

                    // Add event listeners for Previous and Next buttons
                    document.getElementById(`${paginationId}-prev-btn`).addEventListener('click', () => {
                        if (currentPage > 1) {
                            currentPage--; // Decrement current page
                            renderTableRows(currentPage); // Render rows for the new page
                            updatePaginationButtons(); // Update pagination buttons
                        }
                    });

                    document.getElementById(`${paginationId}-next-btn`).addEventListener('click', () => {
                        if (currentPage < totalPages) {
                            currentPage++; // Increment current page
                            renderTableRows(currentPage); // Render rows for the new page
                            updatePaginationButtons(); // Update pagination buttons
                        }
                    });
                }

                // Initial render
                if (data.length > 0) {
                    renderTableRows(currentPage);
                    updatePaginationButtons();
                } else {
                    // Clear table body if no data
                    document.getElementById(tableId).innerHTML = `
                <tr>
                    <td colspan="${columns.length}" class="text-center py-4">No data available</td>
                </tr>
            `;
                    document.getElementById(paginationId).innerHTML = ''; // Clear pagination
                }
            } catch (error) {
                console.error(`Error fetching data from ${url}:`, error);
            }
        }
        window.onload = function () {
            updateTime();
            buttonActive('Dashboard');
            setInterval(updateTime, 1000);

            const colors = [
                'rgba(255, 99, 132, 0.8)',   // January
                'rgba(54, 162, 235, 0.8)',   // February
                'rgba(255, 206, 86, 0.8)',   // March
                'rgba(75, 192, 192, 0.8)',   // April
                'rgba(153, 102, 255, 0.8)',  // May
                'rgba(255, 159, 64, 0.8)',   // June
                'rgba(199, 199, 199, 0.8)',  // July
                'rgba(83, 102, 255, 0.8)',   // August
                'rgba(255, 102, 153, 0.8)',  // September
                'rgba(102, 255, 204, 0.8)',  // October
                'rgba(204, 204, 0, 0.8)',    // November
                'rgba(0, 204, 102, 0.8)'     // December
            ];

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Jumlah Laporan Perjalanan Dinas',
                        data: [],
                        backgroundColor: colors,
                        borderColor: colors.map(c => c.replace('0.8', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            fetch('/admin/api/getChartData')
                .then(response => response.json())
                .then(data => {
                    myChart.data.datasets[0].data = data;
                    myChart.update();
                })
                .catch(err => console.error('Error loading chart data:', err));


            // Fetch data for tables
            fetchDataAndRender('/admin/api/getDinluBidang', 'dinlu-berdasarkan-bidang', ['Bidang', 'jumlah_perdin'], 'dinlu-bidang-pagination');
            fetchDataAndRender('/admin/api/getDinluPegawai', 'dinlu-berdasarkan-pegawai', ['nama', 'jumlah_perdin'], 'dinlu-pegawai-pagination');
            fetchDataAndRender('/admin/api/getPegawaiPNS', 'pegawai-pns-table-body', ['nip', 'nama', 'jabatan', 'bidang'], 'pegawai-pns-pagination');
            fetchDataAndRender('/admin/api/getPegawaiNonPNS', 'pegawai-non-pns-table-body', ['nama', 'jabatan', 'bidang'], 'pegawai-non-pns-pagination');
            fetchDataAndRender('/admin/api/getBidangList', 'bidang-list-table-body', ['Bidang'], 'bidang-list-pagination');
            fetchDataAndRender('/admin/api/getDinasLuarData', 'dinas-luar-table-body', ['nama', 'kegiatan', 'tujuan', 'no_sp', 'tanggal', 'tanggal_pulang', 'pembuat'], 'dinas-luar-pagination');
        }

        document.getElementById('laporan-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const bulan = document.getElementById('bulan').value;
            const tahun = document.getElementById('tahun').value;

            fetch(`/laporan/export?bulan=${bulan}&tahun=${tahun}`)
                .then(async (response) => {
                    const contentType = response.headers.get('content-type');

                    if (contentType.includes('application/json')) {
                        const result = await response.json();
                        if (result.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: result.error,
                                confirmButtonColor: '#3085d6'
                            });
                            return;
                        }
                    }

                    return response.blob().then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = `Laporan_Dinas_${bulan}_${tahun}.xlsx`;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    });
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal mengambil data laporan.',
                        confirmButtonColor: '#3085d6'
                    });
                });
        });
    </script>
</head>

<body class="bg-gray-800 text-white">
    <div class="flex h-screen flex-col">
        <div class="flex flex-row h-full">
            <?php include 'sidebar.php'; ?>
            <div class="flex-1 flex flex-col overflow-y-auto">
                <?php include 'header.php'; ?>
                <?php include 'content.php'; ?>
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>