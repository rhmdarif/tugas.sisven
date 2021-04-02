<?php 
    define('BASE_URL', 'http://localhost/sisven-php/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
    
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        
        <div class="my-0 mr-md-auto  navbar-brand">
            <img src="https://cdn4.iconfinder.com/data/icons/project-management-3-8/65/133-512.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Sistem Inventory
        </div>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="<?php echo BASE_URL; ?>">Beranda</a>
            <a class="p-2 text-dark" href="<?php echo BASE_URL; ?>?hal=persediaan-akhir">Persediaan Akhir</a>
            <a class="p-2 text-dark" href="<?php echo BASE_URL; ?>?hal=eoq">EOQ</a>
            <a class="p-2 text-dark" href="<?php echo BASE_URL; ?>?hal=probabilitas">Probabilitas</a>
            <a class="p-2 text-dark" href="<?php echo BASE_URL; ?>?hal=quantity-disc">Quantity Discount</a>
            <a class="p-2 text-dark" href="<?php echo BASE_URL; ?>?hal=backorder">Backorder</a>
        </nav>
    </div>


    <main role="main" class="container">
        <?php 
            $listpage = ['persediaan-akhir', 'eoq', 'probabilitas', 'quantity-disc', 'backorder'];

            if(isset($_GET['hal']) AND in_array($_GET['hal'], $listpage)) {
                include('page/'.$_GET['hal'].'.php');
            } else { ?> 
                <div class="row justify-content-center">
                    <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">Intro.</div>
        
                        <div class="card-body text-center">
                            <h3>Sistem Inventory</h3>
                            <h5>Implementasi Rumus Sistem Inventory</h5>
        
                            <img src="https://www.harianhaluan.com/assets/berita/original/72212249040-upiyptk.jpg" class="rounded mx-auto d-block mb-3" style="width:300px" alt="...">
        
                            <div class="text-center">
                                <h6 class="mb-5">Dosen Pengampu : Mutiana Pratiwi</h6>
                                Dibuat Oleh : <br>
                                <div class="mb-2">
                                    Rahmad Arif<br>
                                </div>
        
                                <h4 class="mt-5">Sistem Informasi</h4>
                                <h4>Fakultas Ilmu Komputer</h4>
                                <h4>Universitas Putra Indonesia "YPTK"</h4>
                                <h4>Padang</h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

</body>
</html>