@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Stock</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Tambah Stock</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Tambah Stock</a></div>
        </div>
    </div>
    @php
        // $mbank_save = session('mbank_save');
        // $mbank_updt = session('mbank_updt');
        // $mbank_dlt = session('mbank_dlt');
    @endphp
    <form action="" method="POST" id="thisform">
        @csrf
            <div class="section-body">
                <div class="col">
                    <div class="col-12 col-md-12 col-lg-12">
                        @include('layouts.flash-message')
                    </div>
                </div>
                <div class="col">
                    <div class="col-6 col-sm-6 col-lg-6">
                        <div class="card" style="border: 1px solid lightblue">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Stock</h4>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Stock</label>
                                                @foreach($nobons as $key => $code)
                                                @php $codebon = $code->codebon @endphp
                                                @endforeach
                                                <input type="text" readonly class="form-control" name="no_stock" id="no_stock" value="{{ $code->codebon }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Stock</label>
                                                <input type="date" class="form-control" name="tgl_stock" value="{{ date("Y-m-d") }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>  
                </div>
                    <div class="col-6 col-sm-6 col-lg-6">
                        <div class="card" style="border: 1px solid lightblue">
                            <div class="card-header">
                                <h4>add item</h4></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Kartu</label>
                                            <select class="form-control select2" id="nama_kartu">
                                                <option disabled selected>--Select Barang--</option>
                                                @foreach($barangs as $data => $item)                                        
                                                <option>{{ $item->nama_kartu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" id="quantity" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" id="satuan">
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                        </div>       
            
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card" style="border: 1px solid lightblue">
                        <div class="card-header">
                    <h4>lokasi</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama pemesan</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label>alamat</label>
                                <select class="form-control select2" name="alamat" id="alamat">
                                    <option disabled selected>--Alamat--</option>
                                    <option>Jakarta Barat</option>
                                    <option>Jakarta Selatan</option>
                                    <option>Jakarta Utara</option>
                                </select>
                        </div>
                        <div class="col-md-6">                                
                            <div class="form-group">
                                <label>telp</label>
                                <input type="text" class="form-control" id="telp">
                            </div>
                            <div class="form-group">
                                <a href="" id="addItem">
                                    <i class="fa fa-plus" style="font-size:18pt"></i>
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
<div class="row justify-content-end">
    <div class="col-6 col-md-6 col-lg-9">
{{-- <div class="table-responsive"> --}}
    <div class="form-group">
        <input type="text" class="form-control" id="number_counter" value="0" hidden readonly>
            </div>
                <table class="table table-bordered" id="datatable">
                    <thead>
                         <tr>
                            <th scope="col" class="border border-4" style="text-align: center;">No</th>
                            <th scope="col" class="border border-4" style="text-align: center;">Nama</th>
                            <th scope="col" class="border border-4" style="text-align: center;">Qty</th>
                            <th scope="col" class="border border-4" style="text-align: center;">Satuan</th>
                            <th scope="col" class="border border-4" style="text-align: center;">Action</th>
                        </tr>
                            </thead>
                                <tbody>
                            </tbody>
                        </table>
                    {{-- </div> --}}
                </div>
            </div>
                    <div class="card-footer text-right">                            
                        <button class="btn btn-primary mr-1" type="submit" 
                        formaction="{{ route('stockpost') }}" id="confirm">Save</button>                                
                        <button class="btn btn-secondary" type="reset">Cancel</button>
                        <a class="btn btn-warning mr-1" href="/stocklist">List</a>
                    </div>
                </>
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

            $("#nama_kartu").on('select2:select', function(e) {
                var nama_kartu = $(this).val();
                console.log(nama_kartu);
                show_loading()
                $.ajax({
                    url: '{{ route('getcard') }}', 
                    method: 'post', 
                    data: {'nama_kartu': nama_kartu}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        // console.log(nama_brg);
                        console.log(response);
                        for (i=0; i < response.length; i++) {
                            if(response[i].nama_kartu == nama_kartu){
                                $("#satuan").val(response[i].satuan);
                            }
                        }
                        hide_loading()
                    }
                });
            });

            $("#pemesan").on('select2:select', function(e) {
                var nama_pemesan = $(this).val();
                console.log(nama_pemesan);
                show_loading()
                $.ajax({
                    url: '{{ route('getcustomer') }}', 
                    method: 'post', 
                    data: {'nama_pemesan': nama_pemesan}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        // console.log(nama_pemesan);
                        console.log(response);
                        for (i=0; i < response.length; i++) {
                            if(response[i].nama_pemesan == nama_pemesan){
                                $("#hp").val(response[i].phone);
                                $("#nama").val(response[i].nama_penerima);
                                $("#alamat").val(response[i].alamat);
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

                nama_kartu = $("#select2-nama_kartu-container").text();
                hrg_jual = $("#hrg_jual").val();
                satuan = $("#satuan").val();
                total = $("#grandtot").val();
                qty = $("#quantity").val();
                counter = rowCount;

                rowCount++;
                tablerow = "<tr row_id="+ rowCount +" id='row_"+rowCount+"'><th style='readonly:true;' class='border border-5'>" + rowCount + "</th><td class='border border-5'><input style='width:fill;' readonly form='thisform' class='namakartuclass form-control' name='nama_kartu_d[]' type='text' value='" + nama_kartu + "'></td><td class='border border-5'><input style='width:fill;' form='thisform' class='row_qty qtyclass form-control' name='qty_d[]' id='qty_d_"+ rowCount +"' type='text' value='" + qty + "'></td><td class='border border-5'><input style='width:fill;' readonly form='thisform' class='satuanclass form-control' name='satuan_d[]' type='text' value='" + satuan + "'></td><td class='border border-5'><a title='Delete' class='delete'><i style='font-size:15pt;color:#6777ef;' class='fa fa-trash'></i></a></td></tr>";
                
                $("#datatable tbody").append(tablerow);

                console.log(rowCount);
                $('#number_counter').val(rowCount);

                $("#nama_kartu").prop('selectedIndex', 0).trigger('change');
                $("#quantity").val(0);
                $("#satuan").val('');
            });

            $(document).on("click", ".delete", function(e) {
                e.preventDefault();
                var r = confirm("Delete Transaksi ?");
                if (r == true) {
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

            $(document).on('keyup', '#quantity', function(event) {
                event.preventDefault(); 
                if (/\D/g.test(this.value)){
                    // Filter non-digits from input value.
                    this.value = this.value.replace(/\D/g, '');
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

                this_row_hrg = $('#hrgjual_d_'+row_id).val();
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