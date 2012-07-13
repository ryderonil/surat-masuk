<?php
	$kode_role = $this->session->userdata('kode_role');
?>

<div class="border_content">
	<div class="title">STATUS SURAT</div>
	<div class="inner_content">
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'detail_surat_masuk');
			echo form_open('',$attributes); ?>
		<div>
			<?= anchor(site_url('surat_masuk/grid_surat_disposisi'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'<b>Kembali Ke Daftar Surat Masuk Disposisi</b>',''); ?>
		</div>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$i = 0;
						if(count($data_penerima_disposisi) > 0) {
						foreach($data_penerima_disposisi as $penerima) {?>
						<tr>
							<td>
								<p><?php echo $penerima;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima[$i];?>
							</td>
							<?php if(isset($success_sign[$i])) echo $success_sign[$i];?>
						</tr>
						<?php 
						$i++;
						} 
						} else { ?>
						<tr>
							<td>
								<p>-</p>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php echo form_close();?>
	</div>
</div>
