<!--  Modal de contact  -->
<div class="w3-container popup">
	<div class="popup-body">
        <button class="w3-button w3-circle" id="close">&times;</button>
		<div class="contact-banner">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/contact-banner.png'; ?>" alt="">
		</div>
		<?php
		// Le formulaire de demandes de renseignements created with Contact Form 7
        echo do_shortcode('[contact-form-7 id="18" title="Formulaire de contact 1"]');
		?>
	</div> 
</div> 

