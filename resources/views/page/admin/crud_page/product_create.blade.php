 @extends('template.app')
 @section('title','Tambah Produk')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Tambah Data Product</h1>
 </div>

 <div class="row">
     <div class="col-8">
         <div class="card">
             <div class="card-header">
                 <h5>Tambah Data</h5>
             </div>
             <div class="card-body">
                 <form action="/product" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                         <label for="kd_product" class="form-label">Kode Product</label>
                         <input type="hidden" value="{{ $kode }}" name="kd_product">
                         <input type="text" class="form-control" value="{{ $kode }}" id="kd_product" disabled>
                     </div>
                     <div class="mb-3">
                         <label for="category">Kategori</label>
                         <select class="form-select @error('category') is-invalid @enderror"
                             aria-label="Default select example" id="category" name="category">
                             <option value="" selected>Select Category</option>
                             @foreach($categorys as $data)
                             <option value="{{ $data->id_category }}">{{ $data->nama_category }}</option>
                             @endforeach
                         </select>
                         @error('category')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="product" class="form-label">Nama Produk</label>
                         <input type="text" class="form-control @error('product') is-invalid @enderror" id="product"
                             name="product" value="{{ old('product') }}">
                         @error('product')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="qty_product">Quantity Produk</label>
                         <input type="number" class="form-control @error('qty_product') is-invalid @enderror" min="1"
                             name="qty_product" id="qty_product" value="{{ old(1,'qty_product') }}">
                         @error('qty_product')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="deskripsi">Deskripsi</label>
                         <textarea name="deskripsi" id="deskripsi"
                             class="form-control @error('deskripsi') is-invalid @enderror" value="" id="deskripsi"
                             name="deskripsi" style="height: 100px;">{{ old('deskripsi') }}</textarea>
                         @error('deskripsi')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="berat_product">Berat Product</label>
                         <input type="number" class="form-control @error('berat_product') is-invalid @enderror"
                             name="berat_product" id="berat_product" min="1" value="{{ old(1,'berat_product') }}">
                         @error('berat_product')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="warna">Warna</label>
                         <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna"
                             id="warna" value="{{ old('warna') }}">
                         <small class="form-text">Warna: Red Blue Orange.</small>
                         @error('warna')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="harga">Harga</label>
                         <input type="number" class="form-control @error('harga') is-invalid  @enderror" name="harga"
                             id="harga" value="{{ old('harga') }}">
                         @error('harga')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="image" class="form-label">Image</label>
                         <input type="file" class="form-control @error('image.*') is-invalid @enderror" id="gambar"
                             name="image[]" multiple>
                         <small class="form-text">Format image: jpg, png, svg. Max: 1 Mb</small>
                         @error('image.*')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label for="ukuran" class="form-label">Ukuran</label>
                         <input type="text" name="ukuran" class="form-control @error('ukuran') is-invalid @enderror"
                             id="ukuran">
                         <small class="form-text">Size: M L XL XLL / Big High.</small>
                         @error('ukuran')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a href="/product" class="btn btn-secondary">Batal</a>
                 </form>
             </div>
         </div>
     </div>
 </div>


 @endsection