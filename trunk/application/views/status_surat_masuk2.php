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
		<legend><label><b>| Detail |</b></label></legend>
		<ul>
			<li>
				<div><label class="description" for="element_14">Status Disposisi 	:</label></div>
				<?php 
					if(isset($nama_dinas)) $nama_dinas = $nama_dinas; else $nama_dinas = '';
					if($status_disposisi == 0)
					{
						$value = 'Belum Didisposisi';
					}
					else
					{
						$value = 'Sudah Didisposisikan ke '.$nama_dinas;
					}
				
				?>
				<table>
					<tr>
						<td>
							<p><?php echo $value;?></p>
						</td>
						<td>
							<?php
								if($status_disposisi == 0)
								{ ?>
									<input id="submit-button" type="button" name="disposisi" value="Disposisi" onClick="location.href='<?php echo site_url('surat_masuk/disposisi/'.$surat_masuk_id);?>'"/>
							<?php
								}
							?>
						</td>
					</tr>
				</table>
			</li>
			<li>
				<div><label class="description" for="element_14">Status Penerimaan	:</label></div>
				<?php 
				
					if($status_terima_dinas == 1)
					{
						$value2 = 'Surat Sudah Diperiksa';
					}
					else if($status_terima_dinas == 0 && $status_disposisi == 1)
					{
						$value2 = 'Surat Belum Diperiksa';
					}
					else if($status_disposisi == 0)
					{
						$value2 = '-';
					}
					
				
				?>
				
					<table>
						<tr>
							<td>
								<p><?php echo $value2;?></p>
							</td>
							<td>
								<?php
									if($status_terima_dinas == 0 && $status_disposisi == 1)
									{ ?>
										<input id="submit-button" type="button" name="kirim_bupati" value="Kirim SMS Notifikasi" onClick="location.href='<?php echo site_url('surat_masuk/kirim_ke_bupati/');?>'"/>
								<?php
									}
								?>
							</td>
						</tr>
					</table>
				
			</li>
		</ul>
		</fieldset>
	</div>
	<?php echo form_close();?>
</div>
