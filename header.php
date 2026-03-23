<?php
// Fetch ACF Fields safely
$logo = function_exists('get_field') ? get_field('header_logo', 'option') : null;
$menu = function_exists('get_field') ? get_field('header_menu', 'option') : null;
$btn1_text = function_exists('get_field') ? get_field('button_1_text', 'option') : '';
$btn1_url = function_exists('get_field') ? get_field('button_1_url', 'option') : '';
$btn2_text = function_exists('get_field') ? get_field('button_2_text', 'option') : '';
$btn2_url = function_exists('get_field') ? get_field('button_2_url', 'option') : '';

$btn1_text = $btn1_text ? $btn1_text : '';
$btn1_url = $btn1_url ? $btn1_url : '#';
$btn2_text = $btn2_text ? $btn2_text : '';
$btn2_url = $btn2_url ? $btn2_url : '#';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header>
        <div class="container header-container">
            <?php if ($logo): ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <?php echo wp_get_attachment_image($logo['ID'], 'header-logo'); ?>
                </a>
           <?php
endif; ?>
            
            <ul class="nav-links">
                <li class="mobile-only-btn close-menu-btn" style="text-align: right; padding-bottom: 2rem; margin-top: -30px;">
                    <i class="fa-solid fa-xmark" style="font-size: 2rem; cursor: pointer; color: white;" onclick="document.querySelector('.nav-links').classList.remove('active'); document.getElementById('hamburger').classList.remove('active');"></i>
                </li>

                <?php if ($menu): ?>
                    <?php foreach ($menu as $item): ?>
                        <li class="nav-item">
                            <a href="<?php echo esc_url($item['link_url']); ?>"><?php echo esc_html($item['link_text']); ?> <?php if ($item['submenu']): ?><i class="fa-solid fa-chevron-down"></i><?php
        endif; ?></a>
                            <?php if ($item['submenu']): ?>
                                <ul class="submenu">
                                    <?php foreach ($item['submenu'] as $sub): ?>
                                        <li><a href="<?php echo esc_url($sub['link_url']); ?>"><?php echo esc_html($sub['link_text']); ?></a></li>
                                    <?php
            endforeach; ?>
                                </ul>
                            <?php
        endif; ?>
                        </li>
                    <?php
    endforeach; ?>
                <?php
else: ?>
                    <?php
    if (has_nav_menu('primary')) {
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '%3$s',
        ));
    }
    else {
        echo '<li class="nav-item"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    }
?>
                <?php
endif; ?>

                <li class="nav-item mobile-only-btn"><a href="<?php echo esc_url($btn2_url); ?>" class="btn btn-secondary" style="margin-bottom: 10px;"><?php echo esc_html($btn2_text); ?></a></li>
                <li class="nav-item mobile-only-btn"><a href="<?php echo esc_url($btn1_url); ?>" class="btn btn-primary"><?php echo esc_html($btn1_text); ?></a></li>
            </ul>

            <div class="header-btns">
                <?php if ($btn2_text): ?>
                    <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn-secondary"><?php echo esc_html($btn2_text); ?></a>
                <?php
endif; ?>
                <a href="<?php echo esc_url($btn1_url); ?>" class="btn btn-primary"><?php echo esc_html($btn1_text); ?></a>
                
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>
