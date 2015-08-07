<?php
/*
 Plugin Name: Google+ Badge Widget  
 Plugin URI: http://www.wpchandra.com
 Description: Our Google plus badge widget plugin will help you to display Google plus badge widget on your wordpress wesite, just add google plus badge widget to your sidebar and use it. 
 Version: 1.0 
 Author: Chandrakesh Kumar  
 Author URI: http://www.wpchandra.com/ 
 License: GPL3 
 */
  
if (! class_exists( 'WPChandra_google_plus_badge' )){
  
class WPChandra_google_plus_badge extends WP_Widget { 
	function __construct() { 
		parent::__construct(
			'wp_google_plus_widget', // Base ID
			__( 'Google+ Badge Widget', 'wp-google-plus-widget' ), // Name
			array( 'description' => __( 'Display google plus badge widget!', 'wp-google-plus-widget' ), ) // Args
		);
	} 
	
	public function form( $instance ) {

		$defaults = array( 'title' => __('Find us on Google Plus', 'wpchandra'), 'page_type' => 'profile', 'page_url' => '', 'color_scheme' => 'light', 'layout_type' => 'portrait', 'widget_width' => '300', 'show_cover_photo' => 'on', 'show_tagline' => 'on' );
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title','wpchandra' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id('page_type'); ?>"><?php _e('Page type','wpchandra'); ?>:</label> 
			<select id="<?php echo $this->get_field_id('page_type'); ?>" name="<?php echo $this->get_field_name('page_type'); ?>" style="width:100%;">
				<option <?php if ('profile' == $instance['page_type']) echo 'selected="selected"'; ?>>Profile</option>
				<option <?php if ('page' == $instance['page_type']) echo 'selected="selected"'; ?>>Page</option>
				<option <?php if ('community' == $instance['page_type']) echo 'selected="selected"'; ?>>Community</option>
			</select>
		</p>
 
        <p>
            <label
                for="<?php echo $this->get_field_id( 'page_url' ); ?>"><?php _e( 'Google+ Page URL','wpchandra'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'page_url' ); ?>"
                   name="<?php echo $this->get_field_name( 'page_url' ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['page_url'] ); ?>">
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color Scheme','wpchandra'); ?>:</label> 
			<select id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>" style="width:100%;">
				<option <?php if ('light' == $instance['color_scheme']) echo 'selected="selected"'; ?>>Light</option>
				<option <?php if ('dark' == $instance['color_scheme']) echo 'selected="selected"'; ?>>Dark</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('layout_type'); ?>"><?php _e('Layout Type','wpchandra'); ?>:</label> 
			<select id="<?php echo $this->get_field_id('layout_type'); ?>" name="<?php echo $this->get_field_name('layout_type'); ?>" style="width:100%;">
				<option <?php if ('portrait' == $instance['layout_type']) echo 'selected="selected"'; ?>>Portrait</option>
				<option <?php if ('landscape' == $instance['layout_type']) echo 'selected="selected"'; ?>>Landscape</option>
			</select>
		</p>
        
         <p>
            <label for="<?php echo $this->get_field_id( 'widget_width' ); ?>"><?php _e( 'Width', 'wpchandra' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'widget_width' ); ?>"  name="<?php echo $this->get_field_name( 'widget_width' ); ?>" type="text" value="<?php echo esc_attr( $instance['widget_width'] ); ?>">
        </p>
 
        <p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'show_cover_photo' ); ?>"
                   name="<?php echo $this->get_field_name( 'show_cover_photo' ); ?>" type="checkbox"
                    <?php checked( $instance['show_cover_photo'], 'on' ); ?>>
            <label for="<?php echo $this->get_field_id( 'show_cover_photo' ); ?>"><?php _e( 'Show Cover Photo', 'wpchandra' ); ?></label>
        </p>
 
        <p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'show_tagline' ); ?>"
                   name="<?php echo $this->get_field_name( 'show_tagline' ); ?>" type="checkbox"
                    <?php checked( $instance['show_tagline'], 'on' ); ?>>
            <label for="<?php echo $this->get_field_id( 'show_tagline' ); ?>"><?php _e( 'Show Tagline', 'wpchandra' ); ?></label>
        </p>
    <?php
    }



public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']              = strip_tags( $new_instance['title'] );
		$instance['page_type']      = strip_tags( strtolower($new_instance['page_type']));
        $instance['page_url']      = strip_tags( $new_instance['page_url'] );
        $instance['color_scheme'] = strip_tags( strtolower($new_instance['color_scheme']) );
        $instance['layout_type']        = strip_tags( strtolower($new_instance['layout_type']) );
        $instance['widget_width']        = strip_tags( $new_instance['widget_width'] );
		$instance['show_cover_photo']        = $new_instance['show_cover_photo'];
		$instance['show_tagline']        = $new_instance['show_tagline'];
        return $instance;
    }


public function widget( $args, $instance ) {
        $title              = apply_filters( 'widget_title', $instance['title'] );
        $page_type      = $instance['page_type'];
        $page_url = $instance['page_url'];
        $color_scheme        = $instance['color_scheme'];
        $layout_type        = $instance['layout_type'];
		$widget_width        = $instance['widget_width'];
		$show_cover_photo = isset($instance['show_cover_photo']) ? 'true' : 'false';
		$show_tagline = isset($instance['show_tagline']) ? 'true' : 'false';
		
        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
		
		if($page_url): ?>	
			<div <?php if($page_type == 'profile') { ?>class="g-person"<?php } elseif($page_type == 'page') { ?>class="g-page"<?php } elseif($page_type == 'community') { ?>class="g-community"<?php } ?> data-width="<?php echo $widget_width; ?>" data-href="<?php echo $page_url; ?>" data-layout="<?php echo $layout_type; ?>" data-theme="<?php echo $color_scheme; ?>" data-rel="publisher" data-showtagline="<?php echo $show_tagline; ?>" data-showcoverphoto="<?php echo $show_cover_photo; ?>"></div>
			<!-- scripts -->
			<script type="text/javascript">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		<?php endif;
		
        echo $args['after_widget'];
    }

}

// register WPChandra_google_plus_badge widget
function register_wp_google_plus_badge_widget() {
    register_widget( 'WPChandra_google_plus_badge' );
}
add_action( 'widgets_init', 'register_wp_google_plus_badge_widget' );

}



