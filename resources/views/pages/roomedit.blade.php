@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Ruangan Edit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Ruangan</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Data Ruangan / Pemesan</a></div>
        </div>
    </div>
    @php
        // $mbank_save = session('mbank_save');
        // $mbank_updt = session('mbank_updt');
        // $mbank_dlt = session('mbank_dlt');
    @endphp
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="row">        
            <div class="col-12 col-md-6 col-lg-6">
                <form action="" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Data kartu </h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode</label>
                                            <input type="text" class="form-control" name="kode" id="kode" value="{{ $room->kode }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Ruangan </label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $room->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label">kapasitas</label>
                                            <input type="option" class="form-control" name="kapasitas" id="kapasitas" value="{{ $room->kapasitas }}">
                                            </div>
                                                <div class="form-group">
                                                    <label>jenis</label>
                                                    <input type="text" class="form-control" name="jenis" id="jenis" value="{{ $room->jenis }}">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="/room/{{ $room->id }}" id="confirm">Update</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
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
    $('#datatable').DataTable({
        // "ordering":false,
        "bInfo" : false
    });

    $(".alert button.close").click(function (e) {
        $(this).parent().fadeOut(2000);
    });

    function submitDel(id){
        $('#del-'+id).submit()
    }
    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        kode = $("#kode").val();
        nama = $("#nama").val();
        kapasitas = $("#kapasitas").val();
        jenis = $("#jenis").val();
        if (kode == ""){
            swal('WARNING', 'Kode Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama == ""){
            swal('WARNING', 'Nama Ruangan Tidak boleh kosong!', 'warning');
            return false;
        }else if (kapasitas == ""){
            swal('WARNING', 'kapasitas Tidak boleh kosong!', 'warning');
            return false;
        }else if (jenis == ""){
            swal('WARNING', 'jenis Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection