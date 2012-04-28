<div id="form_container">
		<div class="title">EDIT JABATAN</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open(uri_string(),$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('jabatan'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master Jabatan',''); ?>
				</li>
				<li id="li_1" >
					<label class="description" for="element_1">Nama Jabatan</label>
					<div>
						<?php if(set_value('nama_jabatan')!='') $nama_jabatan = set_value('nama_jabatan')?>
						<input id="nama_jabatan" name="nama_jabatan" class="element text medium" type="text" value="<?php echo $nama_jabatan;?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Nama Jabatan</small></p> 
					<?php echo form_error('nama_jabatan'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Status</label>
					<div>
						<?php 
								$options = array(
												'1' => 'Aktif',
												'2' => 'Tidak Aktif'
											);
								echo form_dropdown('status_jabatan',$options,$status_jabatan, 'class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Status</small></p>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Perbarui" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('jabatan')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
