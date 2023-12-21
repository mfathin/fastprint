<!-- Modal Edit Produk Yang Sudah di@include di halaman produk.blade.php -->

{{-- Mendapatkan id_produk dari delete button di halaman produk.blade.php --}}
<div class="modal fade" id="deleteProduk{{ $rows->id_produk }}" tabindex="-1" aria-labelledby="deleteProdukLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteProdukLabel">Delete Produk</h1>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-danger">
                {{-- Mengirim Data Ke Route Dengan Nama Route produk.delete (Route telah didefinisikan di web.php) --}}
                <form action="{{ route('produk.delete', ['id_produk' => $rows->id_produk]) }}" method="POST"
                    class="text-white">
                    @csrf
                    {{-- Method DELETE Untuk Mengubah Data Sesuai --}}
                    @method('DELETE')
                    Anda Yakin Ingin Menghapus Data Dengan Nama Produk:
                    <strong>
                        {{ $rows->nama_produk }}
                    </strong>
                    ?
            </div>
            <div class="modal-footer">
                {{-- Tombol Submit Untuk Menghapus Data --}}
                <button class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>
