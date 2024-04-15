<?php


add_action( 'widgets_init', 'vmagazine_video_player_widget' );

function vmagazine_video_player_widget() {
    register_widget( 'vmagazine_video_player' );
}

class Vmagazine_Video_Player extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'vmagazine_video_player',
            'description' => __( 'Plays Youtube video in a playlist.', 'vmagazine' )
        );
        parent::__construct( 'vmagazine_video_player', esc_html__( 'Vmagazine : Youtube Video Playlists', 'vmagazine' ), $widget_ops );
    }


    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global   $vmagazine_cat_array;

        $fields = array(

          'block_layout' => array(
                'vmagazine_widgets_name'         => 'block_layout',
                'vmagazine_widgets_title'        => esc_html__( 'Layout will be like this', 'vmagazine' ),
                'vmagazine_widgets_layout_img'   => VMAG_WIDGET_IMG_URI.'youtube-lists.png',
                'vmagazine_widgets_field_type'   => 'widget_layout_image'
            ),
            'block_title' => array(
                'vmagazine_widgets_name'         => 'block_title',
                'vmagazine_widgets_title'        => esc_html__( 'Block Title', 'vmagazine' ),
                'vmagazine_widgets_field_type'   => 'text'
            ),


            'player_video_id' => array(
                'vmagazine_widgets_name'         => 'player_video_id',
                'vmagazine_widgets_title'        => esc_html__( 'Enter Youtube Video IDs', 'vmagazine' ),
                'vmagazine_widgets_description'  => esc_html__( 'Id must be seperated with comma Eg: fiTaCplx0RY,BRjMNGMOV4A', 'vmagazine' ),
                'vmagazine_widgets_default'      => '',
                'vmagazine_widgets_field_type'   => 'text'
            ),

         

        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $vmagazine_block_title   = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $player_video_ids   = empty( $instance['player_video_id'] ) ? '' : $instance['player_video_id'];
       
        echo wp_kses_post($before_widget);



$player_video_id = explode(',',$player_video_ids);
$video_list = array();

if ( is_array( $player_video_id ) ) {
    foreach ( $player_video_id as $video_id ) {
        $video_list[] = $video_id;
    }
}
$new_video_list = $video_list;

$new_video_list = implode( ',', $new_video_list );
?>

<div class="vmagazine-yt-player">

   <?php vmagazine_widget_title( $vmagazine_block_title, $vmagazine_block_title_url=null, $cat_id=null ); ?>

    <div class="vmagazine-video-holder clearfix"> 
        <div class="big-video">
            <div class="big-video-inner">
                <div id="vmagazine-video-placeholder"></div>
            </div>
        </div>

        <div class="video-thumbs">
            <div class="video-controls">

                <div class="video-track">
                    <div class="video-current-playlist">
                        <?php _e( 'Fetching Video Title..', 'vmagazine' ) ?>
                    </div>

                    <div class="video-duration-time">
                        <span class="video-current-time">0:00</span>
                        /
                        <span class="video-duration"><?php esc_html_e( 'Loading..', 'vmagazine' ) ?></span>     
                    </div>
                </div>

                <div class="video-control-holder">
                    <div class="video-play-pause stopped"><i class="fa fa-play" aria-hidden="true"></i></div>
                    <div class="video-prev"><i class="fa fa-step-backward" aria-hidden="true"></i></div>
                    <div class="video-next"><i class="fa fa-step-forward" aria-hidden="true"></i></div>
                </div>

            </div>

            <div class="vmagazine-video-thumbnails">
                <?php
                $video_title = $video_thumb_url = $video_duration = "";
                $key = 'AIzaSyCgUNoo_CeiRhOPCCPHtLbDeo7NVWkbtVw';
                $i = 0;
                foreach ( $video_list as $video ) {
                    $video_api = wp_remote_get( 'https://www.googleapis.com/youtube/v3/videos?id=' . $video . '&key='.$key.'&part=snippet,contentDetails', array(
                        'sslverify' => false
                            ) );

                    $video_api_array = json_decode( wp_remote_retrieve_body( $video_api ), true );
                    if ( is_array( $video_api_array ) && !empty( $video_api_array[ 'items' ] ) ) {
                        $snippet = $video_api_array[ 'items' ][ 0 ][ 'snippet' ];
                        $video_title = $snippet[ 'title' ];
                        $video_thumb_url = $snippet[ 'thumbnails' ][ 'default' ][ 'url' ];
                        $video_duration = $video_api_array[ 'items' ][ 0 ][ 'contentDetails' ][ 'duration' ];
                        
                        ?>
                        <div class="vmagazine-video-list clearfix" data-index="<?php echo absint($i); ?>" data-video-id="<?php echo esc_attr($video); ?>"> 
                            <img alt="<?php echo esc_attr( $video_title ); ?>" src="<?php echo esc_url( $video_thumb_url ); ?>">

                            <div class="video-title-duration">
                                <h6><?php echo esc_html( $video_title ); ?></h6>
                                <div class="video-list-duration"><?php echo  vmagazine_youtube_duration($video_duration);  ?></div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>  
                        <div class="vmagazine-video-list clearfix">  
                            <div class="video-title-duration">
                                <h6><i><?php _e( 'Either this video has been removed or you don\'t have access to watch this video', 'vmagazine' ); ?></i></h6>
                            </div>
                        </div>
                        <?php
                    }
                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
wp_enqueue_script( 'youtube-api' );
?>
<script type="text/javascript">

    var player;
    var time_update_interval;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('vmagazine-video-placeholder', {
            //width: 800,
            //height: 450,
            videoId: '<?php echo esc_html($video_list[0]); ?>',
            playerVars: {
                color: 'white',
                playlist: '<?php echo esc_html($new_video_list); ?>',
            },
            events: {
                onReady: initialize,
                onStateChange: onPlayerStateChange
            }
        });

    }

    function initialize() {

        // Update the controls on load
        updateTimerDisplay();

        jQuery('.video-current-playlist').text(jQuery('.vmagazine-video-list:first').text());
        jQuery('.vmagazine-video-list:first').addClass('video-active')

        // Clear any old interval.
        clearInterval(time_update_interval);

        // Start interval to update elapsed time display and
        // the elapsed part of the progress bar every second.
        time_update_interval = setInterval(function () {
            updateTimerDisplay();
        }, 1000);

    }

    // This function is called by initialize()
    function updateTimerDisplay() {
        // Update current time text display.
        jQuery('.video-current-time').text(formatTime(player.getCurrentTime()));
        jQuery('.video-duration').text(formatTime(player.getDuration()));
    }

    function formatTime(time) {
        time = Math.round(time);
        var minutes = Math.floor(time / 60),
                seconds = time - minutes * 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        return minutes + ":" + seconds;
    }

    function onPlayerStateChange(event) {
        updateButtonStatus(event.data);
    }

    function updateButtonStatus(playerStatus) {
        //console.log(playerStatus);
        if (playerStatus == -1) {
            jQuery('.video-play-pause').removeClass('playing').addClass('stopped'); // unstarted
            var currentIndex = player.getPlaylistIndex();

            var currentElement = jQuery('.vmagazine-video-list').map(function () {
                if (currentIndex == jQuery(this).attr('data-index')) {
                    return this;
                }
            });

            var videoTitle = currentElement.find('h6').text();

            currentElement.siblings().removeClass('video-active');
            currentElement.addClass('video-active');

            jQuery('.video-current-playlist').text(videoTitle);

            player.setLoop(true);

        } else if (playerStatus == 0) {
            jQuery('.video-play-pause').removeClass('playing').addClass('stopped'); // ended
        } else if (playerStatus == 1) {
            jQuery('.video-play-pause').removeClass('stopped').addClass('playing'); // playing
        } else if (playerStatus == 2) {
            jQuery('.video-play-pause').removeClass('playing').addClass('stopped'); // paused
        } else if (playerStatus == 3) {
            jQuery('.video-play-pause').removeClass('playing').addClass('stopped'); // buffering
        } else if (playerStatus == 5) {
            // video cued
        }
    }

    jQuery(function ($) {

        $('body').on('click', '.video-play-pause.stopped', function () {
            player.playVideo();
            $(this).removeClass('stopped').addClass('playing');
        });

        $('body').on('click', '.video-play-pause.playing', function () {
            player.pauseVideo();
            $(this).removeClass('playing').addClass('stopped');
        });

        $('.video-next').on('click', function () {
            player.nextVideo();
        });

        $('.video-prev').on('click', function () {
            player.previousVideo()
        });

        $('.vmagazine-video-list').on('click', function () {
            var videoIndex = $(this).attr('data-index');
            player.playVideoAt(videoIndex);
            player.setLoop(true);
        });

    });

</script>


 <?php
        echo wp_kses_post($after_widget);

    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    vmagazine_widgets_updated_field_value()      defined in vmag-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$vmagazine_widgets_name] = vmagazine_widgets_updated_field_value( $widget_field, $new_instance[$vmagazine_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    vmagazine_widgets_show_widget_field()        defined in vmag-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $vmagazine_widgets_field_value = !empty( $instance[$vmagazine_widgets_name]) ? $instance[$vmagazine_widgets_name] : '';
            vmagazine_widgets_show_widget_field( $this, $widget_field, $vmagazine_widgets_field_value );
        }
    }
}