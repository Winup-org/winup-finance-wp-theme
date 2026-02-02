<?php
/**
 * Template part for displaying List posts (News Feed layout)
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wsj-list-item'); ?>>
    <div class="wsj-list-inner">
        <?php if (has_post_thumbnail()) : ?>
            <div class="wsj-list-image">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('thumbnail', array('class' => 'list-thumb')); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="wsj-list-content">
            <div class="wsj-list-header">
                <span class="cat-label-micro"><?php 
                    $cats = get_the_category();
                    echo $cats ? esc_html($cats[0]->name) : ''; 
                ?></span>
                <span class="wsj-list-date"><?php echo get_the_date('M j'); ?></span>
            </div>

            <?php the_title(sprintf('<h4 class="wsj-list-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>'); ?>
            
            <div class="wsj-list-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
            </div>
        </div>
    </div>
</article>
