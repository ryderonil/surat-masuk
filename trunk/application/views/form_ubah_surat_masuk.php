<div id="form_container">
		<div class="title">UBAH SURAT MASUK</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'form_ubah_surat_masuk');
			echo form_open_multipart(uri_string(),$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Daftar Surat Masuk',''); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Sifat</label>
					<div>
						<?php 
								if(set_value('sifat')!='') $sifat = set_value('sifat');
								$options = array(
												'1' => 'Reguler',
												'2' => 'Rahasia',
											);
								echo form_dropdown('sifat',$options, $sifat, 'id="sifat" class="element select small" onChange="ubahSifat();"');
						?>					
					</div>
					<?php echo form_error('sifat'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Nomor</label>
					<div>
						<input id="nomor" name="nomor" class="element text medium" type="text" value="<?php if(isset($nomor))echo $nomor;?>"/> 					
					</div>
					<?php echo form_error('nomor'); ?>
				</li>
				<li>
					<label class="description">Tanggal Terima</label>
						<span>
							<div id="newline-wrapper">
								<table class="split-date-wrap" cellpadding="0" cellspacing="0" border="0">
									<tbody>
										<tr>
											<td>
												<input type="text" class="w2em" id="date-9-dd" readonly name="tgl_terima" maxlength="2" value="<?php echo $tgl_terima;?>"/>-<label for="date-9-dd">DD</label>
											</td>												
											<td>
												<input type="text" class="w2em" id="date-9-mm"readonly name="bln_terima" maxlength="2" value="<?php echo $bln_terima;?>"/>-<label for="date-9-mm">MM</label>
											</td>
											<td>
												<input type="text" class="w4em highlight-days-67 split-date" readonly id="date-9" name="thn_terima" maxlength="4" value="<?php echo $thn_terima;?>"/>
												&nbsp;<img src="<?=base_url();?>images/icon/hapus.png" onclick="hapus_tanggal_terima();"/>
												<label for="date-9">YYYY</label>
											</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</span>
				</li>
				<li id="li_21" >
					<label class="description" for="element_21">Jenis Surat</label>
					<div>
						<?php 
							echo form_dropdown('jenis_surat',$jenis_surat,$jenis_surat_dipilih, 'id="jenis_surat" class="element select medium"');
						?>
					</div>
					<?php echo form_error('jenis_surat'); ?>
				</li>
				<li id="li_21" >
					<label class="description" for="element_21">Dari</label>
					<div>
						<?php
							
							echo form_dropdown('instansi',$instansi,$instansi_dipilih, 'id="instansi" class="element select medium"');
						?>
					</div>
					<?php echo form_error('instansi'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Perihal</label>
					<div>
						<input id="perihal" name="perihal" class="element text medium" type="text" value="<?php echo $perihal;?>"/> 					
					</div>
					<?php echo form_error('perihal'); ?>
				</li>
				<div id="hideme">
					<li id="li_1" >
						<div id="dvFile_file">
							<label class="description" for="element_1">File Surat</label>
							<table class="data" width="60%" border="0" cellspacing="0" cellpadding="2">
								<tr>
									<th align="center" bgcolor="#b9c9fe">Update File</th>
									<th align="center" bgcolor="#b9c9fe">File Saat Ini</th>
								</tr>
								<?php if(count($file_surat_masuk) != 0){
									foreach($file_surat_masuk as $row) {
								?>
								<tr class="carttableproduct">
									<td align="center">
										<p>
											<input name="userfile_<?php echo $row->FILE_SURAT_MASUK_ID;?>" class="element file" type="file"/> 
										</p>
									</td>
									<td align="center"><p><?php echo anchor(site_url('surat_masuk/download/'.$row->FILE_SURAT_MASUK_ID),$row->NAMA_FILE,'')?></p></td>
								</tr>
								<?php 
									}
								} 
								else { ?>
								<tr class="carttableproduct">
									<td align="center">
										<p>-</p>
									</td>
									<td align="center"><p>-</p></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</li>
					<li id="li_21" >
						<label class="description" for="element_21">Kepada</label>
						<div>
							<?php
								echo form_dropdown('pejabat',$pejabat,$pejabat_dipilih, 'class="element select medium"');
							?>
						</div>
						<?php echo form_error('pejabat'); ?>
					</li>
					<li>
						<label class="description">Tanggal Surat</label>
							<span>
								<div id="newline-wrapper">
									<table class="split-date-wrap" cellpadding="0" cellspacing="0" border="0">
										<tbody>
											<tr>
												<td>
													<input type="text" class="w2em" id="date-8-dd" readonly name="tgl_surat" maxlength="2" value="<?php if(isset($tgl_surat)) echo $tgl_surat;?>"/>-<label for="date-9-dd">DD</label>
												</td>												
												<td>
													<input type="text" class="w2em" id="date-8-mm"readonly name="bln_surat" maxlength="2" value="<?php if(isset($bln_surat)) echo $bln_surat;?>"/>-<label for="date-9-mm">MM</label>
												</td>
												<td>
													<input type="text" class="w4em highlight-days-67 split-date" readonly id="date-8" name="thn_surat" maxlength="4" value="<?php if(isset($thn_surat)) echo $thn_surat;?>"/>
													&nbsp;<img src="<?=base_url();?>images/icon/hapus.png" onclick="hapus_tanggal_surat();"/>
													<label for="date-9">YYYY</label>
												</td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</span>
					</li>
					
					<li id="li_14" >
						<label class="description" for="element_14">Jumlah Lampiran</label>
						<div>
							<input id="lampiran" name="lampiran" class="element text medium" type="text" value="<?php echo $lampiran;?>"/> 					
						</div>
						<?php echo form_error('lampiran'); ?>
					</li>
					<li id="li_14" >
						<label class="description" for="element_14">Catatan</label>
						<div>
							<?php 
								$data = array(
											'name'        => 'catatan',
											'id'          => 'catatan',
											'value'       => $catatan,
											'class'       => 'element textarea medium',
											'cols'		  => '200'
										);
								echo form_textarea($data);
							?> 					
						</div>
						<?php echo form_error('catatan'); ?>
					</li>
					
				</div>
				<li>
					<div>	
						<input id="submit-button" type="submit" name="daftar_warna" value="Perbarui" />
						<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
					</div>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
		function ubahSifat()
		{
			var sifat = $('#sifat').val();
			if(sifat == 1)
			{
				$('#hideme').show();
				$('#hideme1').show();
			}
			else
			{
				$('#hideme').hide();
				$('#hideme1').hide();
			}
		}

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
	
	$(document).ready(function(){
		if($('#sifat').val() == 2)
		{
			$('#hideme').hide();
		}
		else
		{
			$('#hideme').show();
		}
		
	});
</script>
