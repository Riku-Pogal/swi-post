@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pemasukan List</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Pemasukan List</a></div>
        </div>
    </div>
    @php
        $mbank_save = session('mbank_save');
        $mbank_updt = session('mbank_updt');
        $mbank_dlt = session('mbank_dlt');
    @endphp
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
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
                                        <th scope="col" class="border border-5" style="text-align: center;">Tanggal 1</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Tanggal 2</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama Toko</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Harga</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">catatann</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 0 @endphp
                                    @foreach($pemasukans as $data => $item)
                                    @php $counter++ @endphp
                                    <tr>
                                        <th scope="row" class="border border-5" style="text-align: center;">{{ $counter }}</th>
                                        <td class="border border-5" style="text-align: center;">{{ date("Y-m-d", strtotime($item->tgl_1)) }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ date("Y-m-d", strtotime($item->tgl_2)) }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->nama_toko }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ number_format($item->harga, 0, '.', ',') }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->catatan }}</td>
                                        <td style="text-align: center;" class="d-flex justify-content-center">
                                            <a href="/pemasukan/{{ $item->id }}/edit"
                                                class="btn btn-icon icon-left btn-primary"><i class="far fa-edit">
                                                    Edit</i>
                                            </a>
                                            <form action="/pemasukan/delete/{{ $item->id }}" id="del-{{ $item->id }}"
                                                method="POST" class="px-2">
                                                @csrf
                                                <button class="btn btn-icon icon-left btn-danger"
                                                    id="del-{{ $item->id }}" type="submit"
                                                    data-confirm="WARNING!|Do you want to delete {{ $item->no }} data?"
                                                    data-confirm-yes="submitDel({{ $item->id }})"><i
                                                        class="fa fa-trash">
                                                        Delete</i>
                                                </button>
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
        $('#del-'+id).submit()
    }
    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        kode = $("#kode").val();
        nama = $("#nama").val();
        if (kode == ""){
            swal('WARNING', 'Kode Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama == 0){
            swal('WARNING', 'Nama Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection