 @extends('template.app')
 @section('title','kategori')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
 </div>

 <div class="card">
     <div class="card-header d-flex justify-content-between align-items-center">
         <h5>Data Kategori</h5>
         <a href="/add-category" class="btn btn-primary">Add Data</a>
     </div>
     <div class="card-body">
         <table class="table table-bordered table-hover" id="table">
             <thead>
                 <tr>
                     <th scope="col">No</th>
                     <th scope="col">Kategori</th>
                     <th scope="col">Image</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($categorys as $data)
                 <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $data->nama_category }}</td>
                     <td>
                         @if($data->gambar != '' || $data->gambar != null)
                         <img src="{{ url('gambar/category') }}/{{ $data->gambar }}" style="width: 50px; height: 50px;">
                         @endif
                     </td>
                     <td>
                         <a href="/edit-category/{{ $data->id_category }}" class="btn btn-warning btn-md">Edit</a>

                         <a href="#" class="btn btn-danger btn-md" data-toggle="modal"
                             data-target="#deleteModal-{{ $data->id_category }}">Delete</a>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>


 <!-- Modal Delete Data Category -->
 @foreach($categorys as $data)
 <div class="modal fade" id="deleteModal-{{$data->id_category}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Delete Category </h5>
                 <h4 aria-hidden="true" data-dismiss="modal" aria-label="Close">&times;</h4>
             </div>
             <div class="modal-body">
                 Are You Sure Delete "{{ $data->nama_category }}"?
             </div>
             <div class="modal-footer">
                 <input type="hidden" id="id_category" value="{{ $data->id_category }}">
                 <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                 <form action="/category/{{ $data->id_category }}" method="POST" style="display-inline">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger">Delete</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 @endforeach

 @endsection