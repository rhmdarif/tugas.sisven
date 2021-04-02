<div class="card">
    <div class="card-header">
        Menghitung Persediaan Akhir
    </div>
    <div class="card-body">
        <h5 class="card-title">#1 Masukan Transaksi</h5>
        
        <button type="button" class="btn btn-primary btn-block mb-2" onclick="myCreateFunction()"> <i class="fa fa-plus"></i> Tambah Bagian </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Ketentuan</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Harga</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="table">
                <tr>
                    <td>
                        <input type="date" name="tanggal[]" class="form-control datepicker">
                    </td>
                    <td>
                        <input type="text" name="ketentuan[]" class="form-control" id="inputCity">
                    </td>
                    <td>
                        <input type="text" name="kuantitas[]" class="form-control" id="inputCity">
                    </td>
                    <td>
                        <input type="text" name="harga[]" class="form-control" id="inputCity">
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="card-text"><code>Catatan : Hanya masukan data barang masuk.</code></p>
        <a href="#" class="btn btn-primary pull-right mb-3" id="hitung">Hitung</a>

        <div id="display2" style="display:none">
            <hr>
            <h5 class="card-title">#2 Masukan Jumlah akhir Barang</h5>
            Total Barang : <span id="totalbarang">0</span>

            <div class="form-group mt-3 mb-2">
                <label for="exampleInputEmail1">Jumlah akhir Barang</label>
                <input type="number" class="form-control" min="0" id="nilai_akhir">
            </div>

            <div class="d-flex justify-content-around mb-3">
                <a href="#" class="btn btn-primary pull-right" id="fifo">FiFo</a>
                <a href="#" class="btn btn-primary pull-right" id="lifo">LiFo</a>
                <a href="#" class="btn btn-primary pull-right" id="average">Average</a>
            </div>
        </div>

        <div id="display3" style="display:none">
            <hr>
            <h5 class="card-title">#3 Nilai Akhir dari <span id="metode"></span></h5>
            <h4 id="nilaiakhir"></h4>
        </div>
    </div>
</div>
<script>
    var tanggal, ketentuan, kuantitas, harga = [];
    var totalbarang;
    function myCreateFunction() {
        var table = document.getElementById("table");
        var rowCount = table.rows.length;
        var row = table.insertRow();
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        var cell4 = row.insertCell(4);

        cell0.innerHTML = '<input type="date" name="tanggal[]" class="form-control">';
        cell1.innerHTML = '<input type="text" name="ketentuan[]" class="form-control" id="inputCity">';
        cell2.innerHTML = '<input type="text" name="kuantitas[]" class="form-control" id="inputCity">';
        cell3.innerHTML = '<input type="text" name="harga[]" class="form-control" id="inputCity">';
        cell4.innerHTML = '<button type="button" class="btn btn-primary btn-block mb-2" onclick="delRow('+rowCount+')"> <i class="fa fa-minus"></i></button>';
    }

    function delRow(id) {
        document.getElementById("table").deleteRow(id);
    }

    function hitungFIFO(tanggal, kuantitas, harga, sisa) {
        var n = [];
        for (let n = 1; n <= tanggal.length; n++) {
            var i = tanggal.length-n;
            console.log('angka'+i);
            console.log('angka'+tanggal[i]);
        }
    }

    $('#hitung').on('click', function() {
        $('#display2').show();
         tanggal = $('input[name^=tanggal]').map(function(idx, elem) {
                        return $(elem).val();
                    }).get();
         ketentuan = $('input[name^=ketentuan]').map(function(idx, elem) {
                        return $(elem).val();
                    }).get();
         kuantitas = $('input[name^=kuantitas]').map(function(idx, elem) {
                        return Number($(elem).val());
                    }).get();
         harga = $('input[name^=harga]').map(function(idx, elem) {
                        return $(elem).val();
                    }).get();

        totalbarang = kuantitas.reduce((a, b) => a + b, 0);
        $('#totalbarang').text(totalbarang)
    });

    $('#fifo').click(function() {
        var nilai = Number($('#nilai_akhir').val());

        var totalnilai = 0; 
        var totalharga = 0;
        for (let n = 1; n <= kuantitas.length; n++) {
            
            var i = kuantitas.length-n;
            //var i = n-1;
            var sisa = 0;

            console.log('Kuantitas '+i+' : '+kuantitas[i]);

            if(kuantitas[i] > nilai) {
                sisa = kuantitas[i]-nilai;
                nilai = 0;
            } else {
                nilai = nilai-kuantitas[i];
                sisa = 0; 
            }
            sisa = kuantitas[i]-sisa;

            totalnilai += sisa;
            totalharga += sisa*harga[i];
            
            console.log('Nilai '+i+' : '+nilai);
            console.log('Sisa '+i+' : '+sisa);
            console.log('----------------------');
        }

        console.log('----------------------');
        console.log('Total Nilai : '+totalnilai);
        console.log('Total Harga : '+totalharga);
        console.log('----------------------');

        $('#display3').show();
        $('#metode').text('FIFO');
        $('#nilaiakhir').text(totalharga);

    });
    $('#lifo').click(function() {
        var nilai = Number($('#nilai_akhir').val());

        var totalnilai = 0; 
        var totalharga = 0;
        for (let n = 1; n <= kuantitas.length; n++) {
            
            var i=n-1;
            var sisa = 0;

            console.log('Kuantitas '+i+' : '+kuantitas[i]);

            if(kuantitas[i] > nilai) {
                sisa = kuantitas[i]-nilai;
                nilai = 0;
            } else {
                nilai = nilai-kuantitas[i];
                sisa = 0; 
            }
            sisa = kuantitas[i]-sisa;

            totalnilai += sisa;
            totalharga += sisa*harga[i];
            
            console.log('Nilai '+i+' : '+nilai);
            console.log('Sisa '+i+' : '+sisa);
            console.log('----------------------');
        }

        console.log('----------------------');
        console.log('Total Nilai : '+totalnilai);
        console.log('Total Harga : '+totalharga);
        console.log('----------------------');

        $('#display3').show();
        $('#metode').text('LIFO');
        $('#nilaiakhir').text(totalharga);

    });

    $('#average').click(function() {
        var nilai = Number($('#nilai_akhir').val());
        var totalharga = 0;
        for (let n = 0; n < kuantitas.length; n++) {
            totalharga += kuantitas[n]*harga[n];
        }

        console.log('----------------------');
        console.log('Total Nilai : '+totalharga);
        console.log('Total Harga : '+totalbarang);
        console.log('----------------------');

        var perbrg = totalharga/totalbarang;
        var hitung = perbrg*nilai;

        console.log('Brg : '+perbrg);
        console.log('Total Harga : '+hitung);
        console.log('----------------------');

        $('#display3').show();
        $('#metode').text('AVERAGE');
        $('#nilaiakhir').text(Math.round(hitung));

    });
</script>