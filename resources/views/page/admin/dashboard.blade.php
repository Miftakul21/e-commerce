 @extends('template.app')
 @section('title','dashboard-admin')

 @section('main-content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
 </div>

 <!-- Content Row -->
 <div class="row">
     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                             Product</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product }}</div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-calendar fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-success shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                             Category</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product }}</div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-info shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                             Pesanan</div>
                         <div class="row  align-items-center">
                             <div class="col-auto">
                                 <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pesanan }}</div>
                             </div>
                         </div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Pending Requests Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-warning shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                             Pending Requests</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-comments fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-8">
         <div class="card">
             <div class="card-header bg-primary text-white">
                 Data Transaksi Bulanan
             </div>
             <div class="card-body">
                 Line Chart
             </div>
         </div>
     </div>
     <div class="col-4 ">
         <div class="card">
             <div class="card-header bg-primary text-white">
                 Product Terlaris
             </div>
             <div class="card-body">
                 Pie Chart
             </div>
         </div>
     </div>
 </div>

 @endsection