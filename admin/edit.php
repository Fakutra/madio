<?php
include('template/header.php');
include('config_query.php');
$db = new database();

// Mendapatkan ID artikel dari parameter URL
$id_artikel = isset($_GET['id']) ? $_GET['id'] : null;

// Jika ID artikel tidak ada, berikan pesan error atau redirect ke halaman lain
if ($id_artikel === null) {
    echo "ID artikel tidak valid atau tidak ditemukan.";
    // atau redirect ke halaman lain
    // header("Location: halaman_lain.php");
    // exit();
}

// Mendapatkan data artikel berdasarkan ID
$data_artikel = $db->get_by_id($id_artikel);

// Jika data artikel tidak ditemukan, berikan pesan error atau redirect ke halaman lain
if ($data_artikel === null) {
    echo "Artikel dengan ID $id_artikel tidak ditemukan.";
    // atau redirect ke halaman lain
    // header("Location: halaman_lain.php");
    // exit();
}

?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="index.php">Manajemen Artikel</a> /</span>
        Edit Data</h4>

    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Edit Artikel</h4>
                </div>

                <div class="card-body">
                    <form action="proses_aksi.php?aksi=edit" method="POST" enctype="multipart/form-data">
                        <!-- Menambahkan input hidden untuk menyimpan ID artikel -->
                        <input type="hidden" name="id_artikel" value="<?= $id_artikel; ?>">
                        
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul Artikel*</label>
                                    <input type="text" name="judul_artikel" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Judul Artikel" value="<?= $data_artikel['judul_artikel']; ?>" required />
                                </div>

                                <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Artikel*</label>
                                    <textarea class="form-control summernote" name="isi_artikel" id="exampleFormControlTextarea1" rows="3"
                                        required><?= $data_artikel['isi_artikel']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-md mb-3">
                                    <small class="form-label d-block">Status Publish*</small>
                                    <div class="form-check mt-3">
                                        <input name="status_publish" class="form-check-input" type="radio" value="publish" id="publish"
                                            <?= ($data_artikel['status_publish'] == 'publish') ? 'checked' : ''; ?> required>
                                        <label class="form-check-label" for="defaultRadio1"> Publish </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status_publish" class="form-check-input" type="radio" value="draft" id="draft"
                                            <?= ($data_artikel['status_publish'] == 'draft') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb3">
                            <a href="index.php" class="btn btn-danger">Batalkan</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
include('template/footer.php');
?>
