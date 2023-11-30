 @extends('template.app')
 @section('title','iklan')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Iklan</h1>
 </div>

 <div class="card">
     <div class="card-header d-flex justify-content-between align-items-center">
         <h5>Data Iklan</h5>
         <a href="/add-iklan" class="btn btn-primary">Add Data</a>
     </div>
     <div class="card-body">
         <table class="table table-bordered table-hover" id="table">
             <thead>
                 <tr>
                     <th scope="col">No</th>
                     <th scope="col">Nama Iklan</th>
                     <th scope="col">Image</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($iklans as $data)
                 <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $data->nama_iklan }}</td>
                     <td>
                         @if($data->gambar != '' || $data != null)
                         <img src="{{ url('gambar/iklan') }}/{{ $data->gambar }}" style="width: 50px; height: 50px;">
                         @endif
                     </td>
                     <td>
                         <a href="/edit-iklan/{{ $data->id_iklan }}" class="btn btn-warning btn-md">Edit</a>
                         <a href="javascript:void(0)" class="btn btn-danger btn-md" data-toggle="modal"
                             data-target="#deleteModal-{{ $data->id_iklan }}">Delete</a>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>

 <!-- Modal Delete Data Iklan -->
 @foreach($iklans as $data)
 <div class="modal fade" id="deleteModal-{{$data->id_iklan}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Delete Iklan </h5>
                 <h4 aria-hidden="true" data-dismiss="modal" aria-label="Close">&times;</h4>
             </div>
             <div class="modal-body">
                 Are You Sure Delete "{{ $data->nama_iklan }}"?
             </div>
             <div class="modal-footer">
                 <input type="hidden" id="id_iklan" value="{{ $data->id_iklan }}">
                 <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                 <form action="/iklan/{{ $data->id_iklan }}" method="POST" style="display-inline">
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