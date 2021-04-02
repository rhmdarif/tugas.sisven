<?php 
    if (isset($_POST['btnSubmit'])) {
        $r = $_POST['r'];
        $p = $_POST['p'];
        $c = $_POST['c'];
        $h = $_POST['h'];
        $n = $_POST['n'];
        $l = $_POST['l'];
        $time = $_POST['time'];

        if ($time == 'day') {
            $n = $n/7;
            $l = $l/7;
        }

        $q = sqrt((2*($c*$r))/$h);
        $f = $r/$q;
        $v = $q/$r;
        $tc = ($p*$r)+(($c*$r)/$q)+(($h*$q)/2);
        $b = ($r*$l)/$n;

        echo $b;
        
        $week = $v*52;
        $day = $week*7;

        $display = '<div class="mt-3">
            <hr>
            <h5 class="card-title">#2 Hasil</h5>

            <table class="table table-bordered">
                <tbody id="table">
                    <tr>
                        <td>
                            Jumlah pemesanan Ekonomis
                        </td>
                        <td>
                            '.$q.' unit
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Frequensi Pemesanan
                        </td>
                        <td>
                            '.$f.' kali pesan
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Interval Pemesanan
                        </td>
                        <td>
                            sekali '.$v.'th / '.$week.'minggu / '.$day.'hari
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Total Cost
                        </td>
                        <td>
                            '.$tc.',-
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Pemesanan Kembali
                        </td>
                        <td>
                            '.$b.' unit
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>';
    }
?>
<div class="card">
    <div class="card-header">
        Menghitung EOQ
    </div>
    <div class="card-body">
        <h5 class="card-title">#1 Masukan Transaksi</h5>
        <form method="post">
            
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        Jumlah barang dibutuhkan
                    </td>
                    <td colspan="2">
                        <input type="text" name="r" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Harga /pcs
                    </td>
                    <td colspan="2">
                        <input type="text" name="p" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Biaya /pesan
                    </td>
                    <td colspan="2">
                        <input type="text" name="c" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Biaya simpan /th
                    </td>
                    <td colspan="2">
                        <input type="text" name="h" class="form-control" >
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Lama Operasional
                    </td>
                    <td>
                        <input type="text" name="n" class="form-control" >
                    </td>
                    <td rowspan="2">
                        <select class="form-control" name="time" style="top: 40%;">
                            <option value="week" selected>Minggu</option>
                            <option value="day">Hari</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Tenggang Waktu 
                    </td>
                    <td>
                        <input type="text" name="l" class="form-control">
                    </td>
                </tr>
                
            </tbody>
        </table>
        
        <p class="card-text"><code>Catatan : Format Lama Operasional dan Tenggang Waktu harus sama.</code></p>
        <button type="submit" class="btn btn-primary pull-right mb-3" name="btnSubmit">Hitung</button>

        </form>

        <?php echo (isset($display))? $display : false; ?>
    </div>
</div> 