<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Awal Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 font-sans">

    <!-- Main Container -->
    <div class="flex justify-center items-center h-screen">

        <!-- Card with Options -->
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-sm w-full space-y-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Pilih Login</h2>
            <div class="space-y-4">
                <!-- Login as Siswa -->
                <div>
                    <a href="<?= site_url('loginregister/login_siswa'); ?>" class="block w-full text-center p-10 rounded-lg text-white font-semibold bg-gradient-to-r from-indigo-600 to-blue-500 shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                        Login Siswa
                    </a>
                </div>
                <!-- Login as Admin -->
                <div>
                    <a href="<?= site_url('loginregister/login_admin'); ?>" class="block w-full text-center p-10 rounded-lg text-white font-semibold bg-gradient-to-r from-teal-600 to-green-500 shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                        Login Admin
                    </a>
                </div>
                <!-- Login as Kepala Sekolah -->
                <div>
                    <a href="<?= site_url('loginregister/login_kepsek'); ?>" class="block w-full text-center p-10 rounded-lg text-white font-semibold bg-gradient-to-r from-orange-600 to-yellow-500 shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                        Login Kepala Sekolah
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
