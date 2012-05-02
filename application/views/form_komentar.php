<div id="form_container">
		<div class="title">KOMENTAR</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'form_komentar');
			echo form_open('surat_masuk/komentar_proses/'.$surat_masuk_id,$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Daftar Surat Masuk',''); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Nomor Surat</label>
					<div>
						<?php if(set_value('nomor')!='') $nomor = set_value('nomor')?>
						<input id="nomor" name="nomor" disabled="true" class="element text medium" type="text" value="<?php echo $nomor;?>"/> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Nomor Surat</small></p>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Komentar</label>
					<div>
						<?php
							$data = array(
										'name'        => 'komentar',
										'id'          => 'komentar',
										'value'       => $komentar,
										'class'       => 'element textarea medium',
										'cols'		  => '200'
									);
							echo form_textarea($data);
						?> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Komentar</small></p> 
				</li>	
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Tambah" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
		function hapus_tanggal_terima(){
			document.form_catat_surat_masuk.tgl_terima.value = '';
			document.form_catat_surat_masuk.bln_terima.value = '';
			document.form_catat_surat_masuk.thn_terima.value = '';
		}
		
		function hapus_tanggal_surat(){
			document.form_catat_surat_masuk.tgl_surat.value = '';
			document.form_catat_surat_masuk.bln_surat.value = '';
			document.form_catat_surat_masuk.thn_surat.value = '';
		}
		
		function _add_more_file() {
			var content = document.getElementById('userfile0');
			var index = jQuery('[name^="userfile"]');
			if(index.length<10)
			{
				var txt = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td><input id=\"userfile"+index.length+"\" name=\"userfile"+index.length+"\" class=\"element text medium\" type=\"file\" size=\"36\"/></td></tr></table>";
				document.getElementById("dvFile_file").innerHTML += txt;
			}
			else
			{
				alert("Maksimum file yang diupload 10");
			}
		}
		
		Ext.onReady(function(){
			// autocomplete utk jenis surat
			var jenis_surat = new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				transform:'jenis_surat',
				width: 350,
				forceSelection: false
			});
			
			var instansi = new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				transform:'instansi',
				width: 350,
				forceSelection: false
			});
		}	
	);
</script>
	</script>
