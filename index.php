<?php get_header(); ?>

<div id="contentWrapper">
    <div id="content" class="backImage">
        <div class="main-content">
            <div class="main-content-inner">
            
				<?php get_template_part ( 'parts/loop' ); ?>
				
            </div>
        </div>
        
        <?php if( is_home() ) { ?>
        <div class="dark-gradient">&nbsp;</div>
		<?php } ?>
    </div>
    
    <span class="previous-img home_pre"></span>
    <span class="next-img home_next"></span>
</div>
    
<?php get_footer(); ?>