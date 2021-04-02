<div class="card">
    <div class="card-header">
        Menghitung Probabilitas 
    </div>
    <div class="card-body">
        <h5 class="card-title">#1 Masukan Transaksi</h5>
        
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        Harga beli satuan
                    </td>
                    <td colspan="2">
                        <input type="text" id="beli" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Harga jual satuan
                    </td>
                    <td colspan="2">
                        <input type="text" id="jual" class="form-control" >
                    </td>
                </tr>
                
            </tbody>
        </table>

        <button type="button" class="btn btn-primary btn-block mb-2" onclick="myCreateFunction()"> <i class="fa fa-plus"></i> Tambah Bagian </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Permintaan</th>
                    <th scope="col">Frequensi</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="table">
                <tr>
                    <td>
                        <input type="text" name="permintaan[]" class="form-control" id="inputCity">
                    </td>
                    <td>
                        <input type="text" name="frequensi[]" class="form-control" id="inputCity">
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="card-text"><code>Catatan : Hanya berlaku untuk jumlah permintaan dan pemesanan yang sama.</code></p>
        <a href="#" class="btn btn-primary pull-right mb-3" id="langkah_1">Hitung Probabilitas Permintaan</a>

        <div id="display2" class="mt-3" style="display:none">
            <hr>
            <h5 class="card-title">#2 Probabilitas Pelanggan</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Permintaan</th>
                        <th scope="col">Frequensi</th>
                        <th scope="col">Probabilitas</th>
                    </tr>
                </thead>
                <tbody id="permintaan_pel">
                </tbody>
            </table>
        </div>

        <div id="display3" class="mt-3" style="display:none">
            <hr>
            <h5 class="card-title">#3 Laba</h5>
            <table class="table table-bordered text-center">
                <thead id="laba_head">
                    <tr>
                        <th scope="col" rowspan="2">Pemesanan<br>
                                                    (Liter)</th>
                        <th scope="col" colspan="2" id="col_laba">Permintaan</th>
                    </tr>
                    <tr>
                        <th scope="col">1</th>
                        <th scope="col">2</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="display4" class="mt-3" style="display:none">
            <hr>
            <h5 class="card-title">#4 Laba yang diharapkan</h5>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Pemesanan</th>
                        <th scope="col">Laba diperoleh</th>
                    </tr>
                </thead>
                <tbody id="laba_diharapkan">
                </tbody>
            </table>

            Pesanan terbaik adalah <h6 id="pesanan_terbaik"></h6>
        </div>
    </div>
</div>
<script>
    function myCreateFunction() {
        var table = document.getElementById("table");
        var rowCount = table.rows.length;
        var row = table.insertRow();

        console.log(rowCount);

        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);

        cell0.innerHTML = '<input type="text" name="permintaan[]" class="form-control" id="inputCity">';
        cell1.innerHTML = '<input type="text" name="frequensi[]" class="form-control" id="inputCity">';
        cell2.innerHTML = '<button type="button" class="btn btn-primary btn-block mb-2" onclick="delRow('+rowCount+')"> <i class="fa fa-minus"></i></button>';
    }

    function delRow(id) {
        document.getElementById("table").deleteRow(id);
    }

    var permintaan = [];
    var pemesanan = [];
    var frequensi = [];
    var prob_permintaan = [];
    var laba = [];
    var beli,jual;
    $('#langkah_1').click(function() {
        
        beli = $('#beli').val();
        jual = $('#jual').val();

        permintaan = $('input[name^=permintaan]').map(function(idx, elem) {
                        return Number($(elem).val());
                    }).get();

        frequensi = $('input[name^=frequensi]').map(function(idx, elem) {
                        return Number($(elem).val());
                    }).get();
        
        var total_freq = frequensi.reduce((a, b) => a + b, 0);
        console.log(total_freq);

        for (let i = 0; i < frequensi.length; i++) {
            prob_permintaan[i] = frequensi[i]/total_freq;

            
            
            var table = document.getElementById("permintaan_pel");
            var rowCount = table.rows.length;
            var row = table.insertRow();
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);

            cell0.innerHTML = permintaan[i];
            cell1.innerHTML = frequensi[i];
            cell2.innerHTML = prob_permintaan[i];

        }
        $('#display2').show();


        // HEAD TABEL LABA
        var thead_laba = document.getElementById("laba_head");
        thead_laba.deleteRow(1);
        var row1 = thead_laba.insertRow();
        
        for (let n = 0; n < permintaan.length; n++) {            
            var cells = row1.insertCell(n);
            cells.innerHTML = permintaan[n];

            pemesanan[n] = permintaan[n];
            console.log(permintaan[n]);
        }
        $('#col_laba').attr('colspan', permintaan.length);
        // END HEAD TABEEL LABA

        // Hitung Laba
        var tbody_laba = document.getElementById("laba_head");
        for (let ii = 0; ii < pemesanan.length; ii++) {
            var row_laba = tbody_laba.insertRow();

            row_laba.insertCell(0).innerHTML = pemesanan[ii];

            console.log('=============================================');
            var ll = [];
            for (let nn = 0; nn < permintaan.length; nn++) {
                //laba[ii].push(permintaan[nn]);
                console.log('-----------------');
                console.log('Data ke : '+nn);
                console.log('-----------------');
                console.log(permintaan[nn]);
                console.log(jual);
                console.log('-----------------');

                console.log(pemesanan[ii]);
                console.log(beli);
                console.log('-----------------');

                var htg_laba = (permintaan[nn]*jual)-(pemesanan[ii]*beli);
                console.log(htg_laba);

                if(nn > ii) {
                    ll[nn] = ll[nn-1];
                } else {
                    ll[nn] = htg_laba;
                }

                row_laba.insertCell(nn+1).innerHTML = ll[nn];
            }
            console.log('=============================================');
            laba[ii] = ll;
        }

        console.log(laba);
        $('#display4').show();
        var laba_harapan = [];
        var tbody_harapan = document.getElementById("laba_diharapkan");
        for (let l = 0; l < pemesanan.length; l++) {
            var row_diharapkan = tbody_harapan.insertRow();

            row_diharapkan.insertCell(0).innerHTML = pemesanan[l];
            //row_diharapkan.insertCell(1).innerHTML = 
            var p = 0;
            for (let li = 0; li < prob_permintaan.length; li++) {
                p += prob_permintaan[li]*laba[l][li];
            }
            laba_harapan[l] = p;
            row_diharapkan.insertCell(1).innerHTML = p;
        }

        var tinggi = 0;
        for (let lii = 0; lii < laba_harapan.length; lii++) {
            if(tinggi < laba_harapan[lii]) {
                tinggi = laba_harapan[lii];
            }
        }

        $('#pesanan_terbaik').text(tinggi);
    });
</script>