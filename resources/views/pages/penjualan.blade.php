@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penjualan</h1>
        {{-- <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Penjualan</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Penjualan / Pemesanan</a></div>
        </div> --}}
    </div>
    @php
        // $mbank_save = session('mbank_save'); 
        // $mbank_updt = session('mbank_updt');
        // $mbank_dlt = session('mbank_dlt');
    @endphp
    <form action="" method="POST" id="thisform">
        @csrf
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        @include('layouts.flash-message')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Header</h4>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Dokumen</label>
                                                @foreach($no_doc as $key => $code)
                                                @php $codedoc = $code->codedoc @endphp
                                                @endforeach
                                                <input type="text" readonly class="form-control" name="no_doc" id="no_doc" value="{{ $code->codedoc }}" >
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Dokumen</label>
                                                <input type="date" class="form-control" name="tgl_bon" value="{{ date("Y-m-d") }}">
                                            </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Ruangan</label>
                                                <select class="form-control select2" name="nama" id="nama">
                                                    <option disabled selected>--Pilih Ruangan--</option>
                                                    @foreach($room as $data => $item)                                        
                                                    <option>{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Terapis</label>
                                                <select class="form-control select2" id="nama_terapis">
                                                    <option disabled selected>--Pilih Terapis--</option>
                                                    @foreach($terapis as $data => $item)                                        
                                                    <option>{{ $item->nama_terapis }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card" style="border: 1px solid lightblue">
                            <div class="card-header">
                                <h4>Detail</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Jasa</label>
                                            <select class="form-control select2" id="nama_jasa">
                                                <option disabled selected>--Select Jasa--</option>
                                                @foreach($jasa as $data => $item)                                        
                                                <option>{{ $item->nama_jasa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" id="hrg_jual" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                   
                                        <div class="form-group">
                                            <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                                <div class="row px-2">
                                                    <div class="col-md-12">
                                                       <div class="row">
                                                            <div class="col-md-12">
                                            {{-- <div class="container"> --}}
                                                              <a href="" id="addItem">
                                                                 <button class="btn btn-primary mr-1"><i style="font-size:18pt" style="font-color:white" style="margin-top: 30px" style="margin-top: 650px"></i>Tambah</button>
                                                              </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>  
                                    </div>                          
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number_counter" value="0" hidden readonly>
                                    </div>
                                    <table class="table table-bordered" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="w-5" class="border border-5" style="text-align: center;">No</th>
                                                <th scope="col" class="w-30" class="border border-5" style="text-align: center;">Nama Ruangan</th>
                                                <th scope="col" class="w-30" class="border border-5" style="text-align: center;">Nama Terapis</th>
                                                <th scope="col" class="w-30" class="border border-5" style="text-align: center;">Nama Jasa</th>
                                                <th scope="col" class="w-20 "class="border border-5" style="text-align: center;">Qty</th>
                                                <th scope="col" class="w-20" class="border border-5" style="text-align: center;">Harga</th>
                                                <th scope="col" class="w-20" class="border border-5" style="text-align: center;">Total</th>
                                                <th scope="col" class="w-15" class="border border-5" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                    <div class="row px-2">
                                        <div class="col-md-12">
                                           <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Sub Total</label>
                                                        <input type="text" class="form-control" name="grandtot" id="grandtot" form="thisform" value="0" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>pajak</label>
                                                        <input type="text" class="form-control" name="grandtot" id="grandtot" form="thisform" value="0" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Grand Total</label>
                                                        <input type="text" class="form-control" name="grandtot" id="grandtot" form="thisform" value="0" readonly>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <div class="card-footer text-right">                            
                                <button class="btn btn-primary mr-1" type="submit" 
                                formaction="{{ route('penjualanpost') }}" id="confirm">Save</button>                                
                                <a class="btn btn-warning mr-1" href="/penjualanlist">List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@stop
@section('pluginjs')
<script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
@stop
@section('botscripts')
<script type="text/javascript">

    $(".alert button.close").click(function (e) {
        $(this).parent().fadeOut(2000);
    });

    function submitDel(id){
        $('#del-'+id).submit()
    }
    // $(document).on("click","#confirm",function(e){
    //     // Validate ifnull
    //     pemesan = $("#pemesan").prop('selectedIndex');
    //     nama = $("#nama").val();
    //     pengiriman = $("#pengiriman").prop('selectedIndex');
    //     alamat = $("#alamat").val();
    //     hp = $("#hp").val();
    //     if (pemesan == 0){
    //         swal('WARNING', 'Silahkan Pilih Pemesan!', 'warning');
    //         return false;
    //     }else if (nama == ""){
    //         swal('WARNING', 'Nama Tidak boleh kosong!', 'warning');
    //         return false;
    //     }else if (pengiriman == 0){
    //         swal('WARNING', 'Silahkan Pilih Pengiriman!', 'warning');
    //         return false;
    //     }else if (alamat == ""){
    //         swal('WARNING', 'Alamat Tidak boleh kosong!', 'warning');
    //         return false;
    //     }else if (hp == ""){
    //         swal('WARNING', 'Phone Tidak boleh kosong!', 'warning');
    //         return false;
    //     }
    // });

    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {  
            rowCount = $('#number_counter').val();

            $("#nama_jasa").on('select2:select', function(e) {
                var nama_jasa = $(this).val();
                console.log(nama_jasa);
                show_loading()
                $.ajax({
                    url: '{{ route('getjasa') }}', 
                    method: 'post', 
                    data: {'nama_jasa': nama_jasa}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        // console.log(nama_kartu);
                        console.log(response);
                        for (i=0; i < response.length; i++) {
                            if(response[i].nama_jasa == nama_jasa){
                                // $("#hrg_jual").val(thousands_separators(response[i].hrgjual).toFixed(2));
                                hrg_jual = Number(response[i].hrg_jual);
                                $("#hrg_jual").val(thousands_separators(hrg_jual.toFixed(0)));
                            }
                        }
                        hide_loading()
                    }
                });
            });

            $("#nama_terapis").on('select2:select', function(e) {
                var nama_terapis = $(this).val();
                console.log(nama_terapis);
                show_loading()
                $.ajax({
                    url: '{{ route('getterapis') }}', 
                    method: 'post', 
                    data: {'nama_terapis': nama_terapis}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        // console.log(nama_pemesan);
                        console.log(response);
                        for (i=0; i < response.length; i++) {
                            if(response[i].nama_terapis == nama_terapis){
                                // $("#hrg_jual").val(thousands_separators(response[i].hrgjual).toFixed(2));
                            }
                        }
                        hide_loading()
                    }
                });
            });
            
            $("#nama").on('select2:select', function(e) {
                var nama = $(this).val();
                console.log(nama);
                show_loading()
                $.ajax({
                    url: '{{ route('getroom') }}', 
                    method: 'post', 
                    data: {'nama': nama}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        // console.log(nama_pemesan);
                        console.log(response);
                        for (i=0; i < response.length; i++) {
                            if(response[i].nama == nama){
                                // $("#hrg_jual").val(thousands_separators(response[i].hrgjual).toFixed(2));
                            }
                        }
                        hide_loading()
                    }
                });
            });
            $(document).on("click", "#addItem", function(e) {
                e.preventDefault();
                if($('#quantity').val() == 0){
                    alert('Quantity tidak boleh 0');
                    return false;
                }

                nama_jasa = $("#select2-nama_jasa-container").text();
                hrg_jual = $("#hrg_jual").val();
                total = $("#grandtot").val();
                counter = rowCount;
                
                if(counter == 1){
                    if (/\D/g.test(hrg_jual))
                    {
                        // Filter comma
                        hrg_jual = hrgjual.replace(/\,/g,"");
                        hrg_jual = Number(Math.trunc(hrg_jual))
                    }
                    
                    total_old = $('#grandtot').val();
                    if (/\D/g.test(total_old))
                    {
                        // Filter comma
                        total_old = total_old.replace(/\,/g,"");
                        total_old = Number(Math.trunc(total_old))
                    }
                    
                    total = Number(hrg_jual) + Number(total_old)
                    
                    rowCount++;

                    // $("#total").val(total );
                    $("#grandtot").val(thousands_separators(total.toFixed(0)));

                }else{
                    console.log("masuk");
                    if (/\D/g.test(hrg_jual))
                    {
                        // Filter comma
                        hrg_jual = hrg_jual.replace(/\,/g,"");
                        hrg_jual = Number(Math.trunc(hrg_jual))
                    }
                    if (/\D/g.test(total))
                    {
                        // Filter comma
                        total = total.replace(/\,/g,"");
                        total = Number(Math.trunc(total))
                    }
                    console.log("hrg_jual : "+hrg_jual);
                    console.log("total : "+total);
                    sum = Number(hrg_jual) + Number(total);
                    
                    // $("#total").val(sum);
                    $("#grandtot").val(thousands_separators(sum.toFixed(0)));
                    rowCount++;
                }
                qty = 1;
                total = Number(hrg_jual) * qty;
                tablerow = "<tr row_id="+ rowCount +" id='row_"+rowCount+"'><th style='readonly:true;' class='border border-5'>" + rowCount + "</th><td class='border border-5' style='display:none;'><input style='width:fill;' readonly form='thisform' class='numberclass form-control' type='text' value='" + rowCount + "'></td><td class='border border-5'><input style='width:100%;' readonly form='thisform' class='namaclass form-control' name='nama_d[]' type='text' value='${nama}'></td><td><input style='width:100%;' readonly form='thisform' class='nama_terapisclass form-control' name='nama_terapis_d[]' type='text' value='${nama_terapis}'></td><td><input style='width:100%;' readonly form='thisform' class='nama_jasaclass form-control' name='nama_jasa_d[]' type='text' value='${nama_jasa}'></td><td class='border border-5'><input style='width:fill;' form='thisform' class='row_qty qtyclass form-control' name='qty_d[]' id='qty_d_"+ rowCount +"' type='text' value='" + qty + "'></td><td class='border border-5'><input style='width:fill;' readonly form='thisform' class='hrg_jualclass form-control' name='hrg_jual_d[]' id='hrg_jual_d_"+ rowCount +"' type='text' value='" + thousands_separators(hrg_jual.toFixed(0)) + "'></td><td class='border border-5'><input style='width:fill;' readonly form='thisform' class='totalclass form-control' name='total_d[]' id='total_d_"+ rowCount +"' type='text' value='" + thousands_separators(total.toFixed(0)) + "'></td><td class='border border-5'><a title='Delete' class='delete'><i style='font-size:15pt;color:#6777ef;' class='fa fa-trash'></i></a></td></tr>";
                
                $("#datatable tbody").append(tablerow);

                console.log(rowCount);
                $('#number_counter').val(rowCount);
                $('#nama').val('');
                $('#nama_terapis').val('');
                $("#nama_jasa").prop('selectedIndex', 0).trigger('change');
                $("#hrg_jual").val(0);
            });

            $(document).on("click", ".delete", function(e) {
                e.preventDefault();
                var r = confirm("Delete Transaksi ?");
                if (r == true) {
                    counter_id = $(this).closest('tr').find('.numberclass').val();
                    console.log("counter id : "+counter_id);

                    
                    subtot = $("#total_d_"+ counter_id).val().replaceAll(",", "");
                    qty_row = $("#qty_d_"+ counter_id).val();

                    if (/\D/g.test(subtot))
                    {
                        // Filter comma
                        subtot = subtot.replace(/\,/g,"");
                        subtot = Number(Math.trunc(subtot))
                    }

                    old_grandtot = $("#grandtot").val();

                    if (/\D/g.test(old_grandtot))
                    {
                        // Filter comma
                        old_grandtot = old_grandtot.replace(/\,/g,"");
                        old_grandtot = Number(Math.trunc(old_grandtot))
                    }
                    new_grantot = old_grandtot - subtot

                    $("#grandtot").val(thousands_separators(new_grantot.toFixed(0)));
                    $(this).closest('tr').remove();

                    var table   = document.getElementById('datatable');
                    for (var i = 1; i < table.rows.length; i++) 
                    {
                    var firstCol = table.rows[i].cells[0];
                    firstCol.innerText = i;
                    }
                    rowCount--;
                } else {
                    return false;
                }
            });

            $(document).on('keyup', '.row_qty', function(event) {
                event.preventDefault(); 
                if (/\D/g.test(this.value)){
                    // Filter non-digits from input value.
                    this.value = this.value.replace(/\D/g, '');
                }
            });

            $(document).on('focusout', '.row_qty', function(event) {
                event.preventDefault();

                console.log("focus out");
                // INITIAL VARIABLE
                var tbl_row = $(this).closest('tr');
                var row_id = tbl_row.attr('row_id');

                this_row_subtot = $('#total_d_'+row_id).val();
                if (/\D/g.test(this_row_subtot))
                {
                    // Filter comma
                    this_row_subtot = this_row_subtot.replace(/\,/g,"");
                    this_row_subtot = Number(Math.trunc(this_row_subtot))
                }

                old_subtot = this_row_subtot;
                this_row_qty = $(this).val();

                this_row_hrg = $('#hrg_jual_d_'+row_id).val();
                if (/\D/g.test(this_row_hrg))
                {
                    // Filter comma
                    this_row_hrg = this_row_hrg.replace(/\,/g,"");
                    this_row_hrg = Number(Math.trunc(this_row_hrg))
                }
                 old_grandtot = $('#grandtot').val();
                if (/\D/g.test(old_grandtot))
                {
                    // Filter comma
                    old_grandtot = old_grandtot.replace(/\,/g,"");
                    old_grandtot = Number(Math.trunc(old_grandtot))
                }
                // INITIAL VARIABLE END

                this_row_sum = this_row_hrg * this_row_qty; 

                $('#total_d_'+row_id).val(thousands_separators(this_row_sum.toFixed(0)));
                
                normalize_grandtot = old_grandtot - old_subtot ;
                new_grandtot = this_row_sum + normalize_grandtot
                $('#grandtot').val(thousands_separators(new_grandtot.toFixed(0)))
            })	
        });
</script>
@endsection