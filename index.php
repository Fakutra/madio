<?php
include("template/header.php");
include('admin/config_query.php');
$db = new database();
$data_artikel = $db->tampil_data_landing();
?>

<section class="section">
	<div class="container">
		<div class="row mb-4">
			<div class="col-sm-6">
				<h2 class="posts-entry-title">Mading JeWePe</h2>
			</div>
			<div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a></div>
		</div>

		<div class="row">
			<?php
				foreach($data_artikel as $row){
					
				
				?>
			<div class="col-lg-4 mb-4">
				<div class="post-entry-alt">
					<a href="detail.php?id=<?=$row['id_artikel'];?>" class="img-link"><img src="files/<?= $row['header'];?> " alt="Image"
							class="img-fluid"></a>
					<div class="excerpt">


						<h2><a href="detail.php?id=<?=$row['id_artikel'];?>"><?= $row['judul_artikel'];?></a></h2>
						<div class="post-meta align-items-center text-left clearfix">
							<figure class="author-figure mb-0 me-3 float-start"><img
									src="aset/landing/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
							<span class="d-inline-block mt-1">By <a href="#"><?= $row ['name'];?></a></span>
							<span>&nbsp;-&nbsp; <?php
                  				if($row['updated_at']==''){
                    				echo date('d M Y',strtotime ($row['created_at']));
                  				}else{
                    				echo date('d M Y',strtotime ($row['updated_at']));
                  				}
                  				?>
							</span>
						</div>

						<?= $row['isi_artikel']; ?>
						<p>
							<a href="detail.php?id=<?=$row['id_artikel'];?>" class="read-more">selengkapnya...</a>
						</p>

					</div>
				</div>
			</div>
			<?php } ?>
		</div>

	</div>
</section>