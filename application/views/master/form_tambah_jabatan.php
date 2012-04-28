<div id="form_container">
		<div class="title">TAMBAH JABATAN</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open('jabatan/add_process',$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('jabatan'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master Jabatan',''); ?>
				</li>
				
				<li id="li_1" >
					<label class="description" for="element_1">Nama Jabatan</label>
					<div>
						<input id="nama_jabatan" name="nama_jabatan" class="element text medium" type="text" value="<?php echo set_value('nama_jabatan');?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Nama Jabatan</small></p> 
					<?php echo form_error('nama_jabatan'); ?>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Tambah" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('jabatan')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
