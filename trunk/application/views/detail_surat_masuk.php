<div id="form_container">
		<div class="title">DETAIL SURAT MASUK</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'detail_surat_masuk');
			echo form_open_multipart('',$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Daftar Surat Masuk',''); ?>
				</li>
				<li id="li_14" >
					<div class="left"><label class="description" for="element_14">Sifat</label></div>
					<div>
						<?php 
							if($sifat == 1)
								$value = 'Reguler';
							else
								$value = 'Rahasia';
						?>
						<p><?php if(isset($value))echo $value;?></p>
					</div>
					<p class="guidelines" id="guide_14"><small>Sifat</small></p>
				</li>
				<li id="li_14" >
					<div class="left"><label class="description" for="element_14">Nomor</label></div>
					<div>
						<p><?php if(isset($nomor))echo $nomor;?></p>					
					</div>
					<p class="guidelines" id="guide_14"><small>Nomor</small></p>
				</li>
				<li>
					<div class="left"><label class="description">Tanggal Terima</label></div>
					<div>
						<p><?php if(isset($tgl_terima))echo $tgl_terima;?></p>					
					</div>
					<p class="guidelines" id="guide_21"><small>Tanggal Terima</small></p>
				</li>
				<li id="li_21" >
					<div class="left"><label class="description" for="element_21">Jenis Surat</label></div>
					<div>
						<p><?php if(isset($jenis_surat))echo $jenis_surat;?></p>
					</div>
					<p class="guidelines" id="guide_21"><small>Jenis Surat</small></p>
				</li>
				<li id="li_21" >
					<div class="left"><label class="description" for="element_21">Dari</label></div>
					<div>
						<p><?php if(isset($dari))echo $dari;?></p>
					</div>
					<p class="guidelines" id="guide_21"><small>Dari</small></p>
				</li>
				<li id="li_14" >
					<div class="left"><label class="description" for="element_14">Perihal</label></div>
					<div>
						<p><?php if($perihal != null) echo $perihal; else echo '-';?></p>
					</div>
					<p class="guidelines" id="guide_14"><small>Perihal</small></p> 
				</li>
				<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Catatan Disposisi</label></div>
						<div>
							<p><?php if($catatan_disposisi != null) echo $catatan_disposisi; else echo '-';?></p>		
						</div>
						<p class="guidelines" id="guide_14"><small>Catatan Disposisi</small></p> 
				</li>
				<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Komentar oleh Dinas</label></div>
						<div>
							<p><?php if($komentar != null) echo $komentar; else echo '-';?></p>		
						</div>
						<p class="guidelines" id="guide_14"><small>Komentar oleh Dinas</small></p> 
				</li>
				<li id="li_1" >
					
					<div class="left"><label class="description" for="element_1">File Surat</label></div>
					<div>
						<table width="60%" border="0" cellspacing="0" cellpadding="0">
						<?php foreach($file_surat_masuk as $row) {?>
						<tr>
							<td align="center">
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
					<p class="guidelines" id="guide_1"><small>File Surat</small></p> 
					</div>
				</li>
				
				<?php if($sifat == 2) $tampilan2 = 'hidden'; else $tampilan2 = 'visible'; ?>
				<div id="hideme" style="visibility:<?php echo $tampilan2;?>;">
					<li id="li_21" >
						<div class="left"><label class="description" for="element_21">Kepada</label></div>
						<div>
							<p><?php if($kepada != null) echo $kepada; else echo '-';?></p>
						</div>
						<p class="guidelines" id="guide_21"><small>Kepada</small></p>
					</li>
					<li>
						<div class="left"><label class="description">Tanggal Surat</label></div>
						<div>
							<p><?php if($tgl_surat != null) echo $tgl_surat; else echo '-';?></p>
						</div>
						<p class="guidelines" id="guide_14"><small>Tanggal Surat</small></p>
					</li>
					
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Lampiran</label></div>
						<div>
							<p><?php if($lampiran != null) echo $lampiran; else echo '-';?></p>			
						</div>
						<p class="guidelines" id="guide_14"><small>Lampiran</small></p>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Catatan Terima Surat Masuk</label></div>
						<div>
							<p><?php if($catatan != null) echo $catatan; else echo '-';?></p>	
						</div>
						<p class="guidelines" id="guide_14"><small>Catatan Terima Surat Masuk</small></p> 
					</li>
				</div>
			</ul>
		<?php echo form_close(); ?>
	</div>
