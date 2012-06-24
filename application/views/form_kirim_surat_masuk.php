<div id="form_container">
		<div class="title">KIRIM SURAT</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'form_disposisi');
			echo form_open_multipart(uri_string(),$attributes); ?>
			<ul>			
			  	<li>
					<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Daftar Surat Masuk',''); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Nomor Surat</label>
					<div>
						<p><?php echo $nomor;?></p> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Nomor</small></p>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Penerima</label>
					<div>
						<?php 
								echo form_dropdown('penerima',$skpd,'0', 'id="penerima" class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Penerima</small></p> 
					<?php echo form_error('penerima'); ?>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Kirim" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
