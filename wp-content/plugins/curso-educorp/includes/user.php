<?php

//extra user info in wp-admin
add_action( 'show_user_profile', 'yoursite_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'yoursite_extra_user_profile_fields' );
function yoursite_extra_user_profile_fields( $user ) {
?>
  <h3><?php _e("Institucional", "blank"); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="matricula"><?php _e("matricula"); ?></label></th>
      <td>
        <input type="text" name="matricula" id="matricula" class="regular-text" 
            value="<?php echo esc_attr( get_the_author_meta( 'matricula', $user->ID ) ); ?>" /><br />
    </td>
    </tr>   
    <tr>
      <th><label for="unidade"><?php _e("unidade"); ?></label></th>
      <td>
        <input type="text" name="unidade" id="unidade" class="regular-text" 
            value="<?php echo esc_attr( get_the_author_meta( 'unidade', $user->ID ) ); ?>" /><br />
    </td>
    </tr>
  </table>
<?php
}



//Save our extra registration user meta.
add_action('user_register', 'myplugin_user_register'); 
function myplugin_user_register ($user_id) {  

    if ( isset( $_POST['matricula'] ) )
        update_user_meta($user_id, 'matricula', $_POST['matricula']);

    if ( isset( $_POST['unidade'] ) )
        update_user_meta($user_id, 'unidade', $_POST['unidade']);  

}