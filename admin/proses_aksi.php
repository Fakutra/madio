<?php
include('config_query.php');
$db = new database();
session_start();
$id_admin = $_SESSION['id_admin'];

 
$aksi = $_GET['aksi'];

if($aksi == "add"){
    if($_FILES["header"]["name"] !=''){
        $tmp = explode('.',$_FILES["header"]["name"]);
        $ext = end($tmp);
        $filename = $tmp[0];
        $allowed_ext = array("jpg","png","jpeg");

        if(in_array($ext,$allowed_ext)){
            if($_FILES["header"]["size"] <= 5120000){
                $name = $filename.'_'.rand().'.'.$ext;
                $path = "../files/".$name;
                $uploaded = move_uploaded_file($_FILES["header"]["tmp_name"],$path);

                if ($uploaded){
                    $insertData = $db->tambah_data($name,$_POST["judul_artikel"],$_POST["isi_artikel"],$_POST["status_publish"],$id_admin);

                    if ($insertData){
                        echo "<script>alert('Data Berhasil Ditambahkan');document.location.href = 'index.php'</script>";
                    
                    }else{
                        echo "<script>alert('Data Gagal Ditambahkan');document.location.href = 'index.php'</script>";
                    }
                }else{
                    echo "<script>alert('Upload File Gagal');document.location.href = 'tambah_data.php'</script>";
                }
            }else{
                echo "<script>alert('Ukuran Gambar Lebih Dari 5Mb');document.location.href = 'tambah_data.php'</script>";
            }
        }else{
            echo "<script>alert('Upload File Gagal');document.location.href = 'tambah_data.php'</script>";
        }
    }else{
        echo "<script>alert('File yang diupload bukan extensi yang diizinkan');document.location.href = 'tambah_data.php'</script>";
    }
} elseif ($aksi == "edit") {
    // Mendapatkan ID artikel yang akan diedit
    $id_artikel = isset($_POST['id_artikel']) ? $_POST['id_artikel'] : null;

    // Jika ID artikel tidak ada, berikan pesan error atau redirect ke halaman lain
    if ($id_artikel === null) {
        echo "<script>alert('ID artikel tidak valid atau tidak ditemukan');document.location.href = 'index.php'</script>";
    }

    // Memproses perubahan data artikel
    $judul_artikel = $_POST["judul_artikel"];
    $isi_artikel = $_POST["isi_artikel"];
    $status_publish = $_POST["status_publish"];

    // Memanggil fungsi update_artikel pada objek database
    $updateData = $db->update_artikel($id_artikel, $judul_artikel, $isi_artikel, $status_publish);

    // Menangani hasil update
    if ($updateData) {
        echo "<script>alert('Data Berhasil Diupdate');document.location.href = 'index.php'</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate');document.location.href = 'edit.php?id=$id_artikel'</script>";
    }
}
elseif($aksi == "delete") {
    // Mendapatkan ID artikel yang akan dihapus
    $id_artikel = isset($_GET['id']) ? $_GET['id'] : null;

    // Jika ID artikel tidak ada, berikan pesan error atau redirect ke halaman lain
    if ($id_artikel === null) {
        echo "<script>alert('ID artikel tidak valid atau tidak ditemukan');document.location.href = 'index.php'</script>";
    }

    // Memanggil fungsi delete_artikel
    $deleteData = $db->delete_artikel($id_artikel);

    // Menangani hasil delete
    if ($deleteData) {
        echo "<script>alert('Data Berhasil Dihapus');document.location.href = 'index.php'</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus');document.location.href = 'index.php'</script>";
    }
}else{
    echo "<script>alert('Anda tidak mendapatkan akses untuk operasi ini');document.location.href = 'index.php'</script>";
}
?>