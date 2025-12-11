<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 font-sans">

    <!-- Main Container -->
    <div class="flex justify-center items-center h-screen">

        <!-- Login Box -->
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-sm w-full space-y-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Siswa</h2>
            <form action="<?= site_url('loginregister/login_siswa'); ?>" method="POST">
                <div class="space-y-4">
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <input type="text" id="nisn" name="nisn" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan NISN" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Password" required>
                    </div>
                    <div>
                        <button type="submit" class="w-full text-white p-3 mt-3 rounded-lg font-semibold bg-gradient-to-r from-indigo-600 to-blue-500 shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                            Login
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center">
                <p class="text-sm text-gray-600">Belum punya akun? <a href="<?= site_url('loginregister/register_siswa'); ?>" class="text-blue-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Daftar Siswa</a></p>
            </div>
        </div>
    </div>

</body>
</html>
