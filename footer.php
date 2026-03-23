<?php
// Fetch Footer ACF Fields safely
$f_logo = function_exists('get_field') ? get_field('footer_logo', 'option') : null;
$f_desc = function_exists('get_field') ? get_field('footer_description', 'option') : '';
$f_social = function_exists('get_field') ? get_field('footer_social', 'option') : null;

$col2_title = function_exists('get_field') ? get_field('footer_col2_title', 'option') : '';
$col3_title = function_exists('get_field') ? get_field('footer_col3_title', 'option') : '';
$col3_links = function_exists('get_field') ? get_field('footer_col3_links', 'option') : null;
$col4_title = function_exists('get_field') ? get_field('footer_col4_title', 'option') : '';
$col4_desc = function_exists('get_field') ? get_field('footer_col4_desc', 'option') : '';

$copyright = function_exists('get_field') ? get_field('footer_copyright', 'option') : '';
$btm_links = function_exists('get_field') ? get_field('footer_bottom_links', 'option') : null;

// Provide default fallbacks if fields are empty
$f_desc = $f_desc ?: '';
$col2_title = $col2_title ?: '';
$col3_title = $col3_title ?: '';
$col4_title = $col4_title ?: '';
$col4_desc = $col4_desc ?: '';
$copyright = $copyright ?: '';
?>
    <footer>
        <div class="container">
            <div class="footer-main">
                <div class="footer-col">
                    <?php if ($f_logo): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" style="margin-bottom: 1.5rem; display: inline-block;">
                            <?php echo wp_get_attachment_image($f_logo['ID'], 'header-logo'); ?>
                        </a>
                    <?php
else: ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" style="color: white; margin-bottom: 1.5rem; display: inline-block;">WP<span>Services</span></a>
                    <?php
endif; ?>
                    
                    <p><?php echo esc_html($f_desc); ?></p>
                    
                    <div class="social-links" style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                        <?php if ($f_social): ?>
                            <?php foreach ($f_social as $social): ?>
                                <a href="<?php echo esc_url($social['url']); ?>"><i class="<?php echo esc_attr($social['icon']); ?>"></i></a>
                            <?php
    endforeach; ?>
                        <?php
else: ?>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#"><i class="fa-brands fa-github"></i></a>
                        <?php
endif; ?>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h4><?php echo esc_html($col2_title); ?></h4>
                    <?php
// Display WordPress Menu for Column 2
if (has_nav_menu('footer')) {
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => '',
    ));
}
else {
    echo '<ul><li><a href="#home">Home</a></li><li><a href="#portfolio">Our Work</a></li><li><a href="#services">Services</a></li><li><a href="#contact">Contact</a></li></ul>';
}
?>
                </div>
                
                <div class="footer-col">
                    <h4><?php echo esc_html($col3_title); ?></h4>
                    <ul>
                        <?php if ($col3_links): ?>
                            <?php foreach ($col3_links as $link): ?>
                                <li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a></li>
                            <?php
    endforeach;
                       
endif; ?>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4><?php echo esc_html($col4_title); ?></h4>
                    <p><?php echo esc_html($col4_desc); ?></p>
                  <?php echo do_shortcode('[wpforms id="94"]'); ?>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html($copyright); ?></p>
                <div class="footer-links">
                    <?php if ($btm_links): ?>
                        <?php foreach ($btm_links as $link): ?>
                            <a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a>
                        <?php
    endforeach; ?>
                    <?php
else: ?>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookies</a>
                    <?php
endif; ?>
                </div>
            </div>
        </div>

    </footer>
    <?php wp_footer(); ?>
</body>
</html>
