<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-50 font-sans">

<!-- Sidebar -->
<div class="flex">
    <!-- Sidebar -->
    <div class="bg-white text-gray-800 w-64 min-h-screen p-5 space-y-6 transition-all duration-300" id="sidebar">
        <ul class="space-y-4">
            <li><a href="<?= site_url('dashboard'); ?>" class="text-blue-500 flex items-center p-3 rounded-md text-2xl font-bold ml-3"><i class="fas fa-book-reader mr-3"></i>EduManage</a></li>
            <li><a href="<?= site_url('dashboard'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-home mr-3"></i>Dashboard</a></li>
            <li><a href="<?= site_url('jurnal'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-book mr-3"></i>Jurnal Kelas</a></li>
            <li><a href="<?= site_url('pembayaran'); ?>" class="text-blue-500 flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-credit-card mr-3"></i>Pembayaran</a></li>
            <li><a href="<?= site_url('absensi'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-calendar-check mr-3"></i>Absensi</a></li>
            <li><a href="<?= site_url('siswa'); ?>" class=" flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-users mr-3"></i>Pengelolaan Data Siswa</a></li>
            <li><a href="<?= site_url('admin'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-chalkboard-teacher mr-3"></i>Pengelolaan Data Guru</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 space-y-6 transition-all duration-300" id="content">
    
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
            Pembayaran : <?= $siswa->nama; ?>
        </h1>



        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white">
                    <tr>
                        <th class="p-4 border-b text-left">No</th>
                        <th class="p-4 border-b text-left">Tanggal</th>
                        <th class="p-4 border-b text-left">Status</th>
                        <th class="p-4 border-b text-left">Bukti Transfer</th>
                        <th class="p-4 border-b text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pembayaran)): ?>
                        <?php $no = 1; foreach ($pembayaran as $bayar): ?>
                            <tr class="hover:bg-gradient-to-r from-blue-200 to-indigo-200">
                                <td class="py-2 px-4"><?= $no++; ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($bayar->created_at); ?></td> <!-- Menampilkan Tanggal -->
                                <td class="py-2 px-4"><?= ucfirst(htmlspecialchars($bayar->status)); ?></td>
                                <td class="py-2 px-4">
                                    <a href="<?= base_url('uploads/bukti_transfer/' . htmlspecialchars($bayar->bukti_transfer)); ?>" 
                                       target="_blank" 
                                       class="text-blue-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">
                                       Lihat Bukti Transfer
                                    </a>
                                </td>
                                <td class="py-2 px-4 space-x-2">
                                    <?php if ($bayar->status == 'pending'): ?>
                                        <a href="<?= site_url('pembayaran/acc_pembayaran/' . $bayar->id); ?>" class="text-blue-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Acc</a>
                                        <a href="<?= site_url('pembayaran/tolak_pembayaran/' . $bayar->id); ?>" class="text-red-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Tolak</a>
                                    <?php else: ?>
                                        <span class="text-gray-600">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center text-gray-500">Tidak ada data pembayaran yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
