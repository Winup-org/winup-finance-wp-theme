<?php
/**
 * Template Name: Terms of Service
 * 
 * @package Winup_Finance
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <article class="page-content page-legal">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <p class="page-updated">Last Updated: <?php echo get_the_modified_date('F j, Y'); ?></p>
            </header>

            <div class="legal-content">
                <?php the_content(); ?>
                
                <?php if (empty(get_the_content())) : ?>
                <div class="legal-placeholder">
                    <p><strong>Note:</strong> Edit this page to add your Terms of Service content.</p>
                    
                    <h2>1. Acceptance of Terms</h2>
                    <p>By accessing this website, you agree to be bound by these Terms of Service.</p>
                    
                    <h2>2. Use of Content</h2>
                    <p>Describe permitted and prohibited uses of your content.</p>
                    
                    <h2>3. Disclaimer</h2>
                    <p>The information provided on this website is for general informational purposes only and should not be considered as financial advice.</p>
                    
                    <h2>4. Limitation of Liability</h2>
                    <p>Outline limitations on your liability for damages.</p>
                    
                    <h2>5. Intellectual Property</h2>
                    <p>Describe ownership of content, trademarks, and copyrights.</p>
                    
                    <h2>6. Changes to Terms</h2>
                    <p>Reserve the right to modify these terms at any time.</p>
                    
                    <h2>7. Governing Law</h2>
                    <p>Specify the jurisdiction that governs these terms.</p>
                </div>
                <?php endif; ?>
            </div>

        </article>

    </div>
</main>

<?php
get_footer();
