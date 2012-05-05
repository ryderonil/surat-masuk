<div id="form_container">
		<div class="title">DISPOSISI</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'form_disposisi');
			echo form_open_multipart('surat_masuk/disposisi_process/'.$surat_masuk_id,$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Daftar Surat Masuk',''); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Nomor Surat</label>
					<div>
						<?php if(set_value('nomor')!='') $nomor = set_value('nomor')?>
						<input id="nomor" name="nomor" class="element text medium" type="text" value="<?php echo $nomor;?>"/> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Nomor</small></p>
				</li>
				<li id="li_21">
					<label class="description" for="element_21">Disposisi ke</label>
					<div>
						<?php
							echo form_dropdown('dinas',$dinas,'0', 'id="dinas" class="element select medium"');
						?>
					</div>
					<p class="guidelines" id="guide_21"><small>Disposisi ke</small></p>
					<?php echo form_error('dinas'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Catatan Disposisi</label>
					<div>
						<?php 
							$data = array(
										'name'        => 'catatan',
										'id'          => 'catatan',
										'value'       => set_value('catatan'),
										'class'       => 'element textarea medium',
										'cols'		  => '200'
									);
							echo form_textarea($data);
						?> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Catatan Disposisi</small></p> 
				</li>	
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Tambah" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">		
		Ext.onReady(function(){
			var dinas = new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				transform:'dinas',
				width: 350,
				forceSelection: false
			});
		}	
	);
</script>
