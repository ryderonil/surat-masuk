<div id="form_container">
		<div class="title">EDIT PENGGUNA</div>
		
		<?php 
			$attributes = array('class' => 'appnitro');
			echo form_open(uri_string(),$attributes); ?>
			<ul>
			  	<li>
					<?= anchor(site_url('manajemen_pengguna'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Manajemen Pengguna',''); ?>
				</li>
				
				<li id="li_1" >
					<label class="description" for="element_1">Username</label>
					<div>
						<?php if(set_value('username')!='') $username = set_value('username')?>
						<input id="username" name="username" class="element text small" type="text" value="<?php echo $username;?>"/> 
					</div>
					<p class="guidelines" id="guide_1"><small>Username</small></p> 
					<?php echo form_error('username'); ?>
				</li>
				
				<li id="li_14" >
					<label class="description" for="element_14">Password</label>
					<div>
						<input id="password" name="password" class="element text medium" type="password" maxlength="100" /> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Password</small></p> 
					<?php echo form_error('password'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Ulangi Password</label>
					<div>
						<input id="ulangi_password" name="ulangi_password" class="element text medium" type="password" maxlength="100" /> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Ulangi Password</small></p> 
					<?php echo form_error('ulangi_password'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Nama Lengkap</label>
					<div>
						<?php if(set_value('nama')!='') $nama = set_value('nama')?>
						<input id="nama" name="nama" class="element text medium" type="text" maxlength="100" value="<?php echo $nama;?>"/> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Nama Lengkap</small> 
					<?php echo form_error('nama'); ?></p>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Grup Pengguna</label>
					<div>
						<?php if(set_value('grup')!=0) $grup_dipilih = set_value('grup')?>
						<?php 
								$options = array(
												'0' => '-- Pilih Grup --',
												'1' => 'Administrator',
												'2' => 'Asisten',
												'3' => 'Sekretaris',
												'4' => 'Wakil Bupati',
												'5' => 'Bupati',
												'6' => 'Dinas'
											);
								echo form_dropdown('grup',$options,$grup_dipilih, 'class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Grup Pengguna</small></p> 
					<?php echo form_error('grup'); ?>
				</li>
				<li id="li_21" >
					<label class="description" for="element_21">Jabatan</label>
					<div>
					<div>
						<?php if(set_value('jabatan')!=0) $jabatan_dipilih = set_value('jabatan')?>
						<?php 
							echo form_dropdown('jabatan',$jabatan,$jabatan_dipilih, 'id="jabatan" class="element select medium"');
						?>
					</div>
					<p class="guidelines" id="guide_21"><small>Jabatan</small></p>
					<?php echo form_error('jabatan'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Email</label>
					<div>
						<?php if(set_value('email')!='') $email = set_value('email')?>
						<input id="Email" name="email" class="element text medium" type="text" maxlength="100" value="<?php echo $email;?>" /> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Email</small></p> 
					<?php echo form_error('email'); ?>
				</li>
				
				<li id="li_14" >
					<label class="description" for="element_14">No HP</label>
					<div>
						<?php if(set_value('handphone')!='') $handphone = set_value('handphone')?>
						<input id="handphone" name="handphone" class="element text medium" type="text" maxlength="100" value="<?php echo $handphone;?>"/> 					
					</div>
					<p class="guidelines" id="guide_14"><small>No HP</small></p> 
					<?php echo form_error('handphone'); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Status</label>
					<div>
						<?php 
								$options = array(
												'1' => 'Aktif',
												'2' => 'Tidak Aktif'
											);
								echo form_dropdown('status_user',$options,$status_user, 'class="element select medium"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Status</small></p> 
					<?php echo form_error('status_user'); ?>
				</li>
				<li>
					<input id="submit-button" type="submit" name="daftar_warna" value="Perbarui" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('manajemen_pengguna')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">		
		Ext.onReady(function(){
			var jabatan = new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				transform:'jabatan',
				width: 340,
				forceSelection: false
			});
		}	
	);
	</script>
	
