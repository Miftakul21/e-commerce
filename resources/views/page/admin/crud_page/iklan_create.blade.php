 @extends('template.app')
 @section('title','Add Iklan')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Add Data Iklan</h1>
 </div>

 <div class="row">
     <div class="col-8">
         <div class="card">
             <div class="card-header">
                 <h5>Add Data</h5>
             </div>
             <div class="card-body">
                 <form action="/iklan" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                         <label for="iklan" class="form-label">Iklan</label>
                         <input type="text" class="form-control @error('iklan') is-invalid @enderror" id="iklan"
                             name="iklan" value="{{ old('iklan') }}">
                         @error('iklan')
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
                     <a href="/iklan" class="btn btn-secondary">Batal</a>
                 </form>
             </div>
         </div>
     </div>
 </div>


 @endsection