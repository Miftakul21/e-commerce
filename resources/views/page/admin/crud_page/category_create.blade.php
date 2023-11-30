 @extends('template.app')
 @section('title','Tambah Kategori')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Tambah Data Kategori</h1>
 </div>

 <div class="row">
     <div class="col-8">
         <div class="card">
             <div class="card-header">
                 <h5>Tambah Data</h5>
             </div>
             <div class="card-body">
                 <form action="/category" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                         <label for="category" class="form-label">Kategori</label>
                         <input type="text" class="form-control @error('category') is-invalid @enderror" id="category"
                             name="category" value="{{ old('category') }}">
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
                     </div>
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a href="/category" class="btn btn-secondary">Batal</a>
                 </form>
             </div>
         </div>
     </div>
 </div>


 @endsection