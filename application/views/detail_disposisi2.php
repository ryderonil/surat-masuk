<div id="form_container">
		<div class="title">DETAIL DISPOSISI</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'detail_surat_masuk');
			echo form_open('',$attributes); ?>
			<div>
				<?= anchor(site_url('surat_masuk/grid_surat_disposisi'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'<b>Kembali Ke Daftar Surat Masuk Disposisi</b>',''); ?>
			</div>
			<br />
			<fieldset>
			<legend><label><b>| Detail Disposisi |</b></label></legend>
				<ul>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Nomor Surat :</label></div>
						<div>
							<p><?php if(isset($nomor))echo $nomor;?></p>					
						</div>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Disposisi Dari :</label></div>
						<div>
							<p><?php if(isset($disposisi_dari))echo $disposisi_dari;?></p>					
						</div>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Tanggal Disposisi :</label></div>
						<div>
							<p><?php if(isset($tgl_disposisi))echo $tgl_disposisi;?></p>					
						</div>
					</li>
					<li id="li_21" >
						<div class="left"><label class="description" for="element_21">Urgensi :</label></div>
						<div>
							<p><?php if(isset($urgensi))echo $urgensi;?></p>
						</div>
					</li>					
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Penerima :</label></div>
						<div>
							<table width="60%" border="0" cellspacing="0" cellpadding="0">
							<?php foreach($penerima as $row) {?>
							<tr>
								<td align="left">
									<p>- <?php echo $row->NAMA_DINAS;?></p>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<td><br /></td>
							</tr>
							
							</table> 
						</div>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">File Disposisi :</label></div>
						<div>
							<table width="60%" border="0" cellspacing="0" cellpadding="0">
							
							<tr>
								<td align="left">
									<p>
										<a class="downloadBtn purple" href="<?php echo base_url().'index.php/surat_masuk/download2/'.$surat_masuk_id.'/'.$this->session->userdata('iduser');?>"><span><strong>Download</strong><?php echo $file_disposisi_surat_masuk;?></span></a>
									</p>
								</td>
							</tr>
							<tr>
								<td><br /></td>
							</tr>
							
							</table> 
						</div>
					</li>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14">Catatan Disposisi :</label></div>
						<div>
							<p><?php if(isset($catatan_disposisi))echo $catatan_disposisi;?></p>
						</div>
					</li>
				</ul>
			</fieldset>
			<?php 
			echo form_close();
			echo form_open('surat_masuk/d3_process',$attributes); 
			?>
			<fieldset>
			<legend><label><b>| Komentar |</b></label></legend>
			
				<?php 
				if(count($komentar_disposisi) > 0)
				{
					foreach($komentar_disposisi as $row) {?>
					<li id="li_14" >
						<div class="left"><label class="description" for="element_14"><?php echo $row->NAMA_DINAS.' &nbsp&nbsp <i>('.date("d-m-Y G:i:s", strtotime($row->TGL_KOMENTAR)).')</i> ';?> : </label></div>
						<div>
							<p><?php echo $row->KOMENTAR_DISPOSISI;?></p>	
						</div>
					</li>
				<?php } 
				}
				?>				
				<li id="li_14" >
					<label class="description" for="element_14">Komentar</label>
					<div>
						<?php 
							$data = array(
										'name'        => 'komentar_disposisi',
										'id'          => 'komentar_disposisi',
										'value'       => set_value('komentar_disposisi'),
										'class'       => 'element textarea medium',
										'cols'		  => '200'
									);
							echo form_textarea($data);
							echo form_hidden('disposisi_id',$disposisi_id);
							echo form_hidden('surat_masuk_id',$surat_masuk_id);
						?> 					
					</div>
				</li>
				<li>
					<div>
						<input id="submit-button" type="submit" name="daftar_warna" value="Tambah" />
						<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
					</div>
				</li>
			</fieldset>
		<?php echo form_close(); ?>
	</div>
