<?php
get_header();
?>

<main>
    <div class="container" style="padding: 100px 0;">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_title('<h1 style="margin-bottom: 2rem; font-family: \'Outfit\', sans-serif;">', '</h1>');
                the_content();
            endwhile;
        else :
            echo '<p>No content found</p>';
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
?>
