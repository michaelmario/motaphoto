<?php get_header();

?>
<div class="W3-container">
    <!-- La partie photo en bg + title de hero header >-->
    <div class="hero-header">
        <?php get_template_part( 'template_parts/carousel'); ?>
    </div>
<?php
//$current_queried_post_type = get_post_type(get_the_ID());

get_template_part( 'template_parts/postPhoto');
?>

<?php get_footer(); ?>