<!doctype html><html lang="id"><head><meta charset="utf-8">
<title>Login Admin</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-slate-100 min-h-screen grid place-items-center">
<form method="POST" action="/admin/login" class="bg-white p-6 rounded-xl shadow w-full max-w-lg grid gap-3">
  @csrf
  <h1 class="text-xl font-bold">Masuk Admin</h1>
  <label class="text-sm">Masukkan Private Key </label>
  <textarea name="key" rows="10" class="border p-2 rounded font-mono text-xs" required
    placeholder="-----BEGIN PRIVATE KEY-----"></textarea>
  @error('key') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  <button class="bg-slate-800 text-white p-2 rounded">Buka Kunci</button>
</form></body></html>
