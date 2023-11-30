 @extends('template.app')
 @section('title','Edit Produk')
 @section('main-content')

 <?php 
    if(!function_exists('fetch_image')) {
        /** 
         * function fetch all image product
         * @param kd_product
         */
        function fetch_image($kd_product) {
            $data = DB::table('product')->whereRaw('kd_product = ? ', [$kd_product])->first();
            $image = explode(' ', $data->gambar);
            return $image;
        }
    }
 ?>
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Edit Data Product</h1>
 </div>

 <div class="row">
     <div class="col-8">
         <div class="card">
             <div class="card-header">
                 <h5>Update Data</h5>
             </div>
             <div class="card-body">
                 <form action="/product/{{ $product->kd_product }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('PATCH')
                     <div class="mb-3">
                         <label for="kd_product" class="form-label">Kode Produk</label>
                         <input type="hidden" value="{{ $product->kd_product }}" name="kd_product">
                         <input type="text" class="form-control" value="{{ $product->kd_product }}" id="kd_product"
                             disabled>
                     </div>
                     <div class="mb-3">
                         <label for="category">Kategori</label>
                         <select class="form-select @error('category') is-invalid @enderror"
                             aria-label="Default select example" id="category" name="category">
                             @foreach($categorys as $data)
                             <option value="{{ $data->id_category }}"
                                 {{ $product->id_category == $data->id_category ? 'selected' : '' }}>
                                 {{ $data->nama_category }}
                             </option>
                             @endforeach
                         </select>
                         @error('category')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="product" class="form-label">Produk Name</label>
                         <input type="text" class="form-control @error('product') is-invalid @enderror" id="product"
                             name="product" value="{{ $product->nama_product }}">
                         @error('product')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="qty_product">Quantity Produk</label>
                         <input type="number" class="form-control @error('qty_product') is-invalid @enderror" min="1"
                             name="qty_product" id="qty_product" value="{{ $product->qty_product }}">
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
                             name="deskripsi" style="height: 100px;">{{ $product->deskripsi }}</textarea>
                         @error('deskripsi')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="berat_product">Berat Produk</label>
                         <input type="number" class="form-control @error('berat_product') is-invalid @enderror"
                             name="berat_product" id="berat_product" min="1" value="{{ $product->berat_product }}">
                         @error('berat_product')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="warna">Warna</label>
                         <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna"
                             id="warna" value="{{ $product->warna }}">
                         @error('warna')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="harga">Harga</label>
                         <input type="number" class="form-control @error('harga') is-invalid  @enderror" name="harga"
                             id="harga" value="{{ $product->harga }}">
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
                         @foreach(fetch_image($product->kd_product) as $image)
                         <div class="d-inline-block mt-3">
                             <img src="{{ url('gambar/product') }}/{{ $image }}" style="width: 40px; height: 40px;">
                             <a href="/delete/image/product/{{ $image }}">
                                 <img src="{{ url('assets/icon/fa-times.svg') }}">
                             </a>
                         </div>
                         @endforeach
                     </div>
                     <div class="mb-3">
                         <label for="ukuran">Ukuran</label>
                         <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran"
                             name="ukuran" value="{{ $product->ukuran_product }}">
                         @error('ukuran')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>

                     <button type="submit" class="btn btn-primary">Update</button>
                     <a href="/product" class="btn btn-secondary">Batal</a>
                 </form>
             </div>
         </div>
     </div>
 </div>


 @endsection