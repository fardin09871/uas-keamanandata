<?php
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('keys:generate', function () {
    $r = openssl_pkey_new(['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA]);
    if (!$r) { $this->error('Gagal membuat key. Cek OPENSSL_CONF / ekstensi openssl.'); return 1; }
    openssl_pkey_export($r, $priv);
    file_put_contents(storage_path('app/public.pem'), openssl_pkey_get_details($r)['key']);
    file_put_contents(base_path('PRIVATE_KEY.pem'), $priv);
    $this->info('Selesai. Pindahkan PRIVATE_KEY.pem keluar dari project, jangan di-commit!');
})->purpose('Generate RSA-2048 keypair');
