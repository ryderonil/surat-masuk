<div id="form_container">
		<div class="title">EDIT DINAS</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open(uri_string(),$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('dinas'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master Dinas',''); ?>
				</li>
				
				<li id="li_1" >
					<label class="description" for="element_1">Nama Dinas</label>
					<div>
						<?php if(set_value('nama_dinas')!='') $nama_dinas = set_value('nama_dinas')?>
						<input id="nama_dinas" name="nama_dinas" class="element text medium" type="text" maxlength="11" value="<?php echo $nama_dinas;?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Nama Dinas</small></p> 
					<?php echo form_error('nama_dinas'); ?>
				</li>
				<li id="li_1" >
					<label class="description" for="element_1">Singkatan</label>
					<div>
						<input id="singkatan" name="singkatan" class="element text medium" type="text" value="<?php echo $singkatan;?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Singkatan</small></p> 
					<?php echo form_error('singkatan'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Status</label>
					<div>
						<?php 
								$options = array(
												'1' => 'Aktif',
												'2' => 'Tidak Aktif'
											);
								echo form_dropdown('status_dinas',$options,$status_dinas, 'class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Status</small></p>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Perbarui" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('dinas')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
