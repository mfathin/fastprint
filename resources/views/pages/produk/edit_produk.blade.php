<!-- Modal Edit Produk Yang Sudah di@include di halaman produk.blade.php -->

{{-- Mendapatkan id_produk dari edit button di halaman produk.blade.php --}}
<div class="modal fade" id="editProduk{{ $rows->id_produk }}" tabindex="-1" aria-labelledby="editProdukLabel"
    aria-hidden="true">
    <div class="modal-dialog custom-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProdukLabel">Edit Produk</h1>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Mengirim Data Ke url produk/{id} (Url telah didefinisikan di route (web.php)) --}}
                <form action="{{ url('produk/' . $rows->id_produk) }}" method="POST">
                    @csrf
                    {{-- Method PATCH Untuk Mengubah Data Sesuai --}}
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col">

                            {{-- Nama Produk Edit Input --}}
                            <label for="txtnamaproduk" class="mb-2">Nama Produk</label>
                            <input type="text"
                                class="text-uppercase form-control form-control-sm 
                                @error('txtnamaproduk') is-invalid @enderror
                                "
                                id="txtnamaproduk" name="txtnamaproduk" value="{{ $rows->nama_produk }}"
                                style="height: 35px;">

                            {{-- Pesan Error Sesuai Dengan Request di Controller ProdukController.php --}}
                            @error('txtnamaproduk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Harga Produk Edit Input --}}
                        <div class="col">
                            <label for="txtharga" class="mb-2">Harga Produk *Rp</label>
                            <br>
                            <input type="text"
                                class="form-control form-control-sm @error('txtharga') is-invalid @enderror"
                                style="height: 35px" placeholder="contoh: 12500" id="txtharga" name="txtharga"
                                value="{{ $rows->harga }}">

                            {{-- Pesan Error Sesuai Dengan Request di Controller ProdukController.php --}}
                            @error('txtharga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        {{-- Kategori Produk Edit Input --}}
                        <div class="col">
                            <label for="txtkategori" class="mb-2">Kategori Produk</label>
                            <br>
                            <select name="txtkategori" id="txtkategori"
                                class="form-select form-select-sm @error('txtkategori') is-invalid @enderror"
                                style="height: 35px">
                                <option value="{{ $rows->kategori_id }}">{{ $rows->kategori_id }}</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}"
                                        {{ old('txtkategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Pesan Error Sesuai Dengan Request di Controller ProdukController.php --}}
                            @error('txtkategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- Status Produk Edit Input --}}
                        <div class="col">
                            <label for="txtstatus" class="mb-2">Status Produk</label>
                            <br>
                            <select name="txtstatus" id="status"
                                class="form-select form-select-sm @error('txtstatus') is-invalid @enderror"
                                style="height: 35px">
                                <option value="{{ $rows->status_id }}">{{ $rows->status_id }}</option>
                                @foreach ($statuss as $status)
                                    <option value="{{ $status->nama_status }}"
                                        {{ old('txtstatus') == $status->nama_status ? 'selected' : '' }}>
                                        {{ $status->nama_status }}</option>
                                @endforeach
                            </select>

                            {{-- Pesan Error Sesuai Dengan Request di Controller ProdukController.php --}}
                            @error('txtstatus')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {{-- Tombol Submit Untuk Memperbarui Data --}}
                <button class="btn btn-warning">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
