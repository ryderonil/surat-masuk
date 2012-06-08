<div id="form_container">
		<div class="title">EDIT INSTANSI</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open(uri_string(),$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('instansi'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master Instansi',''); ?>
				</li>
				<li id="li_1" >
					<label class="description" for="element_1">Nama Instansi</label>
					<div>
						<?php if(set_value('nama_instansi')!='') $nama_instansi = set_value('nama_instansi')?>
						<input id="nama_instansi" name="nama_instansi" class="element text medium" type="text" value="<?php echo $nama_instansi;?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Nama Instansi</small></p> 
					<?php echo form_error('nama_instansi'); ?>
				</li>
				<li id="li_1" >
					<label class="description" for="element_1">Alamat Instansi</label>
					<div>
						<?php 
							$data = array(
										'name'        => 'alamat_instansi',
										'id'          => 'alamat_instansi',
										'value'       =>  $alamat_instansi,
										'class'       => 'element textarea medium',
										'cols'		  => '200'
									);
							echo form_textarea($data);
						?> 		
					</div>
					<p class="guidelines" id="guide_1"><small>Alamat Instansi</small></p> 
					<?php echo form_error('nama_instansi'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Status</label>
					<div>
						<?php 
								$options = array(
												'1' => 'Aktif',
												'2' => 'Tidak Aktif'
											);
								echo form_dropdown('status_instansi',$options,$status_instansi, 'class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Status</small></p>
				</li>
				
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Perbarui" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('instansi')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
