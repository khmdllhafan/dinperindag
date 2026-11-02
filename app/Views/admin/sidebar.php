<div class="bg-purple-800 w-1/4 lg:w-1/6 flex flex-col items-center py-4 h-full">
    <div class="text-center mb-4">
        <h1 class="text-xl name-app">REKAPP</h1>
    </div>
    <div class="text-center mb-4 flex items-start">
        <i class="fa-regular fa-id-badge text-4xl"></i>
        <span class="text-lg font-medium">
            <?= session()->get('username') ?? 'Guest'; ?>
        </span>
    </div>
    <div class="text-center mb-4">
        <p id="clock" class="text-2xl font-digital"></p>
    </div>
    <nav class="flex flex-col items-center w-full h-screen">
        <div class="w-full flex-grow flex flex-col items-end">
            <button onclick="showContent('dashboard-content', 'Dashboard'); buttonActive('Dashboard')" id="Dashboard"
                class="w-5/6 text-center py-2 mb-2 hover-darken active-darken">
                Dashboard
            </button>

            <button onclick="showContent('pegawai-content', 'Pegawai'); buttonActive('Pegawai')" id="Pegawai"
                class="w-5/6 text-center py-2 mb-2 hover-darken active-darken">
                Pegawai
            </button>

            <button onclick="showContent('bidang-content', 'Bidang'); buttonActive('Bidang')" id="Bidang"
                class="w-5/6 text-center py-2 mb-2 hover-darken active-darken">
                Bidang
            </button>

            <button onclick="showContent('dinas-luar-content', 'Perjalanan Dinas'); buttonActive('Perjalanan Dinas')"
                id="Perjalanan Dinas" class="w-5/6 text-center py-2 mb-2 hover-darken active-darken">
                Perjalanan Dinas
            </button>
            <button onclick="showContent('laporan-content', 'Laporan Bulanan'); buttonActive('Laporan Bulanan')"
                id="Laporan Bulanan" class="w-5/6 text-center py-2 mb-2 hover-darken active-darken">
                Laporan
            </button>
        </div>


        <button onclick="window.location.href='/admin/logout'" id="Logout"
            class="w-11/12 text-center py-2 bg-red-600 mb-2 rounded-md flex items-center justify-center hover-darken active-darken">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
    </nav>


</div>