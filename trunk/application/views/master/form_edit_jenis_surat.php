<div id="form_container">
		<div class="title">EDIT JENIS SURAT</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open(uri_string(),$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('jenis_surat'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master Jenis Surat',''); ?>
				</li>
				<li id="li_1" >
					<label class="description" for="element_1">Jenis Surat</label>
					<div>
						<?php if(set_value('jenis_surat')!='') $jenis_surat = set_value('jenis_surat')?>
						<input id="jenis_surat" name="jenis_surat" class="element text medium" type="text" value="<?php echo $jenis_surat;?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Jenis Surat</small></p> 
					<?php echo form_error('jenis_surat'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Status</label>
					<div>
						<?php 
								$options = array(
												'1' => 'Aktif',
												'2' => 'Tidak Aktif'
											);
								echo form_dropdown('status_jenis_surat',$options,$status_jenis_surat, 'class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Status</small></p>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Perbarui" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('jenis_surat')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
