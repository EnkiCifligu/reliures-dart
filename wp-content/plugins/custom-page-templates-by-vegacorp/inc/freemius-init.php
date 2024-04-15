<?php

// Create a helper function for easy SDK access.
if ( !function_exists( 'wcpt_fs' ) ) {
    function wcpt_fs()
    {
        global  $wcpt_fs ;
        if ( !isset( $wcpt_fs ) ) {
            $wcpt_fs = fs_dynamic_init( array(
                'id'             => '1089',
                'slug'           => 'custom-page-templates-by-vegacorp',
                'type'           => 'plugin',
                'public_key'     => 'pk_92370265fb4d1ba09a8146150ce1b',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'trial'          => array(
                'days'               => 7,
                'is_require_payment' => false,
            ),
                'menu'           => array(
                'slug'       => 'wcpt_welcome_page',
                'first-path' => 'admin.php?page=wcpt_welcome_page',
                'support'    => false,
            ),
                'is_live'        => true,
            ) );
        }
        return $wcpt_fs;
    }

}
// Init Freemius.
wcpt_fs();
// Signal that SDK was initiated.
do_action( 'wcpt_fs_loaded' );