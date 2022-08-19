<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 

if(get_field('header', 'options')) { the_field('header', 'options'); }

if(get_field('custom_css')) { 
?> 
<style>
<?php the_field('custom_css'); ?>
</style>
<?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if(get_field('body','options')) { the_field('body','options'); } ?>
<div class="blank-space"></div>
<header class="position-relative pt-3 z-3 box-shadow bg-white w-100" style="top:0;left:0;">

<div class="nav">
<div class="container">
<div class="row align-items-center justify-content-between pb-4">
<div class="col-lg-3 col-md-6">
<a href="<?php echo home_url(); ?>">
<?php 
$logo = get_field('logo','options'); 
if($logo){
echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto']); 
}

echo '</a>';
echo '</div>';

echo '<div class="col-lg-4 col-6">';
echo get_search_form();
echo '</div>';


echo '<div class="col-lg-4 col-6 desktop-hidden">';
echo '<a id="navToggle" class="nav-toggle">';
echo '<div>';
echo '<div class="line-1 bg-accent"></div>';
echo '<div class="line-2 bg-accent"></div>';
echo '<div class="line-3 bg-accent"></div>';
echo '</div>';
echo '</a>';
echo '</div>';

echo '</div>';
echo '</div>';

echo '<div class="bg-accent-secondary w-100">';

wp_nav_menu(array(
    'menu' => 'primary',
    'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center mb-0'
    )); 

echo '</div>';

echo '<div id="navMenuOverlay" class="position-fixed z-2"></div>';
echo '<div class="col-md-9 nav-items bg-white desktop-hidden" id="navItems">';

echo '<div class="pt-5 pb-5">';
echo '<div class="close-menu">';
echo '<div>';
echo '<span id="navMenuClose" class="close h1">X</span>';
echo '</div>';
echo '</div>';
echo '<a href="' . home_url() . '">';

$logo = get_field('logo','options'); 
if($logo){
echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto','style'=>'max-width:250px;']);
}

echo '</a>';
echo '</div>';

wp_nav_menu(array(
'menu' => 'primary',
'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center mb-0'
)); 

echo '</div>';


echo '</div>';

echo '</header>';

echo '<section class="hero position-relative">';
$globalPlaceholderImg = get_field('global_placeholder_image','options');
if(is_page()){
if(has_post_thumbnail()){
the_post_thumbnail('full', array('class' => 'w-100 h-100 bg-img position-absolute'));
} else {
echo wp_get_attachment_image($globalPlaceholderImg['id'],'full','',['class'=>'w-100 h-100 bg-img position-absolute']);
}
} else {
echo wp_get_attachment_image($globalPlaceholderImg['id'],'full','',['class'=>'w-100 h-100 bg-img position-absolute']);
}


if(is_front_page()) {

if(have_rows('header')): while(have_rows('header')): the_row();
    $gallery = get_field('gallery');
    if( $gallery ): 
    foreach( $gallery as $image ):
    echo '<div class="col-lg-3 col-md-4 col-6 col col-portfolio mt-3 mb-3 overflow-h">';
    echo '<div class="position-relative">';
    echo '<a href="' . wp_get_attachment_image_url($image['id'], 'full') . '" data-lightbox="image-set">';
    echo wp_get_attachment_image($image['id'], 'full','',['class'=>'w-100 img-portfolio'] );
    echo '</a>';
    echo '</div>';
    echo '</div>';
    endforeach; 
    endif;

endwhile; endif;

echo '<div class="pt-5 pb-5 text-white text-center">';
echo '<div class="position-relative">';
echo '<div class="multiply overlay position-absolute w-100 h-100 bg-img"></div>';
echo '<div class="position-relative">';
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12">';
echo '<h1 class="pt-3 pb-3 mb-0">' . get_the_title() . '</h1>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}



if(!is_front_page()) {
echo '<div class="container pt-5 pb-5 text-white text-center">';
echo '<div class="row">';
echo '<div class="col-md-12">';
if(is_page() || !is_front_page()){
echo '<h1 class="">' . get_the_title() . '</h1>';
} elseif(is_single()){
echo '<h1 class="">' . get_single_post_title() . '</h1>';
} elseif(is_author()){
echo '<h1 class="">Author: ' . get_the_author() . '</h1>';
} elseif(is_tag()){
echo '<h1 class="">' . get_single_tag_title() . '</h1>';
} elseif(is_category()){
echo '<h1 class="">' . get_single_cat_title() . '</h1>';
} elseif(is_archive()){
echo '<h1 class="">' . get_archive_title() . '</h1>';
}
echo '</div>';
echo '</div>';
echo '</div>';
}

echo '</section>';
?>