<?php
include "koneksi.php";
$id_buku = $_GET['id_buku'];
$query="DELETE FROM buku WHERE id_buku = '$id_buku'";

if (mysqli_query($conn,$query)) {
    echo "<script>alert('Buku berhasil dihapus');</script>";
    echo "<script>location.href='buku.php';</script>";
}else{

    echo "<script>alert('Gagal menambahkan buku');</script>";
    echo "<script>location.href='buku.php';</script>";

}
mysqli_close($conn);
?>