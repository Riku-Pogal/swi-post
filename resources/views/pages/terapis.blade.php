@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Terapis</h1>
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
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
            </div>
        </div>
        <form action="" method="POST">
            @csrf
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
                                            <input type="number" class="form-control" name="tkode" id="tkode">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Terapis</label>
                                            <input type="text" class="form-control" name="nama_terapis" id="nama_terapis">
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea type="text" class="form-control" style="height: 140px; width: 390px" name="alamat" id="alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>No.HP</label>
                                            <input type="text" class="form-control" name="hp" id="hp">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ukuran</label>
                                            <input type="text" class="form-control" name="underwear" id="underwear">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-right">                            
                                <button class="btn btn-primary mr-1" type="submit" 
                                formaction="{{ route('terapispost') }}" id="confirm">Save</button>                                
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        </form>          
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Kode Terapis</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama Terapis</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Alamat</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">No HP</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Ukuran</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 0 @endphp
                                    @foreach($datas as $data => $item)
                                    @php $counter++ @endphp
                                    <tr>
                                        <th scope="row" class="border border-5" style="text-align: center;">{{ $counter }}</th>
                                        <td class="border border-5" style="text-align: center;">{{ $item->tkode }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->nama_terapis }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->alamat }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->phone }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->underwear}}</td>
                                        <td style="text-align: center;" class="d-flex justify-content-center">
                                            <a href="/terapis/{{ $item->id }}/edit"
                                                class="btn btn-icon icon-left btn-primary"><i class="far fa-edit">
                                                    Edit</i></a>
                                            <form action="/terapis/delete/{{ $item->id }}" id="del-{{ $item->id }}"
                                                method="POST" class="px-2">
                                                @csrf
                                                <button class="btn btn-icon icon-left btn-danger"
                                                    id="del-/{{ $item->id }}" type="submit"
                                                    data-confirm="WARNING!|Do you want to delete {{ $item->nama_terapis }} data?"
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

    function submitDel(id){
        $('form#del-'+id).submit()
    }
    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        tkode = $("#tkode").val();
        nama_terapis = $("#nama_terapis").val();
        hp = $("#hp").val();
        alamat = $("#alamat").val();
        underwear = $("#underwear").val();
        if (tkode == ""){
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
        }else if (underwear == ""){
            swal('WARNING', 'Ukuran Tidaj Boleh Kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection