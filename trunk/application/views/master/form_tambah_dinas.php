<div id="form_container">
		<div class="title">TAMBAH SKPD</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open('dinas/add_process',$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('dinas'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Master SKPD',''); ?>
				</li>
				
				<li id="li_1" >
					<label class="description" for="element_1">Nama SKPD</label>
					<div>
						<input id="nama_dinas" name="nama_dinas" class="element text medium" type="text" value="<?php echo set_value('nama_dinas');?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Nama Dinas</small></p> 
					<?php echo form_error('nama_dinas'); ?>
				</li>
				<li id="li_1" >
					<label class="description" for="element_1">Singkatan</label>
					<div>
						<input id="singkatan" name="singkatan" class="element text medium" type="text" value="<?php echo set_value('singkatan');?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Singkatan</small></p> 
					<?php echo form_error('singkatan'); ?>
				</li>
				
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Tambah" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('dinas')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
