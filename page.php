<?php

get_header();
  while (have_posts()) {
    the_post();
    pageBanner(); ?>

<div class="container container--narrow page-section">
  <?php
  $parentPg = wp_get_post_parent_id(get_the_id());
  if ($parentPg){ ?>
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($parentPg); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title(wp_get_post_parent_id(get_the_id())); ?></a><span class="metabox__main"> <?php the_title(); ?></span></p>
  </div>
  <?php
}

   ?>

<?php
    $testArray = get_pages(array(
      'child_of' => get_the_id()
    ));

    if($parentPg or $testArray){
 ?>
  <div class="page-links">
    <h2 class="page-links__title"><a href="<?php echo get_permalink($parentPg); ?>"><?php echo get_the_title($parentPg); ?></a></h2>
    <ul class="min-list">

      <?php
      $findChildren;

      if($parentPg){
        $findChildren = $parentPg;
      }else{
        $findChildren = get_the_id();
      }

        wp_list_pages(array(
          'title_li' => NULL,
          'child_of' => $findChildren
        ));

       ?>
    </ul>
  </div>

<?php } ?>

  <div class="generic-content">
    <p><?php the_content(); ?></p>
  </div>

</div>

<?php
  }

  get_footer();
 ?>
