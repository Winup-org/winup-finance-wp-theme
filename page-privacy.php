<?php
/**
 * Template Name: Privacy Policy
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
                    <p><strong>Note:</strong> Edit this page to add your Privacy Policy content.</p>
                    
                    <h2>1. Information We Collect</h2>
                    <p>Describe what personal information you collect from visitors.</p>
                    
                    <h2>2. How We Use Your Information</h2>
                    <p>Explain how you use the collected information.</p>
                    
                    <h2>3. Cookies and Tracking</h2>
                    <p>Describe your use of cookies and tracking technologies.</p>
                    
                    <h2>4. Third-Party Services</h2>
                    <p>List any third-party services that may collect data (Google Analytics, ad networks, etc.).</p>
                    
                    <h2>5. Your Rights</h2>
                    <p>Explain user rights regarding their data (GDPR, CCPA compliance).</p>
                    
                    <h2>6. Contact Us</h2>
                    <p>Provide contact information for privacy-related inquiries.</p>
                </div>
                <?php endif; ?>
            </div>

        </article>

    </div>
</main>

<?php
get_footer();
