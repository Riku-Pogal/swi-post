@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Jasa Edit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Jasa</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Jasa</a></div>
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
                            <h4>Jasa  </h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Jasa</label>
                                            <input type="text" class="form-control" name="kode_jasa" id="kode_jasa" value="{{ $jasa->kode_jasa }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jasa</label>
                                            <input type="text" class="form-control" name="nama_jasa" id="nama_jasa" value="{{ $jasa->nama_jasa }}">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" name="hrg_jual" id="hrg_jual" value="{{ number_format($jasa->hrg_jual, 0, '.', ',') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="/jasa/{{ $jasa->id }}" id="confirm">Update</button>                                
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

    // VALIDATE TRIGGER
    $("#hrg_jual").keyup(function(e){
        if (/\D/g.test(this.value)){
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
    function submitDel(id){
        $('#del-'+id).submit()
    }

    $(document).on("click", "#hrg_jual", function(e) {
        if (/\D/g.test(this.value)){
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
        }
    });

    $(document).on("change", "#hrg_jual", function(e) {
        if($('#hrg_jual').val() == ''){
            $('#hrg_jual').val(0);
        }
        $(this).val(thousands_separators($(this).val()));
    });

    $(document).on('focusout', '#hrg_jual', function(event) 
    {
        event.preventDefault();
        $(this).val(thousands_separators($(this).val()));
    })

    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        kode_jasa = $("#kode_jasa").val();
        nama_jasa = $("#nama_jasa").val();
        hrg_jual = $("#hrg_jual").val();
        if (kode_jasa == ""){
            swal('WARNING', 'Kode Jasa Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama_jasa == ""){
            swal('WARNING', 'Nama Jasa Tidak boleh kosong!', 'warning');
            return false;
        }else if (hrg_jual == ""){
            swal('WARNING', 'Harga Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection