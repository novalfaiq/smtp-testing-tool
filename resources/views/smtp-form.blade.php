<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic SMTP Checker</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">SMTP Checker</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Gagal!</strong> <p class="text-sm mt-1">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ url('/smtp-check') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">SMTP Host</label>
                <input type="text" name="host" value="smtp.gmail.com" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Port</label>
                <input type="number" name="port" value="587" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Encryption</label>
                <select name="encryption" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="tls">TLS</option>
                    <option value="ssl">SSL</option>
                    <option value="null">None</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email / Username</label>
                <input type="email" name="username" placeholder="example.smtp@gmail.com" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password / App Password</label>
                <input type="password" name="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Kirim Email Test Ke (Penerima)</label>
                <input type="email" name="to_email" placeholder="target_test@gmail.com" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 font-semibold transition duration-200">
                Cek Koneksi SMTP
            </button>
        </form>
    </div>

</body>
</html>