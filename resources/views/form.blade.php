<form method="POST" action="{{ $action }}" class="grid gap-3">
  @csrf
  <input name="nama" placeholder="Nama" class="border p-2 rounded" required>
  <input name="hp" placeholder="No. HP" class="border p-2 rounded" required>
  <input name="alamat" placeholder="Alamat" class="border p-2 rounded" required>
  <select name="jenis" class="border p-2 rounded">
    <option>Zakat Fitrah</option><option>Zakat Mal</option><option>Infaq</option><option>Sedekah</option>
  </select>
  <input name="jumlah" type="number" placeholder="Jumlah (Rp)" class="border p-2 rounded" required>
  <input name="catatan" placeholder="Catatan (opsional)" class="border p-2 rounded">
  <button class="bg-emerald-600 text-white p-2 rounded">Kirim</button>
  @if ($errors->any()) <p class="text-red-600 text-sm">{{ $errors->first() }}</p> @endif
</form>
