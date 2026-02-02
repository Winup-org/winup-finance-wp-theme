<?php
/**
 * Template Name: Contact Page
 * 
 * @package Winup_Finance
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <article class="page-content page-contact">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <div class="contact-wrapper">
                
                <!-- Contact Form Area -->
                <div class="contact-form-area">
                    <?php the_content(); ?>
                    
                    <?php if (empty(get_the_content())) : ?>
                    <div class="contact-placeholder">
                        <p>Add a contact form using a plugin like <strong>Contact Form 7</strong> or <strong>WPForms</strong>.</p>
                        <p>Simply edit this page and add your form shortcode.</p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Contact Info Sidebar -->
                <aside class="contact-info">
                    <div class="contact-info-box">
                        <h3>Get in Touch</h3>
                        
                        <div class="contact-item">
                            <span class="contact-icon">📧</span>
                            <div>
                                <strong>Email</strong>
                                <p>contact@example.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <span class="contact-icon">🏢</span>
                            <div>
                                <strong>Address</strong>
                                <p>123 Finance Street<br>New York, NY 10001</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <span class="contact-icon">⏰</span>
                            <div>
                                <strong>Business Hours</strong>
                                <p>Mon - Fri: 9AM - 5PM EST</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-social">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#" aria-label="Twitter">𝕏</a>
                            <a href="#" aria-label="Facebook">f</a>
                            <a href="#" aria-label="LinkedIn">in</a>
                        </div>
                    </div>
                </aside>

            </div>
        </article>

    </div>
</main>

<?php
get_footer();
