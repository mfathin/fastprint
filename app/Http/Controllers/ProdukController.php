<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan data produk ke halaman
    public function index()
    {
        // Fitur Search Produk
        $searchQuery = request('search');

        $produks = Produk::query();

        if ($searchQuery) {
            $produks->where('nama_produk', 'like', '%' . $searchQuery . '%');
        }

        // Menampilkan data produk yang hanya berstatus 'bisa dijual'
        $produks = $produks->where('status_id', 'bisa dijual')->paginate(10);

        // Mengirim data untuk memuat data yang akan ditampilkan di pilihan saat menambah atau mengubah data
        $kategoris = Kategori::all();
        $statuss = Status::all();

        return view('pages.produk.produk', compact('produks', 'kategoris', 'statuss', 'searchQuery'));
    }

    // Menyimpan data ke table Produk sesuai dengan ketentuan validasi dari StoreProdukRequest.php
    public function store(StoreProdukRequest $request)
    {
        // Membuat id produk agar tetap terintegrasi (tidak melompat setelah ada data yang dihapus)
        $lastId = Produk::max('id_produk');
        $newId = $lastId ? $lastId + 1 : 1;

        // Menyimpan data ke dalam table Produk
        $produks = new Produk();
        $produks->id_produk = $newId;

        // Membuat data yang dikirim ke dalam database menjadi huruf kapital
        $produks->nama_produk = strtoupper($request->txtnamaproduk);

        // ...
        $produks->harga = $request->txtharga;
        $produks->kategori_id = $request->txtkategori;
        $produks->status_id = $request->txtstatus;

        // dd($produks);

        // Menyimpan data ke dalam table produk
        if ($produks->save()) {
            return redirect('/')->with('msg', 'Berhasil Menambahkan Produk!');
        } else {
            return redirect('/')->with('msgfail', 'Gagal Menambahkan Produk!');
        }
    }

    // Mengubah data dan data yang diubah akan dikirim ke database (table produk) sesuai dengan ketentuan validasi dari StoreProdukRequest.php
    // Mengambil id_produk dari halaman edit_produk.blade.php
    public function update(UpdateProdukRequest $request, Produk $produk, $id_produk)
    {
        // Mengambil id produk agar data yang disimpan sesuai dengan data yang ingin diubah
        $data = $produk->find($id_produk);

        // Membuat data yang dikirim ke dalam database menjadi huruf kapital
        $data->nama_produk = strtoupper($request->txtnamaproduk);

        // ...
        $data->harga = $request->txtharga;
        $data->kategori_id = $request->txtkategori;
        $data->status_id = $request->txtstatus;

        // dd($data);

        // Menyimpan data yang sudah diubah
        if ($data->save()) {
            // Mengirim pesan sesuai dengan respon ke halaman '/'
            return redirect('/')->with('msg', 'Data Dengan Nama Produk ' . $data->nama_produk . ' Berhasil Diubah!');
        } else {
            // Mengirim pesan sesuai dengan respon ke halaman '/'
            return redirect('/')->with('msgfail', 'Gagal Menambahkan Produk!');
        }
    }

    // Menghapus data
    // Mengambil id_produk dari halaman delete_produk.blade.php
    public function destroy(Produk $produk, $id_produk)
    {
        // Mengambil id produk agar data yang disimpan sesuai dengan data yang ingin dihapus
        $data = $produk->find($id_produk);

        // Menghapus data
        $data->delete();

        // dd($data);

        // Mengirim pesan sesuai dengan respon ke halaman '/'
        return redirect('/')->with('msgdel', 'Data dengan nama produk ' . $data->nama_produk . ', Berhasil Dihapus');
    }
}
