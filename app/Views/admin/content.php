<div class="p-4 flex-1" style="background-color: #F0F2F5;">
    <div id="dashboard-content" class="content">
        <div class="bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
            style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">Grafik
                Laporan Bulanan Perjalanan Dinas</h3>
            <canvas id="myChart" class="p-4 rounded-lg"></canvas>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div class="bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
                style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">
                    Perjalanan Dinas Berdasarkan Bidang</h3>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-400 px-2 py-2 short-col">No</th>
                            <th class="border-b border-gray-400 px-4 py-2">Nama Bidang</th>
                            <th class="border-b border-gray-400 px-4 py-2">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="dinlu-berdasarkan-bidang" class="border-b border-gray-400">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
                <div id="dinlu-bidang-pagination" class="mt-4 flex items-center justify-center">
                    <!-- Pagination buttons will be dynamically added here -->
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
                style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">
                    Perjalanan Dinas Berdasarkan Pegawai</h3>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-400 px-2 py-2 short-col">No</th>
                            <th class="border-b border-gray-400 px-4 py-2">Nama Pegawai</th>
                            <th class="border-b border-gray-400 px-4 py-2">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="dinlu-berdasarkan-pegawai" class="border-b border-gray-400">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
                <div id="dinlu-pegawai-pagination" class="mt-4 flex items-center justify-center">
                    <!-- Pagination buttons will be dynamically added here -->
                </div>
            </div>
        </div>
    </div>
    <div id="pegawai-content" class="content hidden">
        <div class="bg-white p-4 rounded-lg mb-4 text-gray-800 border border-[#DADADA]"
            style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">Data
                Pegawai PNS</h3>
            <input type="text" placeholder="Cari Pegawai PNS..." class="w-full p-2 mb-4 bg-gray-200 rounded-md">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="border-b border-gray-400 px-2 py-2 text-left short-col">No</th>
                        <th class="border-b border-gray-400 px-8 py-2 text-left long-col">NIP</th>
                        <th class="border-b border-gray-400 px-6 py-2 text-left longer-col">Nama</th>
                        <th class="border-b border-gray-400 px-4 py-2 text-left">Jabatan</th>
                        <th class="border-b border-gray-400 px-4 py-2 text-left">Bidang</th>
                    </tr>
                </thead>
                <tbody id="pegawai-pns-table-body" class="border-b border-gray-400">
                    <!-- Data will be populated here -->
                </tbody>
            </table>
            <div id="pegawai-pns-pagination" class="mt-4 flex items-center justify-center">
                <!-- Pagination buttons will be dynamically added here -->
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
            style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">Data
                Pegawai Non PNS</h3>
            <input type="text" placeholder="Cari Pegawai Non PNS..." class="w-full p-2 mb-4 bg-gray-200 rounded-md">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="border-b border-gray-400 px-2 py-2 text-left short-col">No</th>
                        <th class="border-b border-gray-400 px-6 py-2 text-left longer-col">Nama</th>
                        <th class="border-b border-gray-400 px-4 py-2 text-left">Jabatan</th>
                        <th class="border-b border-gray-400 px-4 py-2 text-left">Bidang</th>
                    </tr>
                </thead>
                <tbody id="pegawai-non-pns-table-body" class="border-b border-gray-400">
                    <!-- Data will be populated here -->
                </tbody>
            </table>
            <div id="pegawai-non-pns-pagination" class="mt-4 flex items-center justify-center">
                <!-- Pagination buttons will be dynamically added here -->
            </div>
        </div>
    </div>
    <div id="bidang-content" class="content hidden">
        <div class="bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
            style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">Bidang
            </h3>
            <input type="text" placeholder="Cari Bidang..." class="w-full p-2 mb-4 bg-gray-200 rounded-md">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="border-b border-gray-400 px-2 py-2 short-col">No</th>
                        <th class="border-b border-gray-400 px-4 py-2 text-left">Bidang</th>
                    </tr>
                </thead>
                <tbody id="bidang-list-table-body" class="border-b border-gray-400">
                    <!-- Data will be populated here -->
                </tbody>
            </table>
            <div id="bidang-pagination" class="mt-4 flex items-center justify-center">
                <!-- Pagination buttons will be dynamically added here -->
            </div>
        </div>
    </div>
    <div id="dinas-luar-content" class="content hidden">
        <div class="bg-white p-4 rounded-lg text-gray-800 border border-[#DADADA]"
            style="border-width: 2px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="text-lg font-bold mb-4" style="background-color: #2A4D8C; color: white; padding: 10px;">Data
                Perjalanan Dinas</h3>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="border-b border-gray-400 px-2 py-2 short-col">No</th>
                        <th class="border-b border-gray-400 px-4 py-2">Nama</th>
                        <th class="border-b border-gray-400 px-4 py-2">Kegiatan</th>
                        <th class="border-b border-gray-400 px-4 py-2">Tujuan</th>
                        <th class="border-b border-gray-400 px-4 py-2">No.SP</th>
                        <th class="border-b border-gray-400 px-4 py-2">Tanggal</th>
                        <th class="border-b border-gray-400 px-4 py-2">Tanggal Pulang</th>
                        <th class="border-b border-gray-400 px-4 py-2">Pembuat</th>
                    </tr>
                </thead>
                <tbody id="dinas-luar-table-body" class="border-b border-gray-400">
                    <!-- Data will be populated here -->
                </tbody>
            </table>
            <div id="dinas-luar-pagination" class="mt-4 flex items-center justify-center">
                <!-- Pagination buttons will be dynamically added here -->
            </div>
        </div>
    </div>
    <div id="laporan-content" class="content hidden">
        <form action="<?= base_url('admin/laporan/export') ?>" method="get" class="flex items-center gap-2">
            <select name="bulan" class="p-2 rounded-md">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <select name="tahun" class="p-2 rounded-md">
                <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Cetak Laporan</button>
        </form>
    </div>
</div>