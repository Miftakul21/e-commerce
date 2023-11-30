 @extends('template.app')
 @section('title','Edit Kategori')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Edit Data Kategori</h1>
 </div>

 <div class="row">
     <div class="col-8">
         <div class="card">
             <div class="card-header">
                 <h5>Update Data</h5>
             </div>
             <div class="card-body">
                 <form action="/category/{{ $category->id_category }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('PATCH')
                     <div class="mb-3">
                         <label for="category" class="form-label">Kategori</label>
                         <input type="text" class="form-control @error('category') is-invalid @enderror" id="category"
                             name="category" value="{{ old('category', $category->nama_category) }}">
                         @error('category')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label for="image" class="form-label">Image</label>
                         <input type="file" class="form-control @error('image') is-invalid @enderror" id="gambar"
                             name="image">
                         <small>Format image: png, svg. Max: 1 Mb</small>
                         @error('image')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                         @enderror

                         @if($category->gambar != '' || $category->gambar != null)
                         <div class="container-image d-flex align-items-center" style=" gap: 5px; margin-top: 10px;">
                             <img src=" {{ url('gambar/category/') }}/{{ $category->gambar }}"
                                 style="width: 40px; height: 40px;">
                             <a href="/delete/image/category/{{ $category->id_category }}">
                                 <img src="{{ url('assets/icon/fa-times.svg') }}">
                             </a>
                         </div>
                         @endif

                     </div>
                     <button type="submit" class="btn btn-primary">Update</button>
                     <a href="/category" class="btn btn-secondary">Batal</a>
                 </form>
             </div>
         </div>
     </div>
 </div>


 @endsection