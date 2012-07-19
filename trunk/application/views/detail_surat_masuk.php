<div id="form_container">
		<div class="title">DETAIL SURAT MASUK</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'detail_surat_masuk');
			echo form_open_multipart('',$attributes); ?>
			<div>
				<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'<b>Kembali Ke Daftar Surat Masuk</b>',''); ?>
			</div>
			<br />
			<fieldset>
			<legend><label><b>| Detail Surat |</b></label></legend>
				<ul>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Sifat :</label></div>
						<div>
							<?php 
								if($sifat == 1)
									$value = 'Reguler';
								else
									$value = 'Rahasia';
							?>
							<p><?php if(isset($value))echo $value;?></p>
						</div>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Nomor :</label></div>
						<div>
							<p><?php if(isset($nomor))echo $nomor;?></p>					
						</div>
					</li>
					<li>
						<div class="left"><label class="description">Tanggal Terima :</label></div>
						<div>
							<p><?php if(isset($tgl_terima))echo $tgl_terima;?></p>					
						</div>
					</li>
					<li id="li_21" >
						<div class="left"><label class="description" for="element_21">Jenis Surat :</label></div>
						<div>
							<p><?php if(isset($jenis_surat))echo $jenis_surat;?></p>
						</div>
					</li>
					<li id="li_21" >
						<div class="left"><label class="description" for="element_21">Dari :</label></div>
						<div>
							<p><?php if(isset($dari))echo $dari;?></p>
						</div>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Perihal :</label></div>
						<div>
							<p><?php if($perihal != null) echo $perihal; else echo '-';?></p>
						</div>
					</li>
					<?php if($sifat == 2) $tampilan2 = 'hidden'; else $tampilan2 = 'visible'; ?>
					<div id="hideme" style="visibility:<?php echo $tampilan2;?>;">
						<li id="li_1">
							<div class="left"><label class="description" for="element_1">File Surat :</label></div>
							<div>
								<table width="60%" border="0" cellspacing="0" cellpadding="0">
								<?php foreach($file_surat_masuk as $row) {?>
								<tr>
									<td align="left">
										<p>
											<a class="downloadBtn purple" href="<?php echo base_url().'index.php/surat_masuk/download/'.$row->FILE_SURAT_MASUK_ID;?>"><span><strong>Download</strong><?php echo $row->NAMA_FILE;?></span></a>
										</p>
									</td>
								</tr>
								<tr>
									<td><br /></td>
								</tr>
								<?php } ?>
							</table> 
							</div>
						</li>
						<li id="li_21" >
							<div class="left"><label class="description" for="element_21">Kepada :</label></div>
							<div>
								<table>
								<?php 
										foreach($penerima as $row)
										{
											echo '<tr>';
											echo '<td>';
											echo '- '.$row->NAMA_DINAS;
											echo '</td>';
											echo '</tr>';
										}
									?>
								</table>
									
								</p>
							</div>
						</li>
						<li>
							<div class="left"><label class="description">Tanggal Surat :</label></div>
							<div>
								<p><?php if($tgl_surat != null) echo $tgl_surat; else echo '-';?></p>
							</div>
							
						</li>
						
						<li id="li_14" >
							<div class="left"><label class="description" for="element_14">Jumlah Lampiran :</label></div>
							<div>
								<p><?php if($lampiran != null) echo $lampiran; else echo '-';?></p>			
							</div>
							
						</li>
						<li id="li_14" >
							<div class="left"><label class="description" for="element_14">Catatan Terima Surat Masuk :</label></div>
							<div>
								<table width="60%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td align="left">
											<p><?php if($catatan != null) echo $catatan; else echo '-';?></p>
										</td>
									</tr>
									<tr>
										<td><br /></td>
									</tr>				
								</table>
							</div>
						</li>
					</div>
				</ul>
			</fieldset>
			<?php if(count($komentar)>0) { ?>
			<fieldset>
			<legend><label><b>| Komentar |</b></label></legend>
				<?php foreach($komentar as $row) {?>
				<li id="li_14" >
					<div class="left"><label class="description" for="element_14"><?php if($row->KOMENTATOR == 1) echo 'Bagian Umum'; else echo $row->NAMA_DINAS;?> :</label></div>
					<div>
						<table width="60%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="left">
									<p><?php echo $row->KOMENTAR;?></p>
								</td>
							</tr>
							<tr>
								<td><br /></td>
							</tr>				
						</table>
					</div>
				</li>
				<?php } ?>
			</fieldset>
			<?php } ?>
		<?php echo form_close(); ?>
	</div>
<script>
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
