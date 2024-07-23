@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Jasa</h1>
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
                            <h4>Jasa</h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Jasa</label>
                                            <input type="text" class="form-control" name="kode_jasa" id="kode_jasa">
                                        </div>
                                        <div class="col-mid-6">
                                            <div class ="form-group">
                                                <label>Nama Jasa</label>
                                               <input type="text" class="form-control" name="nama_jasa" id="nama_jasa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" name="hrg_jual" id="hrg_jual">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Catatan</label>
                                                <textarea type="text" class="form-control" style="width: 400px, length: 400px" name="detail" id="detail"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="{{ route('jasapost') }}" id="confirm">Save</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Kode Jasa</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama Jasa</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Harga</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Detail</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 0 @endphp
                                    @foreach($datas as $data => $item)
                                    @php $counter++ @endphp
                                    <tr>
                                        <th scope="row" class="border border-5" style="text-align: center;">{{ $counter }}</th>
                                        <td class="border border-5" style="text-align: center;">{{ $item->kode_jasa }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->nama_jasa }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ number_format($item->hrg_jual, 2, '.', ',') }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->detail }}</td>
                                        <td style="text-align: center;" class="d-flex justify-content-center">
                                            <a href="/jasa/{{ $item->id }}/edit"
                                                class="btn btn-icon icon-left btn-primary"><i class="far fa-edit">
                                                    Edit</i></a>
                                            <form action="/jasa/delete/{{ $item->id }}" id="del-{{ $item->id }}"
                                                method="POST" class="px-2">
                                                @csrf
                                                <button class="btn btn-icon icon-left btn-danger"
                                                    id="del-{{ $item->id }}" type="submit"
                                                    data-confirm="WARNING!|Do you want to delete {{ $item->nama_jasa }} data?"
                                                    data-confirm-yes="submitDel({{ $item->id }})"><i
                                                        class="fa fa-trash">
                                                        Delete</i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        kode_jasa = $("#kode_jasa").val();
        nama_jasa = $("#nama_jasa").val();
        hrg_jual = $("#hrg_jual").val();
        if (kode_jasa == ""){
            swal('WARNING', 'Kode Jasa Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama_jasa== ""){
            swal('WARNING', 'Nama Jasa Tidak boleh kosong!', 'warning');
            return false;
        }else if (hrg_jual == ""){
            swal('WARNING', 'Harga Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection