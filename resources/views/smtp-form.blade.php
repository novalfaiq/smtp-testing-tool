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
                <strong class="block mb-1">Gagal!</strong>
                <div class="text-sm mt-1 max-h-40 overflow-y-auto break-words whitespace-normal">{{ session('error') }}</div>
            </div>
        @endif

        <form id="smtpForm" action="{{ url('/smtp-check') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">SMTP Host</label>
                <input type="text" name="host" value="{{ old('host', 'smtp.gmail.com') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Port</label>
                <input type="number" name="port" value="{{ old('port', '587') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Encryption</label>
                <select name="encryption" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="tls" {{ old('encryption', 'tls') === 'tls' ? 'selected' : '' }}>TLS</option>
                    <option value="ssl" {{ old('encryption') === 'ssl' ? 'selected' : '' }}>SSL</option>
                    <option value="null" {{ old('encryption') === 'null' ? 'selected' : '' }}>None</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email / Username</label>
                <input type="email" name="username" value="{{ old('username') }}" placeholder="example.smtp@gmail.com" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password / App Password</label>
                <input type="password" name="password" value="{{ old('password') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Kirim Email Test Ke (Penerima)</label>
                <input type="email" name="to_email" value="{{ old('to_email') }}" placeholder="target_test@gmail.com" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 font-semibold transition duration-200">
                    Cek Koneksi SMTP
                </button>
                <button type="button" onclick="clearForm()" class="px-4 bg-gray-200 text-gray-700 p-2 rounded-md hover:bg-gray-300 font-semibold transition duration-200">
                    Clear
                </button>
            </div>
        </form>

        <script>
            function clearForm() {
                document.getElementById('smtpForm').reset();
                document.querySelectorAll('#smtpForm input, #smtpForm select').forEach(el => {
                    if (el.type !== 'hidden') {
                        el.value = '';
                    }
                });
                document.querySelector('#smtpForm select[name="encryption"]').value = 'tls';
            }
        </script>
    </div>

</body>
</html>