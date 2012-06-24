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
			<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'<b>Kembali Ke Daftar Surat Masuk</b>',''); ?>
		</div>
		<br />
		<fieldset>
		<legend><label><b>| Pengiriman |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<tr>
							<td>
								<p><?php echo $penerima;?> --> </p>
							</td>
							<td>
								<?php echo $status_terima;?>
							</td>
							<?php if(isset($success_sign)) echo $success_sign;?>
						</tr>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php echo form_close();?>
	</div>
</div>
