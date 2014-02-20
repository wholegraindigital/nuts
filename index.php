<?php get_header(); ?>

<div id="contentWrapper">
    <div id="content" class="backImage">
        <div class="main-content">
            <div class="main-content-inner">
            
				<?php get_template_part ( 'parts/loop' ); ?>
				<?php nuts_image_object ("image1", "medium"); ?>
				<?php echo nuts_get_text("text1"); ?>
				<?php nuts_text("text1"); ?>
				<?php echo "The sky is " . nuts_get_select("select1"); ?>
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