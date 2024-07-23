@extends('layouts.main')
@section('topscripts')
<style>
    .row .justify-content-between{
        padding-bottom : 10px;
        padding-top : 10px;
    }
</style>
@stop
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengeluaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengeluaran</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Pengeluaran</a></div>
        </div>
    </div>
    @php
        $tpos_save = session('tpos_save');
    @endphp
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
                <form action="" method="POST" id="thisform">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Header Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">                    
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal_1" value="@php if(request('dtto')==NULL){ echo date('Y-m-d');} else{ echo $_GET['dtto']; } @endphp">
                                    </div>                      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pemilik</label>
                                        <input type="text" class="form-control" name="nama_pemilik">
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label>Nama Toko</label>
                                        <select class="form-control select2" id="nama_toko" name="nama_toko">
                                            <option disabled selected>--Select Toko--</option> 
                                            <option>IHSAN</option>
                                            <option>ROMLI</option>
                                            <option>UDIN</option>
                                            <option>Rafiq</option>
                                        </select>
                                    </div>                                
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" name="harga">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">                    
                                    <div class="form-group">
                                        <a class="btn btn-warning mr-1" href="/pengeluaranlist">List</a>
                                        <button class="btn btn-primary mr-1" id="confirm" type="submit" onclick="show_loading()" formaction="{{ route('pengeluaranpost') }}">Simpan</button>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop
@section('botscripts')
<script type="text/javascript">
    $(document).ready(function() {
        //CSRF TOKEN
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('.select2').select2({});

        });

        $('#datatable').DataTable({
        // "ordering":false,
        "bInfo" : false,
        // "bPaginate": false,
        // "searching": false
        });
    })
</script>
@endsection
