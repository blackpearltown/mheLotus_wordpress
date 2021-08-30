<?php get_header(); ?>

<section>
    <div class="home-banner">
        <div id="banner" class="banner-slick">
            <div class="normal_banner">
                <?php echo do_shortcode('[slick-slider design="prodesign-10" show_title="false" image_size="full" dots="false" arrows="false" limit="5" orderby="ID" order="asc" category="68"]'); ?>
            </div>
            <div class="tablet_banner">
                <?php echo do_shortcode('[slick-slider design="prodesign-10" show_title="false" image_size="full" dots="false" arrows="false" limit="5" orderby="ID" order="asc" category="104"]') ?>
            </div>
            <div class="smartphone_banner">
                <?php echo do_shortcode('[slick-slider design="prodesign-10" show_title="false" image_size="full" dots="false" arrows="false" limit="5" orderby="ID" order="asc" category="103"]') ?>
            </div>
        </div>
</section>

<section class="home-slideshow">
    <?php echo do_shortcode('[slick-carousel-slider  design="prodesign-15" show_title="false" show_read_more="false" sliderheight="250" image_size="full" dots="false" arrow_design="design-8" focus_pause="true" limit="6" orderby="ID" order="asc" category="69"]'); ?>
</section>

<section>
    <article>
        <!----------------DISCOVERY MORE------------------>
        <div class="container-discovery">
            <div class="home-discovery">
                <?php $getposts = new WP_query(); $getposts->query('post_status=publish&post_type=block-discovery'); ?>
                <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                    <?php
                        $discovery_title = get_field('title_discovery', get_the_ID());
                        $discovery_desc = get_field('desc_discovery', get_the_ID());
                        $discovery_button = get_field('button_discovery', get_the_ID());
                    ?>
                <div class="discovery-desc">
                    <?php echo $discovery_title ;?>
                    <?php echo $discovery_desc ;?>
                    <?php echo $discovery_button ;?>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <div class="iframe-wrapper">
                    <iframe src="https://www.youtube.com/embed/MKu2yEM6Pas" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                </div>
            </div>
        </div>
        <!-------------------ABOUT US--------------------->
        <div class="container-about">
            <div class="home-about col-12 col-sm-12 col-md-12">
                <div class="home-about-text">
                    <h2>About Us</h2>
                </div>
                <div class="about-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/about.jpg">
                </div>
                <?php $getposts = new WP_query(); $getposts->query('post_status=publish&post_type=block-about'); ?>
                <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                    <?php
                        $about_title = get_field('desc_about', get_the_ID());
                        $about_button = get_field('button_about', get_the_ID());
                    ?>
                <div class="about-desc">
                    <?php echo $about_title ;?>
                    <?php echo $about_button ;?>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

    </article>
</section>
<?php get_footer(); ?>