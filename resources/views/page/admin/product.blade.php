 @extends('template.app')
 @section('title','produk')
 @section('main-content')

 <?php 
if(!function_exists('fetch_image') || !function_exists('category')) {
    /**
     * function fetch all image product
     * @param kd_product
     */
    function fetch_image($kd_product) {
        $data = DB::table('product')->whereRaw('kd_product = ? ', [$kd_product])->first();
        $image = explode(' ', $data->gambar);
        return $image;
    }

    /**
     * function fetch category product
     * @param kd_product
     */
    function category($kd_product) {
        $data = DB::table('product as a')
                ->select('b.nama_category')
                ->join('category as b', 'a.id_category', '=', 'b.id_category')
                ->whereRaw('a.kd_product = ?', [$kd_product])
                ->get();
                
        return $data[0]->nama_category;
    }
}
?>
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Product</h1>
 </div>

 <div class="card">
     <div class="card-header d-flex justify-content-between align-items-center">
         <h5>Data Produk</h5>
         <a href="/add-product" class="btn btn-primary">Add Data</a>
     </div>
     <div class="card-body table-responsive">
         <table class="table table-bordered table-hover" id="table">
             <thead>
                 <tr>
                     <th scope="col">No</th>
                     <th scope="col">Kategori</th>
                     <th scope="col">Produk</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Deskripsi</th>
                     <th scope="col">Berat Produk</th>
                     <th scope="col">Warna</th>
                     <th scope="col">Harga</th>
                     <th scope="col">Image</th>
                     <th scope="col">Ukuran</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($products as $data)
                 <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ category($data->kd_product) }}</td>
                     <td>{{ $data->nama_product }}</td>
                     <td>{{ $data->qty_product }}</td>
                     <td>{{ $data->deskripsi }}</td>
                     <td>{{ $data->berat_product }}</td>
                     <td>{{ $data->warna }}</td>
                     <td>{{ $data->harga }}</td>
                     <td style="display: flex; gap: 5px; ">
                         @foreach(fetch_image($data->kd_product) as $image)
                         <img src="{{ url('gambar/product') }}/{{ $image }}" style="width:50px; height:50px;">
                         @endforeach
                     </td>
                     <td>{{ $data->ukuran_product }}</td>
                     <td>
                         <a href="/edit-product/{{ $data->kd_product }}" class="btn btn-warning btn-md">Edit</a>
                         <a href="#" class="btn btn-danger btn-md" id="hapus" data-kd="{{ $data->kd_product }}"
                             data-product="{{ $data->nama_product }}" data-toggle="modal"
                             data-target="#deleteModal">Delete</a>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>

 <div class="modal fade" id="deleteModal" aria-hidden=" true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Delete Product </h5>
                 <h4 aria-hidden="true" data-dismiss="modal" aria-label="Close">&times;</h4>
             </div>
             <div class="modal-body">

             </div>
             <div class="modal-footer">
                 <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                 <form action="" id="form" method="POST" style="display-inline">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger">Delete</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 @endsection
 <!-- Bootstrap core JavaScript (Jquery 3.6.0) -->
 <script src="{{ url('assets/templates/js/jquery.min.js') }}">
 </script>
 <script>
$(document).ready(function() {
    $('#table').on('click', '#hapus', function() {
        const kd = $(this).data('kd');
        const product = $(this).data('product');

        $('.modal-body').html(`Are You Sure Delete "${product}"? ${kd}`);
        $('#form').attr('action', `/product/${kd}`);

    })

})
 </script>