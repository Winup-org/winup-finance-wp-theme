<?php
/**
 * Template Name: About Page
 * 
 * @package Winup_Finance
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <article class="page-content page-about">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <!-- Main Content -->
            <div class="about-content">
                <?php the_content(); ?>
            </div>

            <!-- Mission Section (optional placeholder) -->
            <?php if (empty(get_the_content())) : ?>
            <div class="about-sections">
                
                <section class="about-mission">
                    <h2>Our Mission</h2>
                    <p>We're dedicated to providing accurate, actionable financial information to help you make better decisions about your money.</p>
                </section>

                <section class="about-values">
                    <h2>Our Values</h2>
                    <div class="values-grid">
                        <div class="value-item">
                            <span class="value-icon">🎯</span>
                            <h3>Accuracy</h3>
                            <p>We verify all information before publishing.</p>
                        </div>
                        <div class="value-item">
                            <span class="value-icon">🔒</span>
                            <h3>Trust</h3>
                            <p>Your financial security is our priority.</p>
                        </div>
                        <div class="value-item">
                            <span class="value-icon">📚</span>
                            <h3>Education</h3>
                            <p>We simplify complex financial topics.</p>
                        </div>
                        <div class="value-item">
                            <span class="value-icon">⚡</span>
                            <h3>Timeliness</h3>
                            <p>Breaking news when it matters most.</p>
                        </div>
                    </div>
                </section>

                <section class="about-trust">
                    <h2>Why Trust Us</h2>
                    <div class="trust-badges">
                        <div class="trust-badge">
                            <strong>10M+</strong>
                            <span>Monthly Readers</span>
                        </div>
                        <div class="trust-badge">
                            <strong>500+</strong>
                            <span>Expert Articles</span>
                        </div>
                        <div class="trust-badge">
                            <strong>5★</strong>
                            <span>Reader Rating</span>
                        </div>
                    </div>
                </section>

            </div>
            <?php endif; ?>

        </article>

    </div>
</main>

<?php
get_footer();
