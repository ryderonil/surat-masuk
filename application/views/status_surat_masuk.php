<?php
	$kode_role = $this->session->userdata('kode_role');
?>

<div class="border_content">
	<div class="title">STATUS SURAT MASUK</div>
	<div class="inner_content">
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'detail_surat_masuk');
			echo form_open_multipart('',$attributes); ?>
		<div>
			<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'<b>Kembali Ke Daftar Surat Masuk</b>',''); ?>
		</div>
		<br />
		<fieldset>
		<legend><label><b>| Pengiriman |</b></label></legend>
		<ul>
		<?php if($kode_role == 1) { ?>
			<li>
				<div class="left"><label class="description" for="element_14">Sekretaris :</label></div>
				<?php 
				
					if($kirim_sekretaris == 0)
					{
						$value = 'Tidak';
					}
					else
					{
						$value = 'Terkirim <img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'>';
					}
				
				?>
				<div>
					<table>
						<tr>
							<td>
								<p><?php echo $value;?></p>
							</td>
							<td>
								<?php
									if($kirim_sekretaris == 0)
									{ ?>
										<input id="submit-button" type="button" name="kirim_sekretaris" value="Kirim" onClick="location.href='<?php echo site_url('surat_masuk/kirim_ke_sekretaris/'.$surat_masuk_id);?>'"/>
								<?php
									}
								?>
							</td>
						</tr>
					</table>
				</div>
			</li>
			<?php } else if($kode_role == 2 || $kode_role == 3) {?>
			<li>
				<div class="left"><label class="description" for="element_14">Bupati 	 :</label></div>
				<?php 
				
					if($kirim_bupati == 0)
					{
						$value2 = 'Tidak';
					}
					else
					{
						$value2 = 'Terkirim <img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'>';
					}
				
				?>
				<div>
					<table>
						<tr>
							<td>
								<p><?php echo $value2;?></p>
							</td>
							<td>
								<?php
									if($kirim_bupati == 0)
									{ ?>
										<input id="submit-button" type="button" name="kirim_bupati" value="Kirim" onClick="location.href='<?php echo site_url('surat_masuk/kirim_ke_bupati/'.$surat_masuk_id);?>'"/>
								<?php
									}
								?>
							</td>
						</tr>
					</table>
				</div>
			</li>
			<?php } ?>
		</ul>
		</fieldset>
		<br />
		<fieldset>
		<legend><label><b>| Penerimaan |</b></label></legend>
		<ul>
			<?php if($kode_role == 1){?>
			<li>
				<div class="left"><label class="description" for="element_14">Sekretaris :</label></div>
				<?php 
				
					if($status_terima == 1)
					{
						$value3 = 'Surat Sudah Diperiksa';
					}
					else
					{
						$value3 = 'Surat Belum Diperiksa';
					}
				
				?>
				<div>
					<table>
						<tr>
							<td>
								<p><?php echo $value3;?></p>
							</td>
							<td>
								<?php
									if($status_terima != 1)
									{ ?>
										<input id="submit-button" type="button" name="kirim_bupati" value="Kirim SMS Notifikasi" onClick="location.href='<?php echo site_url('surat_masuk/kirim_ke_bupati/');?>'"/>
								<?php
									}
								?>
							</td>
						</tr>
					</table>
				</div>
			</li>
			<?php } else if($kode_role == 2 || $kode_role == 3){?>
			<li>
				<div class="left"><label class="description" for="element_14">Bupati	 :</label></div>
				<?php 
				
					if($status_terima == 2)
					{
						$value4 = 'Surat Sudah Diperiksa';
					}
					else
					{
						$value4 = 'Surat Belum Diperiksa';
					}
				
				?>
				<div>
					<table>
						<tr>
							<td>
								<p><?php echo $value3;?></p>
							</td>
							<td>
								<?php
									if($status_terima != 2)
									{ ?>
										<input id="submit-button" type="button" name="kirim_bupati" value="Kirim SMS Notifikasi" onClick="location.href='<?php echo site_url('surat_masuk/kirim_ke_bupati/');?>'"/>
								<?php
									}
								?>
							</td>
						</tr>
					</table>
				</div>
			</li>
			<?php } ?>
		</ul>
		</fieldset>
		<?php echo form_close();?>
	</div>
</div>
