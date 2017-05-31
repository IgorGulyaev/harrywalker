<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

get_header('shop');
?>

<div class="row">
    

        <header id="title_bread_wrap" class="entry-header">
            <div class="ak-container">		
                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

                    <h1 class="entry-title ak-container"><?php woocommerce_page_title(); ?></h1>

                <?php endif; ?>

                <?php
                /**
                 * woocommerce_before_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action('woocommerce_before_main_content');
                ?>


                <?php do_action('woocommerce_archive_description'); ?>
            </div>
        </header>
        <div class="inner">
            <div class="ak-container left-sidebar">
                <?php
                /**
                 * woocommerce_sidebar hook
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 * 
                 */
                ?>

                <div id="primary" class="content-area clearfix">
                    <div class="content-inner">
                        <div class="col-sm-<?php echo (!is_active_sidebar('sidebar-shop') ) ? '12' : '9'; ?>">
                        <?php if (have_posts()) : ?>

                            <?php
                            /**
                             * woocommerce_before_shop_loop hook
                             *
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            do_action('woocommerce_before_shop_loop');
                            ?>
                            <div class="clearfix"></div>
                            <div class="wc-products">
                                <?php woocommerce_product_loop_start(); ?>

                                <?php woocommerce_product_subcategories(); ?>

                                <?php while (have_posts()) : the_post(); ?>

                                    <?php wc_get_template_part('content', 'product'); ?>

                                <?php endwhile; // end of the loop.  ?>

                                <?php woocommerce_product_loop_end(); ?>
                            </div>
                            
                            <?php
                            /**
                             * woocommerce_after_shop_loop hook
                             *
                             * @hooked woocommerce_pagination - 10
                             */
                            do_action('woocommerce_after_shop_loop');
                            ?>

                        <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                            <?php wc_get_template('loop/no-products-found.php'); ?>

                        <?php endif; ?>
                            </div>
                        
                        <?php
                        get_sidebar( 'shop' );
                        /**
                         * woocommerce_after_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action('woocommerce_after_main_content');
                        ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
    

    
    <div class="clear"></div>
</div>

<?php get_footer('shop'); ?>