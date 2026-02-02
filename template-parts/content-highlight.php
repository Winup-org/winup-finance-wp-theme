<?php
/**
 * Template part for displaying Highlight posts (Secondary Grid)
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wsj-highlight-item'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="wsj-highlight-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('winup-grid', array('class' => 'highlight-img')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="wsj-highlight-content">
        <span class="cat-label-small"><?php 
            $cats = get_the_category();
            echo $cats ? esc_html($cats[0]->name) : ''; 
        ?></span>
        
        <?php the_title(sprintf('<h3 class="wsj-highlight-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
        
        <div class="wsj-meta-small">
            <span class="posted-on"><?php echo get_the_date('M j'); ?></span>
        </div>
    </div>
</article>
