<?php
/*
 * Register Widget
 */ 
add_action( 'widgets_init', 'wtnnwm_register_widgets' );
function wtnnwm_register_widgets() {
	
	register_widget( 'wtnnwm_widget' );
}

class wtnnwm_widget extends WP_Widget{
	
	function __construct() {
		
		$widget_ops = array(
			'classname' 	=> 'wtnnwm_widget',
			'description' 	=> __( 'A widget which displays the statistic from a NaNoWriMO user', 'wtnnwm' ),
		);
		parent::__construct( 'wtnnwm_widget', __( 'NaNoWriMO Widget', 'wtnnwm' ), $widget_ops );
	}

	function form( $instance ) {
		
		$defaults = array(
			'title' 			=> __( 'My NaNoWriMO Stats', 'wtnnwm' ),
			'username' 			=> '',
			'format_date' 		=> 'd-m-Y',
			'statistics'		=> 1,				
			'total_words'		=> 1,
			'words_left'		=> 1,
			'words_day_left'	=> 1,
			'words_day'			=> 1,
			'finished'			=> 1,
			
		);
		$instance = wp_parse_args( (array) $instance, $defaults );			
		
		$wtnnwm_title = $instance['title'];
		$wtnnwm_username = $instance['username'];
		$wtnnwm_format_date = $instance['format_date'];
		$wtnnwm_statistics = $instance['statistics'];
		$wtnnwm_words_day = $instance['words_day']; 
		$wtnnwm_total_words = $instance['total_words']; 
		$wtnnwm_words_left = $instance['words_left']; 
		$wtnnwm_words_day_left = $instance['words_day_left']; 
		$wtnnwm_finished = $instance['finished']; 
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wtnnwm' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $wtnnwm_title ); ?>"></p>
		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', 'wtnnwm' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $wtnnwm_username ); ?>"></p>
		<p>
		<input id="<?php echo $this->get_field_id( 'statistics' ); ?>" name="<?php echo $this->get_field_name( 'statistics' ); ?>" type="hidden" value="0">
		<input id="<?php echo $this->get_field_id( 'statistics' ); ?>" name="<?php echo $this->get_field_name( 'statistics' ); ?>" type="checkbox" value="1" <?php checked( 1, $wtnnwm_statistics ); ?>><label for="<?php echo $this->get_field_id( 'statistics' ); ?>"> <?php _e( 'Daily Statistics', 'wtnnwm' );?></label><br />
		<label for="<?php echo $this->get_field_id( 'format_date' ); ?>"><?php _e( 'Date Format for Daily Statistics:', 'wtnnwm' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'format_date' ); ?>" name="<?php echo $this->get_field_name( 'format_date' ); ?>">
		<option value="d-m-Y" <?php selected( 'd-m-Y', $wtnnwm_format_date  ); ?>><?php _e( 'dd-mm-yyyy', 'wtnnwm' ); ?></option>
		<option value="Y-m-d" <?php selected( 'Y-m-d', $wtnnwm_format_date  ); ?>><?php _e( 'yyyy-mm-dd', 'wtnnwm'); ?></option>
		<option value="d/m Y" <?php selected( 'd/m Y', $wtnnwm_format_date  ); ?>><?php _e( 'dd/mm yyyy', 'wtnnwm' ); ?></option>
		</select></p>
		<p>
		<input id="<?php echo $this->get_field_id( 'total_words' ); ?>" name="<?php echo $this->get_field_name( 'total_words' ); ?>" type="hidden" value="0">
		<input id="<?php echo $this->get_field_id( 'total_words' ); ?>" name="<?php echo $this->get_field_name( 'total_words' ); ?>" type="checkbox" value="1" <?php checked( 1, $wtnnwm_total_words ); ?>><label for="<?php echo $this->get_field_id( 'total_words' ); ?>"> <?php _e('Words Written', 'wtnnwm' ); ?></label></p>
		<p>
		<p>
		<input id="<?php echo $this->get_field_id( 'words_day' ); ?>" name="<?php echo $this->get_field_name( 'words_day' ); ?>" type="hidden" value="0">
		<input id="<?php echo $this->get_field_id( 'words_day' ); ?>" name="<?php echo $this->get_field_name( 'words_day' ); ?>" type="checkbox" value="1" <?php checked( 1, $wtnnwm_words_day ); ?>><label for="<?php echo $this->get_field_id( 'words_day' ); ?>"> <?php _e( 'Words/Day Written', 'wtnnwm' ); ?></label></p>
		<p>
		<input id="<?php echo $this->get_field_id( 'words_left' ); ?>" name="<?php echo $this->get_field_name( 'words_left' ); ?>" type="hidden" value="0">
		<input id="<?php echo $this->get_field_id( 'words_left' ); ?>" name="<?php echo $this->get_field_name( 'words_left' ); ?>" type="checkbox" value="1" <?php checked( 1, $wtnnwm_words_left ); ?>><label for="<?php echo $this->get_field_id( 'words_left' ); ?>"> <?php _e( 'Words To Write', 'wtnnwm' ); ?></label></p>
		<p>
		<input id="<?php echo $this->get_field_id( 'words_day_left' ); ?>" name="<?php echo $this->get_field_name( 'words_day_left' ); ?>" type="hidden" value="0">
		<input id="<?php echo $this->get_field_id( 'words_day_left' ); ?>" name="<?php echo $this->get_field_name( 'words_day_left' ); ?>" type="checkbox" value="1" <?php checked( 1, $wtnnwm_words_day_left ); ?>><label for="<?php echo $this->get_field_id( 'words_day_left' ); ?>"> <?php _e( 'Words/Day To Write', 'wtnnwm' ); ?></label></p>
		<p>
		<input id="<?php echo $this->get_field_id( 'finished' ); ?>" name="<?php echo $this->get_field_name( 'finished' ); ?>" type="hidden" value="0">
		<input id="<?php echo $this->get_field_id( 'finished' ); ?>" name="<?php echo $this->get_field_name( 'finished' ); ?>" type="checkbox" value="1" <?php checked( 1, $wtnnwm_finished ); ?>><label for="<?php echo $this->get_field_id( 'finished' ); ?>"> <?php _e( 'Finished on', 'wtnnwm' ); ?></label></p>
		<?php			
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['username'] = sanitize_text_field( $new_instance['username'] );
		$instance['format_date'] = sanitize_text_field( $new_instance['format_date'] );
		$instance['statistics'] = sanitize_text_field( $new_instance['statistics'] );			
		$instance['total_words'] = sanitize_text_field( $new_instance['total_words'] ); 
		$instance['words_day'] = sanitize_text_field( $new_instance['words_day'] ); 
		$instance['words_left'] = sanitize_text_field( $new_instance['words_left'] ); 
		$instance['words_day_left'] = sanitize_text_field( $new_instance['words_day_left'] ); 
		$instance['finished'] = sanitize_text_field( $new_instance['finished'] ); 
		
		return $instance;
	}
	
	function widget ( $args, $instance ) {
		
		extract( $args );
		echo $before_widget;			
		
		$wtnnwm_title = apply_filters( 'widget_title', $instance['title'] );
		$wtnnwm_username = ( empty( $instance['username'] ) ) ? '&nbsp;' : $instance['username'];
		$wtnnwm_format_date = $instance['format_date'];
		$wtnnwm_statistics = $instance['statistics'];			
		$wtnnwm_total_words = $instance['total_words']; 
		$wtnnwm_words_day = $instance['words_day'];
		$wtnnwm_words_left = $instance['words_left']; 
		$wtnnwm_words_left_day = $instance['words_day_left']; 
		$wtnnwm_finished = $instance['finished']; 
		
		if ( !empty ( $wtnnwm_title ) ) {
			
			echo $before_title . esc_html( $wtnnwm_title ) . $after_title;				
		}			
	
		// Receive and open the stats from a NaNoWriMO Writer
		// More information: http://nanowrimo.org/wordcount_api
		$wtnnwm_url = 'http://nanowrimo.org/wordcount_api/wchistory/' . $wtnnwm_username;		
		$wtnnwm_xml = simplexml_load_file( $wtnnwm_url );
		
		//Some constants like words and days for NaNoWriMO
		$wtnnwm_nanowrimo_words = 50000;
		$wtnnwm_nanowrimo_days = 30;
		$wtnnwm_nanowrimo_finish_date = strtotime( '23:59 November 30 2015' );
		$wtnnwm_nanowrimo_words_days = $wtnnwm_nanowrimo_words / $wtnnwm_nanowrimo_days;
		
		
		
		// If user don't exist or the user has no novel registered, the api returns an error;
		$wtnnwm_error = strip_tags( $wtnnwm_xml->error );	
?>
		<h4><?php _e( 'Writer:', 'wtnnwm' ); ?> <a href="http://nanowrimo.org/participants/<?php echo $wtnnwm_username; ?>"><?php echo $wtnnwm_username; ?></a></h4>
		<p><?php echo $wtnnwm_error; ?></p>
<?php
		if ( $wtnnwm_error == '') {	
		
			//Shows the daily wordcount from a NaNoWriMO Writer
			if ( $wtnnwm_statistics == 1 ) {
?>			
				<table class="wtnnwm-widget-statistics">					
					<tr>
						<th><?php _e( 'Date:', 'wtnnwm' ); ?></th>
						<th><?php _e( 'Words:', 'wtnnwm' ); ?></th>
					</tr>
<?php
					foreach ( $wtnnwm_xml->wordcounts->wcentry as $wtnnwm_entry ) {
							
						$wtnnwm_day = $wtnnwm_entry->wcdate;
						$wtnnwm_date = strtotime( $wtnnwm_day );
						$wtnnwm_words = $wtnnwm_entry->wc;
						
						if ( $wtnnwm_words < $wtnnwm_nanowrimo_words_days ) {
							
							$wtnnwm_words_class = 'wtnnwm-red';
						}
						else {
							$wtnnwm_words_class = 'wtnnwm-green';
						}
						
						echo '<tr>';
						echo '<td>' . date( $wtnnwm_format_date, $wtnnwm_date ) . '</td><td class="' . $wtnnwm_words_class . '">' . $wtnnwm_words. '</td>';	
						echo '</tr>';
					}
?>				
				</table><!-- .wtnnwm_widget_statistics -->
<?php
			}
		
			//Written wordsum
			$wtnnwm_total_wordcount = 0;
			$wtnnwm_finish_day = array();
		
			foreach ( $wtnnwm_xml->wordcounts->wcentry as $wtnnwm_entry ) {
							
				$wtnnwm_wordcount = $wtnnwm_entry->wc;					
				$wtnnwm_total_wordcount += $wtnnwm_wordcount;
				
				if ( $wtnnwm_total_wordcount >= $wtnnwm_nanowrimo_words ) {
					
					array_push( $wtnnwm_finish_day, $wtnnwm_entry->wcdate );
				} 
			}
			
			$wtnnwm_finished_on = $wtnnwm_finish_day[0];
			
				
			//Words to write 
			$wtnnwm_wordcount_left = $wtnnwm_nanowrimo_words - $wtnnwm_total_wordcount;	

			if ( $wtnnwm_total_wordcount >= $wtnnwm_nanowrimo_words ) {
				
				$wtnnwm_wordcount_left = '-';
			}
				
			
			
			//Days gone from the challenge		
			$wtnnwm_days = count( $wtnnwm_xml->wordcounts->wcentry );
					
			//Days left of the challenge
			$wtnnwm_days_left = $wtnnwm_nanowrimo_days - $wtnnwm_days;

			
			if ( $wtnnwm_days_left > 0 ) {
				
				// Words to write per day
				$wtnnwm_words_left_per_day = round( $wtnnwm_wordcount_left / $wtnnwm_days_left );
			}
			else {
				$wtnnwm_words_left_per_day = '-';
			}
			
			//Written words per day
			$wtnnwm_words_per_day = round( $wtnnwm_total_wordcount / $wtnnwm_days );
			
			if ( $wtnnwm_finished_on == '' ) {

				//It would take so many days to finish				
				$wtnnwm_finished_days = round( $wtnnwm_wordcount_left / $wtnnwm_words_per_day );
				
				//The novel is finished on this day
				$wtnnwm_finished_days = $wtnnwm_finished_days * 60 * 60 * 24;
				$wtnnwm_would_finished_on = date( $wtnnwm_format_date, time() + $wtnnwm_finished_days );					
			} else {
				

				$wtnnwm_finished_on = strtotime( $wtnnwm_finished_on );
				$wtnnwm_would_finished_on = date( $wtnnwm_format_date, $wtnnwm_finished_on );
			}
			
			//If the novel is finished earlier as the 30 November, the date is green. 
			
			$wtnnwm_would_finished_on_str = strtotime( $wtnnwm_would_finished_on );				
			
			if ( $wtnnwm_would_finished_on_str > $wtnnwm_nanowrimo_finish_date ) {
				
				$wtnnwm_words_class = 'wtnnwm-red';
			} else {
				
				$wtnnwm_words_class = 'wtnnwm-green';
			}
				
			
		
			if ( $wtnnwm_words_day == 1 || $wtnnwm_total_words == 1 || $wtnnwm_words_left == 1 || $wtnnwm_words_left_day == 1 || $wtnnwm_finished == 1 ) {		
?>			
				<div class="wtnnwm-widget-information">
				
					<?php if ( $wtnnwm_words_day == 1 ) : ?>					
						<p><?php _e( 'Words/Day Written:', 'wtnnwm' ); ?> <span><?php echo $wtnnwm_words_per_day; ?></span></p>					
					<?php endif; ?>
					
					
					<?php if ( $wtnnwm_total_words == 1 ) : ?>						
						<p><?php _e( 'Words Written:', 'wtnnwm' ); ?> <span><?php echo $wtnnwm_total_wordcount; ?></span></p> 					
					<?php endif; ?>

					<?php if ( $wtnnwm_words_left == 1 ) : ?>					
						<p><?php _e( 'Words To Write:', 'wtnnwm' ); ?> <span><?php echo $wtnnwm_wordcount_left; ?></span></p> 					
					<?php endif; ?>
					
					<?php if ( $wtnnwm_words_left_day == 1) : ?>
						<p><?php _e( 'Words/Day To Write:', 'wtnnwm' ); ?> <span><?php echo $wtnnwm_words_left_per_day; ?></span></p> 
					<?php endif; ?>
		
					<?php if ( $wtnnwm_finished == 1 ) : ?>						
						<p><?php _e( 'Finished On:', 'wtnnwm' ); ?> <span class="<?php echo $wtnnwm_words_class; ?>"><?php echo $wtnnwm_would_finished_on; ?></span></p>				
					<?php endif; ?>

				
				
				</div><!-- .wtnnwm_widget_information -->
				<?php			
			}
		
		}
		
		echo $after_widget;
	}
}
?>