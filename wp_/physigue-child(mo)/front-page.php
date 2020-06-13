<?php
/**
 *
 * @package Physique
 */

get_header(); 
       
if (!is_home() && is_front_page()) {
	$hideslide = get_theme_mod('hide_slider', '1');
	 if($hideslide == ''){   
$pages = array();
for($sld=7; $sld<10; $sld++) { 
	$mod = absint( get_theme_mod('page-setting'.$sld));
    if ( 'page-none-selected' != $mod ) {
      $pages[] = $mod;
    }	
} 
if( !empty($pages) ) :
$args = array(
      'posts_per_page' => 3,
      'post_type' => 'page',
      'post__in' => $pages,
      'orderby' => 'post__in'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :	
	$sld = 7;
?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
		<?php
        $i = 0;
        while ( $query->have_posts() ) : $query->the_post();
          $i++;
          $physique_slideno[] = $i;
          $physique_slidetitle[] = get_the_title();
		  $physique_slidedesc[] = get_the_excerpt();
          $physique_slidelink[] = esc_url(get_permalink());
          ?>
          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" />
          <?php
        $sld++;
        endwhile;
          ?>
    </div>
        <?php
        $k = 0;
        foreach( $physique_slideno as $physique_sln ){ ?>
    <div id="slidecaption<?php echo esc_attr( $physique_sln ); ?>" class="nivo-html-caption">
      <div class="top-bar">
        <h2><a href="<?php echo esc_url($physique_slidelink[$k] ); ?>"><?php echo esc_html($physique_slidetitle[$k] ); ?></a></h2>
        <p><?php echo esc_html($physique_slidedesc[$k] ); ?></p>
        <div class="clear"></div>
        <a class="slide-button" href="<?php echo esc_url($physique_slidelink[$k] ); ?>">
          <?php echo esc_html(get_theme_mod('slide_text',__('Read More','physique')));?>
          </a>
      </div>
    </div>
 	<?php $k++;
       wp_reset_postdata();
      } ?>
<?php endif; endif; ?>
  </div>
  <div class="clear"></div>
 <div class="slider-angle">
						<svg viewBox="0 0 1000 110" preserveAspectRatio="none" width="100%" height="110">
  						   <defs>
							<linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
							  <stop offset="0%" style="stop-color:rgb(220,220,220);stop-opacity:1"></stop>
							  <stop offset="100%" style="stop-color:rgb(206,206,206);stop-opacity:1"></stop>
							</linearGradient>
						  </defs>
						  <path d="M-150,133  1150, 133  500,23z" fill="#ffffff"></path>  
						</svg>
     </div><!-- slider-angle -->
</section>
<?php } } 
?>

  <div class="main-container">                                     
       <div class="content-area">
        <div class="middle-align content_sidebar">
            <div class="site-main" id="sitemain">
				<?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part( 'content-page', get_post_format() );
						
                    endwhile;
                    // Previous/next post navigation.
                    the_posts_pagination();
					wp_reset_postdata();
                
                else :
                    // If no content, include the "No posts found" template.
                     get_template_part( 'no-results' );
                
                endif;
                ?>
            </div>
            <?php //get_sidebar();?>
            <div class="clear"></div>
        </div>
    </div>
<?php get_footer(); ?>