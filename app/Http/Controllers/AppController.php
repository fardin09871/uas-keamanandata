<?php
namespace App\Http\Controllers;

use App\Models\Donation;
use App\Support\Crypto;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home() { return view('home'); }

    public function store(Request $r)
    {
        $d = $r->validate([
            'nama'    => 'required|max:100',
            'hp'      => 'required|max:20',
            'alamat'  => 'required|max:255',
            'jenis'   => 'required|in:Zakat Fitrah,Zakat Mal,Infaq,Sedekah',
            'jumlah'  => 'required|numeric|min:1000',
            'catatan' => 'nullable|max:255',
        ]);
        Donation::create(Crypto::enc($d));
        return back()->with('ok', 'Data berhasil dikirim (terenkripsi). Jazakumullah khairan.');
    }

    public function login(Request $r)
    {
        $key = str_replace("\r", '', trim((string) $r->input('key')));
        if (!Crypto::keyMatches($key)) return back()->withErrors(['key' => 'Private key tidak valid.']);
        session(['priv' => $key]);
        return redirect('/admin');
    }

    public function dashboard()
    {
        $priv = session('priv');
        $rows = Donation::latest()->get()->map(fn ($x) => [
            'id' => $x->id, 'd' => Crypto::dec($x, $priv),
            'raw' => substr($x->data, 0, 40) . '...',
        ]);
        $total = $rows->sum(fn ($x) => $x['d']['jumlah'] ?? 0);
        return view('admin', compact('rows', 'total'));
    }

    public function destroy($id) { Donation::destroy($id); return back(); }

    public function logout() { session()->forget('priv'); return redirect('/'); }
}
