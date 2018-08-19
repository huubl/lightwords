<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$templates = array( 
  'page-' . $post->post_name . '.twig', 
  'page.twig',
  'index.twig'
);

if (is_front_page()) {

  $args = array(
    'posts_per_page' => 4,
    'orderby' => 'date'
   );
  $context['latest_posts'] = Timber::get_posts($args);

  array_unshift($templates, 'front-page.twig');
}

Timber::render( $templates, $context );
