<?php
	$kode_role = $this->session->userdata('kode_role');
?>

<div class="border_content">
	<div class="title">STATUS SURAT</div>
	<div class="inner_content">
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'detail_surat_masuk');
			echo form_open('',$attributes); ?>
		<div>
			<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'<b>Kembali Ke Daftar Surat Masuk</b>',''); ?>
		</div>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$i = 0;
						if(count($data_penerima_disposisi) > 0) {
						foreach($data_penerima_disposisi as $penerima) {?>
						<tr>
							<td>
								<p><?php echo $penerima;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima[$i];?>
							</td>
							<?php if(isset($success_sign[$i])) echo $success_sign[$i];?>
						</tr>
						<?php 
						$i++;
						} 
						} else { ?>
						<tr>
							<td>
								<p>-</p>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php if(count($data_penerima_disposisi_w) > 0) {?>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi oleh Wakil Bupati |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$j = 0;
						
						foreach($data_penerima_disposisi_w as $terima_dr_w) {?>
						<tr>
							<td>
								<p><?php echo $terima_dr_w;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima_w[$j];?>
							</td>
							<?php if(isset($success_sign_w[$j])) echo $success_sign_w[$j];?>
						</tr>
						<?php 
						$j++;
						} ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php } ?>
		<?php if(count($data_penerima_disposisi_s) > 0) {?>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi oleh Sekretaris |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$j = 0;
						
						foreach($data_penerima_disposisi_s as $terima_dr_s) {?>
						<tr>
							<td>
								<p><?php echo $terima_dr_s;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima_s[$j];?>
							</td>
							<?php if(isset($success_sign_s[$j])) echo $success_sign_s[$j];?>
						</tr>
						<?php 
						$j++;
						} ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php } ?>
		<?php if(count($data_penerima_disposisi_a1) > 0) {?>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi oleh Asisten I |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$j = 0;
						
						foreach($data_penerima_disposisi_a1 as $terima_dr_a1) {?>
						<tr>
							<td>
								<p><?php echo $terima_dr_a1;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima_a1[$j];?>
							</td>
							<?php if(isset($success_sign_a1[$j])) echo $success_sign_a1[$j];?>
						</tr>
						<?php 
						$j++;
						} ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php } ?>
		<?php if(count($data_penerima_disposisi_a2) > 0) {?>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi oleh Asisten II |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$k = 0;
						
						foreach($data_penerima_disposisi_a2 as $terima_dr_a2) {?>
						<tr>
							<td>
								<p><?php echo $terima_dr_a2;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima_a2[$k];?>
							</td>
							<?php if(isset($success_sign_a2[$k])) echo $success_sign_a2[$k];?>
						</tr>
						<?php 
						$k++;
						} ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php } ?>
		<?php if(count($data_penerima_disposisi_a3) > 0) {?>
		<br />
		<fieldset>
		<legend><label><b>| Disposisi oleh Asisten III |</b></label></legend>
		<ul>
			<li>
				<div class="left"><label class="description" for="element_14">Penerima :</label></div>
				
				<div>
					<table align="left">
						<?php 
						$l = 0;
						
						foreach($data_penerima_disposisi_a3 as $terima_dr_a3) {?>
						<tr>
							<td>
								<p><?php echo $terima_dr_a3;?></p>
							</td>
							<td>
								<p> --> </p>
							</td>
							<td>
								<?php echo $status_terima_a3[$l];?>
							</td>
							<?php if(isset($success_sign_a3[$l])) echo $success_sign_a3[$l];?>
						</tr>
						<?php 
						$l++;
						} ?>
					</table>
				</div>
			</li>
		</ul>
		</fieldset>
		<?php } ?>
		<?php echo form_close();?>
	</div>
</div>
