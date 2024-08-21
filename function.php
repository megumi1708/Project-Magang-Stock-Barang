<?php
session_start();
//koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");

// add barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotalable = mysqli_query($conn, "INSERT into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotalable){
        header('location:index.php');

    }else{
        echo 'Gagal';
        header('location:index.php');
    }
};

//menerima barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
    $updatetomasuk = mysqli_query($conn,"UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatetomasuk){
        header('location:masuk.php');

    }else{
        echo 'Gagal';
        header('location:masuk.php');
    }
};

//menerima barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtomasuk = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
    $updatetomasuk = mysqli_query($conn,"UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatetomasuk){
        header('location:keluar.php');

    }else{
        echo 'Gagal';
        header('location:keluar.php');
    }
};




//update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    

    $update = mysqli_query($conn, "UPDATE stock set namabarang = '$namabarang', deskripsi = '$deskripsi' where idbarang ='$idb'");
    if($update){
        header('location:index.php');

    }else{
        echo 'Gagal';
        header('location:index.php');
    }
};

//hapus barang
if(isset($_POST['deletebarang'])){
    $idb = $_POST['idb'];

    $delete = mysqli_query($conn, "DELETE from stock where idbarang ='$idb'");
    if($delete){
        header('location:index.php');

    }else{
        echo 'Gagal';
        header('location:index.php');
    }
};

// barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $lihatqty = mysqli_query($conn,"SELECT * FROM masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($lihatqty);
    $qtyskrg = $qtynya['qty'];
    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn,"UPDATE stock set stock = '$kurangin' where idbarang ='$idb'"); 
        $updatenya = mysqli_query($conn, "UPDATE masuk set qty ='$qty',keterangan= '$keterangan'where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){

                header('location:masuk.php');

            }else{
                echo 'Gagal';
                header('location:masuk.php');
            }
        }else{
            $selisih = $qtyskrg-$qty;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn,"UPDATE stock set stock = '$kurangin' where idbarang ='$idb'"); 
            $updatenya = mysqli_query($conn, "UPDATE masuk set qty ='$qty',keterangan= '$keterangan' where idmasuk='$idm'");
                if($kurangistocknya&&$updatenya){
    
                    header('location:masuk.php');
    
                }else{
                    echo 'Gagal';
                    header('location:masuk.php');
                }
            }
    };

// hapus barang masuk
if(isset($_POST['deletebarangmasuk'])){
    $idm = $_POST['idm'];
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];

    $getdatastock = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock =$data['stock'];

    $selisih = $stock-$qty;

    $update =mysqli_query($conn,"UPDATE stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
    
        header('location:masuk.php');

    }else{
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//kelola data keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $lihatqty = mysqli_query($conn,"SELECT * FROM keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($lihatqty);
    $qtyskrg = $qtynya['qty'];
    if($qty>$qtyskrg){
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn,"UPDATE stock set stock = '$kurangin' where idbarang ='$idb'"); 
        $updatenya = mysqli_query($conn, "UPDATE keluar set qty ='$qty',penerima= '$penerima'where idkeluar='$idk'");
        if($kurangistocknya&&$updatenya){
            
            header('location:keluar.php');
            
        }else{
            echo 'Gagal';
            header('location:keluar.php');
        }
    }else{
            $selisih = $qty-$qtyskrg;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn,"UPDATE stock set stock = '$kurangin' where idbarang ='$idb'"); 
            $updatenya = mysqli_query($conn, "UPDATE keluar set qty ='$qty',penerima= '$penerima' where idkeluar='$idk'");
                if($kurangistocknya&&$updatenya){
    
                    header('location:keluar.php');
    
                }else{
                    echo 'Gagal';
                    header('location:keluar.php');
                }
            }
    };

// hapus barang masuk
if(isset($_POST['deletebarangkeluar'])){
    $idk = $_POST['idk'];
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];

    $getdatastock = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock =$data['stock'];

    $selisih = $stock+$qty;

    $update =mysqli_query($conn,"UPDATE stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
    
        header('location:keluar.php');

    }else{
        echo 'Gagal';
        header('location:keluar.php');
    }
}

?>