<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/smtp-form', function () {
    return view('smtp-form');
});

// 2. Proses Pengecekan SMTP dari Inputan Form
Route::post('/smtp-check', function (Request $request) {
    
    // Validasi input
    $request->validate([
        'host' => 'required',
        'port' => 'required|numeric',
        'username' => 'required|email',
        'password' => 'required',
        'to_email' => 'required|email',
    ]);

    try {
        // Override runtime config dan set default mailer ke smtp
        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => $request->host,
            'mail.mailers.smtp.port' => $request->port,
            'mail.mailers.smtp.encryption' => $request->encryption === 'null' ? null : $request->encryption,
            'mail.mailers.smtp.username' => $request->username,
            'mail.mailers.smtp.password' => $request->password,
            'mail.from.address' => $request->username,
            'mail.from.name' => 'SMTP Checker Form',
        ]);

        // Kirim email test menggunakan konfigurasi baru di atas
        Mail::html('<h3>Sistem Uji Coba SMTP Berhasil!</h3><p>Koneksi dari form manual ini berjalan 100% lancar.</p>', function ($message) use ($request) {
            $message->to($request->to_email)
                    ->subject('Test SMTP Dinamis - Sukses');
        });

        return redirect('/smtp-form')->with('success', 'Koneksi SMTP Sukses! Email test berhasil dikirim ke ' . $request->to_email);

    } catch (\Exception $e) {
        // Jika gagal, kembalikan ke halaman form beserta detail error dari mailer
        return redirect('/smtp-form')->withInput()->with('error', $e->getMessage());
    }
});