<!doctype html><html lang="id"><head><meta charset="utf-8">
<title>Admin SIZAM</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-slate-50 p-6">
<div class="max-w-6xl mx-auto">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Dashboard (terdekripsi)</h1>
    <form method="POST" action="/admin/logout">@csrf<button class="text-sm underline">Keluar</button></form>
  </div>
  <p class="mb-4">Total terkumpul: <b>Rp {{ number_format($total, 0, ',', '.') }}</b></p>
  <div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2 overflow-x-auto bg-white rounded-xl shadow">
      <table class="w-full text-sm">
        <tr class="bg-slate-200 text-left">
          <th class="p-2">Nama</th><th>HP</th><th>Alamat</th><th>Jenis</th><th>Jumlah</th><th>Ciphertext DB</th><th></th>
        </tr>
        @foreach ($rows as $r)
        <tr class="border-t">
          <td class="p-2">{{ $r['d']['nama'] ?? '⚠ gagal dekripsi' }}</td>
          <td>{{ $r['d']['hp'] ?? '' }}</td>
          <td>{{ $r['d']['alamat'] ?? '' }}</td>
          <td>{{ $r['d']['jenis'] ?? '' }}</td>
          <td>{{ isset($r['d']['jumlah']) ? number_format($r['d']['jumlah'], 0, ',', '.') : '' }}</td>
          <td class="font-mono text-xs text-slate-400">{{ $r['raw'] }}</td>
          <td><form method="POST" action="/admin/{{ $r['id'] }}">@csrf @method('DELETE')
            <button class="text-red-600">Hapus</button></form></td>
        </tr>
        @endforeach
      </table>
    </div>
    <div class="bg-white p-4 rounded-xl shadow">
      <h2 class="font-bold mb-2">Tambah Data Manual</h2>
      @include('form', ['action' => '/admin/tambah'])
    </div>
  </div>
</div></body></html>
