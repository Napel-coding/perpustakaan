<?php
session_start();
include "koneksi.php";
$cart = @$_SESSION['cart'];

if (count($cart) > 0) {
    $lama_pinjam = 5; // Satuan hari
    $tgl_harus_kembali = date('Y-m-d', mktime(0, 0, 0, date('m'), (date('d') + $lama_pinjam), date('Y')));
    
    // Insert into peminjamanbuku table
    $insert_peminjaman = mysqli_query($conn, "INSERT INTO peminjamanbuku (id_siswa, tanggal_pinjam, tanggal_kembali) VALUES ('" . $_SESSION['id_siswa'] . "','" . date('Y-m-d') . "','" . $tgl_harus_kembali . "')");
    
    if ($insert_peminjaman) {
        // Get the last inserted ID
        $id_peminjaman_buku = mysqli_insert_id($conn);

        // Loop through the cart to insert into detail_peminjaman_buku
        foreach ($cart as $key_produk => $val_produk) {
            mysqli_query($conn, "INSERT INTO detail_peminjaman_buku (id_peminjaman_buku, id_buku, qty) VALUES ('" . $id_peminjaman_buku . "', '" . $val_produk['id_buku'] . "', '" . $val_produk['qty'] . "')");
        }
        
        // Clear the cart session
        unset($_SESSION['cart']);
        echo '<script>alert("Anda berhasil meminjam buku");location.href="histori_peminjaman.php"</script>';
    } else {
        echo '<script>alert("Gagal meminjam buku, silakan coba lagi.");location.href="cart.php"</script>';
    }
}
?>
