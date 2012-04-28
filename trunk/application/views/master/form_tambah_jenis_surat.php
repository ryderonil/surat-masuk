<div id="form_container">
		<div class="title">TAMBAH JENIS SURAT</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open('jenis_surat/add_process',$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('jenis_surat'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master Jenis Surat',''); ?>
				</li>
				
				<li id="li_1" >
					<label class="description" for="element_1">Jenis Surat</label>
					<div>
						<input id="jenis_surat" name="jenis_surat" class="element text medium" type="text" value="<?php echo set_value('jenis_surat');?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Jenis Surat</small></p> 
					<?php echo form_error('jenis_surat'); ?>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Tambah" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('jenis_surat')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
