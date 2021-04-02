<style>
    .card-title {
        font-weight: bold;
    }
 </style>
<div class="card">
    <div class="card-header">
        Menghitung Persediaan Akhir
    </div>
    <div class="card-body">
        <h5 class="card-title">#1 Masukan Transaksi</h5>
        
        <table class="table table-bordered">
            <tbody id="table">
                <tr>
                    <td>
                        Jumlah barang dibutuhkan
                    </td>
                    <td colspan="2">
                        <input type="text" id="r" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Harga yang ditawarkan (0)
                    </td>
                    <td colspan="2">
                        <input type="text" id="p0" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Harga yang ditawarkan (1)
                    </td>
                    <td colspan="2">
                        <input type="text" id="p1" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Batas Pembelian
                    </td>
                    <td colspan="2">
                        <input type="text" id="bts" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Biaya Pesan
                    </td>
                    <td colspan="2">
                        <input type="text" id="c" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Biaya Simpan
                    </td>
                    <td>
                        <input type="text" id="t" class="form-control" >
                    </td>
                    <td>
                        <h4> % </h4>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <a href="#" class="btn btn-primary pull-right mb-3" id="hitung">Hitung</a>

        <div id="display2" class="mt-3" style="display:none">
            <hr>
            <h5 class="card-title">#2 Hasil</h5>
            <h6 class="card-title">#2.1 Mencari Q Benar/Tepat</h6>
                Q <small>(P0 = <span id="r_p0"></span>)</small> = <span id="r_q0"></span> (<small id="ket_0"></small>) <br>
                Q <small>(P1 = <span id="r_p1"></span>)</small> = <span id="r_q1"></span> (<small id="ket_1"></small>) <br><br>

            <h6 class="card-title">#2.2 Membandingkan Total Cost</h6>
            <span id="keterangan"></span>    
            <table class="table table-bordered">
                <tbody id="table">
                    <tr>
                        <td>
                            Total Cost (Q = <span class="r_q0"></span>)
                        </td>
                        <td>
                            <span id="r_tc0"></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Total Cost (Q = <span class="r_q1"></span>)
                        </td>
                        <td>
                            <span id="r_tc1"></span>
                        </td>
                    </tr>
                    
                </tbody>
            </table>

            <h6 class="card-title">#2.3 Penawaran Yang Diambil</h6>
            Berdasarkan Perbandingan diatas, maka penawaran <span id="q_"></span> dengan harga Rp. <span id="p_"></span> diterima.
        </div>
    </div>
</div>
<script>

    $('#hitung').on('click', function() {
        var r = Number($('#r').val());
        var p0 = Number($('#p0').val());
        var p1 = Number($('#p1').val());
        var c = Number($('#c').val());
        var bts = Number($('#bts').val());
        var t = Number($('#t').val())/100;
        var ts = $('#ts').val();

        console.log(p0);
        console.log(p1);        
        console.log(t);  
        console.log('Batas 1 -------------');      

        // Langkah 1
        var q0 = Math.ceil(Math.sqrt((((2*c)*r)/(p0*t))));        
        var q1 = Math.ceil(Math.sqrt((((2*c)*r)/(p1*t))));
        
        $('#r_p0').text(p0);
        $('#r_p1').text(p1);

        $('#r_q0').text(q0);
        $('#r_q1').text(q1);

        var p = [];
        if(q0 <= bts) {
            p[0] = true;
            $('#ket_0').text('tepat');
        } else {
            q0 = bts;
            p[0] = false;
            $('#ket_0').text('tidak tepat');
        }

        if(q1 >= bts) {
            p[1] = true;
            $('#ket_1').text('tepat');
        } else {
            p[1] = false;
            q1 = bts;
            $('#ket_1').text('tidak tepat');
        }

        if(p[0] == true && p[1] == false) {
            $('#keterangan').text('Karena Q yang tepat ada 1 yaitu Q='+q0+' pada harga Rp. '+p0+',- maka diambil Q='+bts+' sebagai Q minimal pada harga Rp. '+p1+',- sebagai pembanding.');
        } else if(p[0] == false && p[1] == true) {
            $('#keterangan').text('Karena Q yang tepat ada 1 yaitu Q='+q1+' pada harga Rp. '+p1+',- maka diambil Q='+bts+' sebagai Q maximal pada harga Rp. '+p0+',- sebagai pembanding.');
        }
        
        // Langkah 2
        var tc0 = Math.ceil((p0*r)+((c*r)/q0)+(((p0*t)*q0)/2));

        var q_, p_;
        
        var tc1 = Math.ceil((p1*r)+((c*r)/q1)+(((p1*t)*q1)/2));
        
        if(tc0 < tc1) {
            q_ = q0;
            p_ = p0;
        } else {
            q_ = q1;
            p_ = p1;
        }

        console.log(q0);
        console.log(q1);
        console.log(p);
        console.log(tc0);
        console.log(tc1);
        console.log('Batas 2 -------------');  

        $('#display2').show();

        $('.r_q0').text(q0);
        $('.r_q1').text(q1);
        $('#r_tc0').text(tc0);
        $('#r_tc1').text(tc1);
        $('#q_').text(q_);
        $('#p_').text(p_);

    });
</script>