<!doctype html><html lang="id"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>SIZAM</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-emerald-50 text-slate-800">
<header class="bg-emerald-700 text-white p-4 flex justify-between max-w-4xl mx-auto">
  <b>SIZAM</b><a href="/admin/login" class="underline text-sm">Admin</a>
</header>
<main class="max-w-4xl mx-auto p-6 grid md:grid-cols-2 gap-8">
  <section>
    <h1 class="text-3xl font-bold">Zakat &amp; Infaq Masjid Digital</h1>
    <p class="mt-3">Salurkan zakat, infaq, dan sedekah Anda. Seluruh data donatur dienkripsi
    AES-256 + RSA-2048 sebelum disimpan, sehingga privasi Anda terjaga.</p>
    <ul class="mt-4 list-disc ml-5 text-sm">
      <li>Data pribadi tidak tersimpan dalam bentuk teks biasa</li>
      <li>Hanya pengurus berkunci privat yang dapat membuka data</li>
    </ul>
  </section>
  <section class="bg-white p-5 rounded-xl shadow">
    @if (session('ok')) <p class="bg-emerald-100 p-2 rounded mb-3 text-sm">{{ session('ok') }}</p> @endif
    @include('form', ['action' => '/kirim'])
  </section>
</main></body></html>
