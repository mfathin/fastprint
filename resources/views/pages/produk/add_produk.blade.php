<!-- Modal Tambah Produk Yang Sudah di@include di halaman produk.blade.php -->
<div class="modal fade" id="addProduk" tabindex="-1" aria-labelledby="addProdukLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProdukLabel">Tambah Produk</h1>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- Form Tambah Produk Yang Akan Menjalankan route('produk.store') --}}
                <form action="{{ route('produk.store') }}" method="POST" id="addProdukForm">
                    @csrf
                    <div class="row mb-3">

                        {{-- Nama Produk Input --}}
                        <div class="col">
                            <label for="txtnamaproduk" class="mb-2">Nama Produk</label>
                            <input type="text"
                                class="text-uppercase form-control form-control-sm 
                                @error('txtnamaproduk') is-invalid @enderror
                                "
                                id="txtnamaproduk" name="txtnamaproduk" value="{{ old('txtnamaproduk') }}"
                                style="height: 35px;">
                            @error('txtnamaproduk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Harga Produk Input --}}
                        <div class="col">
                            <label for="txtharga" class="mb-2">Harga Produk *Rp</label>
                            <br>
                            <input type="text"
                                class="form-control form-control-sm @error('txtharga') is-invalid @enderror"
                                style="height: 35px" placeholder="contoh: 12500" id="txtharga" name="txtharga"
                                value="{{ old('txtharga') }}">
                            @error('txtharga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        {{-- Kategori Produk Input --}}
                        <div class="col">
                            <label for="txtkategori" class="mb-2">Kategori Produk</label>
                            <br>
                            <select name="txtkategori" id="txtkategori"
                                class="form-select form-select-sm @error('txtkategori') is-invalid @enderror"
                                style="height: 35px">
                                <option value="">-Pilih Kategori-</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}"
                                        {{ old('txtkategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('txtkategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Status Produk Input --}}
                        <div class="col">
                            <label for="txtstatus" class="mb-2">Status Produk</label>
                            <br>
                            <select name="txtstatus" id="status"
                                class="form-select form-select-sm @error('txtstatus') is-invalid @enderror"
                                style="height: 35px">
                                <option value="" selected>-Pilih Status-</option>
                                @foreach ($statuss as $status)
                                    <option value="{{ $status->nama_status }}"
                                        {{ old('txtstatus') == $status->nama_status ? 'selected' : '' }}>
                                        {{ $status->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('txtstatus')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {{-- Tombol Submit Untuk Menyimpan Data --}}
                <button class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
