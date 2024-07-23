@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Terapis Edit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Terapis</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Data Terapis</a></div>
        </div>
    </div>
    @php
        // $mbank_save = session('mbank_save');
        // $mbank_updt = session('mbank_updt');
        // $mbank_dlt = session('mbank_dlt');
    @endphp
    <div class="section-body">
    <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Terapis</h4>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode Terapis</label>
                                        <input type="number" class="form-control" name="tkode" id="tkode" value="{{ $terapis->tkode }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Terapis</label>
                                        <input type="text" class="form-control" name="nama_terapis" id="nama_terapis" value="{{ $terapis->nama_terapis }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input type="text" class="form-control" name="hp" id="hp" value="{{ $terapis->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" style="height:100px" name="alamat">{{ $terapis->alamat }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Ukuran</label>
                                        <input type="text" class="form-control" name="underwear" id="underwear">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="/terapis/{{ $terapis->id }}" id="confirm">Update</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                    </div>
                </div>
            </div>            
        </div>
    </form>
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
        tkode = $("#tkode").val();
        nama_terapis = $("#nama_terapis").val();
        hp = $("#hp").val();
        alamat = $("#alamat").val();
        underwear = $("#underwear").val();
        if (tkode== ""){
            swal('WARNING', 'Kode Terapis Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama_terapis == ""){
            swal('WARNING', 'Nama Terapis Tidak boleh kosong!', 'warning');
            return false;
        }else if (hp == ""){
            swal('WARNING', 'No HP Tidak boleh kosong!', 'warning');
            return false;
        }else if (alamat == ""){
            swal('WARNING', 'Alamat Tidak boleh kosong!', 'warning');
            return false;
        }else if (undrwear == ""){
            swal('WARNING', 'Ukuran Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection