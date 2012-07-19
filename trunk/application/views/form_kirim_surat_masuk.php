<div id="form_container">
		<div class="title">KIRIM SURAT</div>
		
		<?php 
			$attributes = array('class' => 'appnitro', 'name' => 'form_disposisi');
			echo form_open_multipart(uri_string(),$attributes); ?>
			<ul>			
			  	<li>
					<?= anchor(site_url('surat_masuk'),img(array('src'=>'images/flexigrid/prev.gif','border'=>'0','alt'=>'')).'Kembali Ke Daftar Surat Masuk',''); ?>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Nomor Surat</label>
					<div>
						<p><?php echo $nomor;?></p> 					
					</div>
					<p class="guidelines" id="guide_14"><small>Nomor</small></p>
				</li>
				<li id="li_14" >
					<label class="description" for="element_14">Penerima</label>
					<div>
						<?php
							echo form_multiselect('penerima[]',$penerima,set_value('penerima'), 'id="penerima" class="element select small" multiple="multiple" size="'.$size.'"');
						?>					
					</div>
					<p class="guidelines" id="guide_14"><small>Penerima</small></p> 
					<?php echo form_error('penerima'); ?>
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
					<input id="submit-button" type="submit" name="daftar_warna" value="Kirim" />
					<input id="submit-button" type="button" name="batal" value="Batal" onClick="location.href='<?php echo site_url('surat_masuk')?>'"/>
				</li>
			</ul>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
	$(document).ready( function() {
			$("#penerima").multiSelect({
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
