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
						<p><?php echo $nomor;?></p> 					
					</div>
				</li>
				<li>
					<label class="description">Tanggal Disposisi</label>
						<span>
							<div id="newline-wrapper">
								<table class="split-date-wrap" cellpadding="0" cellspacing="0" border="0">
									<tbody>
										<tr>
											<td>
												<input type="text" class="w2em" id="date-9-dd" readonly name="tgl_disposisi" maxlength="2" value="<?php echo $tgl;?>"/>-<label for="date-9-dd">DD</label>
											</td>												
											<td>
												<input type="text" class="w2em" id="date-9-mm"readonly name="bln_disposisi" maxlength="2" value="<?php echo $bln;?>"/>-<label for="date-9-mm">MM</label>
											</td>
											<td>
												<input type="text" class="w4em highlight-days-67 split-date" readonly id="date-9" name="thn_disposisi" maxlength="4" value="<?php echo $thn;?>"/>
												&nbsp;<img src="<?=base_url();?>images/icon/hapus.png" onclick="hapus_tanggal_disposisi();"/>
												<label for="date-9">YYYY</label>
											</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
							<?php echo form_error('tgl_disposisi'); ?>
							<?php echo form_error('bln_disposisi'); ?>
							<?php echo form_error('thn_disposisi'); ?>
						</span>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Urgensi</label>
					<div>
						<?php 
								$options = array(
												'0' => '-- Pilih Urgensi --',
												'1' => 'Biasa',
												'2' => 'Mendesak'
											);
								echo form_dropdown('urgensi',$options,set_value('urgensi'), 'id="urgensi" class="element select medium"');
						?>					
					</div>
					<?php echo form_error('urgensi'); ?>
				</li>
				<li id="li_21">
					<label class="description" for="element_21">Penerima</label>
					<div>
						<?php
							echo form_multiselect('skpd[]',$skpd,set_value('skpd'), 'id="skpd" class="element select small" multiple="multiple" size="5"');
						?>
					</div>
					<?php echo form_error('skpd'); ?>
				</li>
				<li id="li_1" >	
					<label class="description" for="element_1">File Disposisi</label>
						<input id="userfile" name="userfile" class="element file medium" type="file" size="36"/>
					<?php echo form_error('userfile'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Catatan Disposisi</label>
					<div>
						<?php 
							$data = array(
										'name'        => 'catatan_disposisi',
										'id'          => 'catatan_disposisi',
										'value'       => set_value('catatan_disposisi'),
										'class'       => 'element textarea medium',
										'cols'		  => '200'
									);
							echo form_textarea($data);
							echo form_hidden('type',1);
						?>
					</div>
					<?php echo form_error('catatan_disposisi'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Teks SMS</label>
					<div>
						<?php 
							$data = array(
										'name'        => 'teks_sms',
										'id'          => 'teks_sms',
										'value'       => $teks_sms,
										'class'       => 'element textarea medium',
										'cols'		  => '200'
									);
							echo form_textarea($data);
						?>
						
					</div>
					<div>
					Characters :  <p id="counter"></p>
					</div>
					<?php echo form_error('teks_sms'); ?>
				</li>	
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Disposisi" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">	
		function hapus_tanggal_disposisi(){
			document.form_disposisi.tgl_disposisi.value = '';
			document.form_disposisi.bln_disposisi.value = '';
			document.form_disposisi.thn_disposisi.value = '';
		}
	</script>
	<script type="text/javascript">
	$(document).ready( function() {
			$("#skpd").multiSelect({
				selectAll: false,
				noneSelected: 'Pilih Pejabat',
				oneOrMoreSelected: '% pejabat dipilih'
			});
		});
	</script>
	<script type="text/javascript">	
		$(document).ready(function()
		{
			var max_length = 160;
			
			//run listen key press
			whenkeydown(max_length);
		});
 
		whenkeydown = function(max_length)
		{
		    $("#teks_sms").unbind().keyup(function()
		    {
		        //check if the appropriate text area is being typed into
		        if(document.activeElement.id === "teks_sms")
		        {
		            //get the data in the field
		            var text = $(this).val();
		 
		            //set number of characters
		            var numofchars = text.length;
		 
		            if(numofchars <= max_length)
		            {
		                //set the length of the text into the counter span
		                $("#counter").html(text.length);
		            }
		            else
		            {
		                //make sure string gets trimmed to max character length
		                $(this).val(text.substring(0, max_length));
		            }
		        }
			});
		}
	</script>
