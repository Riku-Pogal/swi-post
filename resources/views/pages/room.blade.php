@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Kamar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Kamar</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Data Kamar / Pemesan</a></div>
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
                            <h4>Data Kamar / Pemesanan</h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>kode</label>
                                            <input type="text" class="form-control" name="kode" id="kode">
                                        </div>
                                        <div class="form-group">
                                            <label>Ruangan</label>
                                            <select class="form-control select2" name="nama" id="nama">
                                            <option disabled selected>--Select Room--</option>
                                            <option>Emerald</option>
                                            <option>Ruby</option>
                                            <option>Sapphire</option>
                                            <option>Diamond</option>
                                            </select>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Kapasitas</label>
                                            <select class="form-control select2" name="kapasitas" id="kapasitas">
                                                <option disabled selected>--Select Capacity--</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <select class="form-control select2" name="jenis" id="jenis">
                                                <option disabled selected>--Select Type--</option>
                                                <option>Standard Room</option>
                                                <option>Superior Room</option>
                                                <option>Deluxe Room</option>
                                                <option>Twin Room</option>
                                                <option>Single Room</option>
                                                <option>Double Room</option>
                                            </select>
                                        </div>
                                    </div>
                        </div>
                        <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="{{ route('roompost') }}" id="confirm">Save</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">kode</th></th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama Ruangan</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">kapasitas</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Jenis</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 0 @endphp
                                    @foreach($datas as $data => $item)
                                    @php $counter++ @endphp
                                    <tr>
                                        <th scope="row" class="border border-5" style="text-align: center;">{{ $counter }}</th>
                                        <td class="border border-5" style="text-align: center;">{{ $item->kode }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->nama }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->kapasitas }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->jenis }}</td>
                                        <td style="text-align: center;" class="d-flex justify-content-center">
                                            <a href="/room/{{ $item->id }}/edit"
                                                class="btn btn-icon icon-left btn-primary"><i class=" far fa-edit " > Edit</i></a>
                                            <form action="/room/delete/{{ $item->id }}" id="del-{{ $item->id }}"
                                                method="POST" class="px-2">
                                                @csrf
                                                <button class="btn btn-icon icon-left btn-danger "
                                                    id="del-{{ $item->id }}" type="submit"
                                                    data-confirm="WARNING!|Do you want to delete {{ $item->id }} data?"
                                                    data-confirm-yes="submitDel({{ $item->id }})"><i
                                                        class="fa fa-trash "> Delete</i></button>
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
        kode = $("#kode").val();
        nama = $("#nama").val();
        kapasitas = $("#kapasitas").val();
        jenis = $("#jenis").val();
        if (kode == ""){
            swal('WARNING', 'Kode Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama== ""){
            swal('WARNING', 'Nama Tidak boleh kosong!', 'warning');
            return false;
        }else if (kapasitas == ""){
            swal('WARNING', 'Kapasitas Tidak boleh kosong!', 'warning');
            return false;
        }else if (jenis == ""){
            swal('WARNING', 'Jenis Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection