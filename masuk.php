<?php
    require 'function.php';
   // require 'cek.php';
   
   if(!isset($_SESSION['log'])){

    //    header('location:;'login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Inventory Barang</a></form>   
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Barang Masuk
                                </button>
                            </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Masuk</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Penerima</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                                <?php
                                                $ambildatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s where s.idbarang = m.idbarang");
                                                while($data=mysqli_fetch_array($ambildatastock)){
                                                    $tanggal = $data['tanggal'];
                                                    $namabarang = $data['namabarang'];
                                                    $qty = $data['qty'];
                                                    $keterangan = $data['keterangan'];
                                                    $idb = $data['idbarang'];
                                                    $idm = $data['idmasuk'];
                                                    

                                                
                                                ?>

                                                <tr>
                                                    <td><?=$tanggal;?></td>
                                                    <td><?=$namabarang;?></td>
                                                    <td><?=$qty;?></td>
                                                    <td><?=$keterangan;?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#edit<?=$idm;?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        
                                                        <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#delete<?=$idm;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                 <!-- The Modal Tombol Edit-->
                                                <div class="modal fade" id="edit<?=$idm;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Barang</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        
                                                        <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" require>
                                                        <br>
                                                        <input type="text" name="qty"value="<?=$qty;?>" class="form-control" require>
                                                        <br>
                                                        <input type="text" name="keterangan"value="<?=$keterangan;?>" class="form-control" require>
                                                        <br>
                                                        <input type="hidden" name ="idb" value ="<?=$idb;?>">
                                                        <input type="hidden" name ="idm" value ="<?=$idm;?>">
                                                        <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                </div>
                                                </div>

                                                <!-- The Modal Tombol Delete -->
                                                <div class="modal fade" id="delete<?=$idm;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Barang</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">Apakah Anda ingin menghapus <?=$namabarang;?>?
                                                    <input type="hidden" name ="idb" value ="<?=$idb;?>">
                                                    <input type="hidden" name ="kty" value ="<?=$qty;?>">
                                                    <input type="hidden" name ="idm" value ="<?=$idm;?>">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger" name="deletebarangmasuk">Delete</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                </div>
                                                </div>

                                                <?php
                                                };
                                                ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Barang Masuk</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <form method="post">
      <div class="modal-body"> 
        <select name ="barangnya" class="form-control">
            <?php
                $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stock");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray['namabarang'];
                    $idbarangnya = $fetcharray['idbarang'];
                    
            ?>
            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>


            <?php
                }
            ?>
        </select>
        <br>
        <input type="number" name="qty" placeholder="Quantity"class="form-control" require>
        <br>
        <input type="text" name="penerima" placeholder="Penerima"class="form-control" require>
        <br>
        <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button></div>
    </div>
    </form>
  </div>
</div>
</html>