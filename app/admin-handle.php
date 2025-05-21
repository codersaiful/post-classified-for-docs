<?php 
namespace WPPCD;

class Admin_Handle{

    public static $post_types = [];
    public static $meta_key = WPPCD_META_KEY;//'wppcd_post_order_number';


    public static function init(){
        $post_types = [
            'post',
            'page',
            'product',
        ];
        $post_types = apply_filters( 'wppcd_supported_post_type_arr', $post_types );
        self::$post_types = $post_types;
        add_action( 'add_meta_boxes', [__CLASS__,'register_meta_boxes'] );
        add_action( 'save_post', [__CLASS__, 'save_meta_box'] );
    }

    public static function register_meta_boxes(){
        add_meta_box( 'wppcd-post-order-number', __( "Post Order Number(Making Doc plugin)", 'wppcd' ), [__CLASS__, 'display_metabox'], self::$post_types );
    }

    public static function display_metabox( $post ){
        wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
        
        $post_id = $post->ID;
        $order_number = get_post_meta( $post_id, self::$meta_key, true );
        $order_number = ! empty( $order_number ) && is_numeric( $order_number ) ? $order_number : 10;
        ?>
        <input name="wppcd-order-number" value="<?php echo esc_attr( $order_number ); ?>" type="number" placeholder="input number">
        <?php
    }
    
    public static function save_meta_box( $post_id ){
        
        
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
 

        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {

            return;
        }
 
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
 
        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        if( isset( $_POST['wppcd-order-number'] ) && ! empty( $_POST['wppcd-order-number'] ) ){
            $order_number = $_POST['wppcd-order-number'];
            update_post_meta( $post_id, self::$meta_key, $order_number );
        }
    }

}
Admin_Handle::init();

$file = __DIR__ . '/appsero/src/Client.php';

if ( ! class_exists( 'Appsero\Client' ) && file_exists( $file ) ) {

    require_once $file;
    /**
     * Initialize the plugin tracker
     *
     * @return void
     */
    function appsero_init_tracker_post_classified_for_docs() {


        $client = new \Appsero\Client( '6b40f082-3c45-4f46-b21b-a7f4f1038dc7', 'Post Classfied POST List', WPPCD_MAIN_FILE );
        // dd($client);
        // Active insights
        $client->insights()->init();

    }

    appsero_init_tracker_post_classified_for_docs();
}



