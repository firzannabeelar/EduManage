<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-50 font-sans">

<!-- Sidebar -->
<div class="flex" id="app">
    <div class="bg-white text-gray-800 w-64 h-screen p-5 space-y-6 transition-all duration-300" id="sidebar">
        <ul class="space-y-4">
        <li>
            <a href="<?= site_url('dashboard/dashboard_siswa'); ?>" 
            class="text-blue-500 flex items-center p-3 rounded-md text-2xl font-bold ml-3"><i class="fas fa-book-reader mr-3"></i>EduManage</a></li>
            </a>
        </li>
        <li>
            <a href="<?= site_url('dashboard/dashboard_siswa'); ?>" 
            class="text-blue-500 flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md">
            <i class="fas fa-home mr-3"></i>Dashboard
            </a>
        </li>
        <li>
            <a href="<?= isset($kelas) && !empty($kelas) ? site_url('jurnal/detail_siswa/' . $kelas->id) : 'javascript:void(0)'; ?>" 
            class="flex items-center p-3 rounded-md 
                    <?= isset($kelas) && !empty($kelas) ? 'hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white' : 'text-gray-500 cursor-not-allowed'; ?>">
            <i class="fas fa-book mr-3"></i>Jurnal Kelas
            </a>
        </li>
        <li>
            <a href="<?= site_url('pembayaran/upload_bukti'); ?>" 
            class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md">
            <i class="fas fa-credit-card mr-3"></i>Pembayaran
            </a>
        </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="flex-1 p-8 space-y-6 transition-all duration-300 bg-blue-50">
        <!-- Header -->
        <div class="flex justify-between items-center bg-gradient-to-r from-blue-500 to-indigo-400 text-white p-6 rounded-lg shadow-md">
            <div>
                <h1 class="text-3xl font-bold">Selamat Datang, <?= $this->session->userdata('nama'); ?>!</h1>
                <p class="text-lg">
                    NISN : <?= $this->session->userdata('nisn'); ?>
                </p>
            </div>
            <div>
                <i class="fas fa-user-circle text-6xl"></i>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Status Pembayaran -->
            <div class="bg-gradient-to-r from-green-400 to-teal-400 shadow-md rounded-lg p-6 text-center text-white flex items-center justify-center flex-col">
                <h3 class="text-2xl font-semibold"><i class="fas fa-wallet mr-2"></i>Status Pembayaran</h3>
                <p class="text-3xl font-bold mt-2">
                    <?= ($status_pembayaran === 'Lunas') ? 'Lunas' : 'Belum Lunas'; ?>
                </p>
            </div>
            <!-- Absensi -->
            <div class="bg-gradient-to-r from-yellow-400 to-orange-400 shadow-md rounded-lg p-6 text-center text-white">
                <h3 class="text-2xl font-semibold"><i class="fas fa-calendar-check mr-2"></i>Absensi</h3>
                <p class="mt-2">Hadir: <span class="font-bold"><?= $absensi['hadir']; ?></span> kali</p>
                <p>Izin: <span class="font-bold"><?= $absensi['izin']; ?></span> kali</p>
                <p>Alpha: <span class="font-bold"><?= $absensi['alpha']; ?></span> kali</p>
            </div>
            <!-- Jurnal Kelas Terbaru -->
            <div class="bg-gradient-to-r from-purple-500 to-pink-400 shadow-md rounded-lg p-6 text-center text-white flex items-center justify-center flex-col">
                <h3 class="text-2xl font-semibold"><i class="fas fa-book mr-2"></i>Kelas</h3>
                <p class="text-3xl font-bold mt-2"><?= $this->session->userdata('tingkat') . '-' . $this->session->userdata('jurusan') . '-' . $this->session->userdata('nama_kelas'); ?></p>
            </div>
        </div>

        <!-- Biodata Siswa -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Biodata Siswa</h2>
            <table class="table-auto w-full">
                <tr>
                    <td class="font-semibold py-2 text-gray-600">Nama</td>
                    <td>: <?= $this->session->userdata('nama'); ?></td>
                </tr>
                <tr>
                    <td class="font-semibold py-2 text-gray-600">NISN</td>
                    <td>: <?= $this->session->userdata('nisn'); ?></td>
                </tr>
                <tr>
                    <td class="font-semibold py-2 text-gray-600">Jurusan</td>
                    <td>: <?= $this->session->userdata('jurusan'); ?></td>
                </tr>
                <tr>
                    <td class="font-semibold py-2 text-gray-600">Kelas</td>
                    <td>: <?= $this->session->userdata('tingkat') . '-' . $this->session->userdata('jurusan') . '-' . $this->session->userdata('nama_kelas'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
