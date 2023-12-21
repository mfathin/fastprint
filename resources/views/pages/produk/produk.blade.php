@extends('welcome')

@section('content')
    <div class="p-5">
        <!-- Add Produk Button Modal -->
        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addProduk">
            Tambah Produk
        </button>

        {{-- Fitur Search --}}
        <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
            <div class="relative flex rounded-md shadow-sm" style="height: 50px">
                <input type="text" id="hs-trailing-button-add-on-with-icon-and-button" name="search"
                    placeholder="Search Produk..." value="{{ $searchQuery }}" class="rounded" style="width: 100%">
                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                </div>
                <button type="submit" class="btn btn-primary bg-primary ms-2">Search</button>
            </div>
        </form>

        {{-- Return pesan dari ProdukController.php --}}
        @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show position-relative" role="alert">
                <strong>Berhasil!</strong> {{ session('msg') }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Return pesan error dari add_new.blade.php --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
                <strong>Gagal!</strong>
                Silahkan cek lagi data yang diinput!
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Return pesan dari ProdukController.php --}}
        @if (session('msgdel'))
            <div class="alert alert-success alert-dismissible fade show position-relative" role="alert">
                <strong>Berhasil!</strong> {{ session('msgdel') }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Return pesan dari ProdukController.php --}}
        @if (session('msgfail'))
            <div class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
                <strong>Gagal!</strong> {{ session('msgfail') }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table data produk yang diambil dari ProdukController.php (Fungsi Index) --}}
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
            </thead>

            <tbody>
                {{-- Untuk Memberi Nomor Kepada Produk --}}
                @php
                    $counter = ($produks->currentPage() - 1) * $produks->perPage() + 1;
                @endphp

                {{-- Menampilkan data produk yang diambil dari ProdukController.php --}}
                @if ($produks->isNotEmpty())
                    @foreach ($produks as $rows)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $rows->id_produk }}</td>
                            <td style="width: 500px">{{ $rows->nama_produk }}</td>
                            <td>
                                {{-- Mengubah format harga agar sesuai dengan tampilan yang diinginkan --}}
                                @php
                                    echo 'Rp' . number_format($rows['harga'], 0, ',', '.');
                                @endphp
                            </td>
                            <td>{{ $rows->kategori_id }}</td>
                            <td>{{ $rows->status_id }}</td>
                            <td>
                                {{-- Edit Button Modal --}}
                                {{-- Mengirim id_produk ke modal --}}
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editProduk{{ $rows->id_produk }}">
                                    <i class='fa fa-edit'></i> Edit
                                </button>

                                {{-- Delete Button Modal dan mengirim id_produk ke router yang akan dikirim ke fungsi destroy di ProdukController.php --}}
                                {{-- Mengirim id_produk ke modal --}}
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteProduk{{ $rows->id_produk }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        {{-- Memanggil parameter dan menambahkan $counter --}}
                        @php
                            $counter++;
                        @endphp
                    @endforeach

                    {{-- Jika Data Kosong --}}
                @else
                    <p>Produk Tidak Ditemukan</p>
                @endif
            </tbody>

        </table>
        {{-- Memanggil Fungsi Pagination --}}
        {{ $produks->links() }}

        {{-- Import Action Modal dan mengirim data ke halaman modal --}}
        @foreach ($produks as $rows)
            @include('pages.produk.add_produk')
            @include('pages.produk.edit_produk')
            @include('pages.produk.delete_produk')
        @endforeach
    </div>
@endsection
