<li>
  <a class="cat-list_item" href="#!" data-slug="<?= $category->slug; ?>" data-type="projecten">
    <?= $category->name; ?>
  </a>
</li>
                <div class="img">
                    <a href="<?php echo $permalink; ?>">
                        <img src="<?php echo $pic; ?>" alt="image de mariage">
                    </a>
                

                <div class="overlay">
                    <div class="open-fullscreen" rel="<?php $pic ; ?>">
                        <img rel="<?php echo $pic; ?>" class="fullscreen" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen.svg" alt="Fullscreen">
                    </div>
                    
                    <div class="eye">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/picture-eye.svg" alt="Eye"></a>
                    </div>
                    <div class="links">
                        <p><?php echo the_title(); ?></p>
                        <p><?php echo get_field('category'); ?></p>
                    </div>
                </div>
            </div>
            