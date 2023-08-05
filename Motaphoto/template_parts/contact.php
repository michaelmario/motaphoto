<!--  Modal de contact  -->
<div class="w3-container popup">
	<div class="w3-modal-content">
	<header class="w3-container">
     <button class="w3-button w3-circle" id="close">&times;</button>
      <img src="<?php echo get_template_directory_uri() . '/assets/images/images/contact-banner.png'; ?>" alt="">
    </header>
	<div class="w3-container  w3-margin-top w3-padding">		
		<?php
		// Le formulaire de demandes de renseignements created with Contact Form 7
        echo do_shortcode('[contact-form-7 id="18" title="Formulaire de contact 1"]');
		?>
		</div>
	</div> 
</div> 

