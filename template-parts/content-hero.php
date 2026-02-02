<?php
/**
 * Template part for displaying the Hero post (First post)
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wsj-hero'); ?>>
    <div class="wsj-hero-inner">
        <div class="wsj-hero-image">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('winup-hero', array('class' => 'hero-img')); ?>
                <?php else : ?>
                     <div class="wsj-placeholder-hero">
                        <span class="placeholder-brand">WINUP FINANCE</span>
                     </div>
                <?php endif; ?>
            </a>
        </div>

        <div class="wsj-hero-content">
            <div class="wsj-meta-top">
                <span class="cat-label"><?php the_category(' / '); ?></span>
            </div>
            
            <?php the_title(sprintf('<h2 class="wsj-hero-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
            
            <div class="wsj-hero-excerpt">
                <?php the_excerpt(); ?>
            </div>

            <div class="wsj-meta-bottom">
                <span class="byline">By <?php the_author(); ?></span>
                <span class="posted-on"><?php echo get_the_date(); ?></span>
            </div>
        </div>
    </div>
</article>
