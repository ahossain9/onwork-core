<?php 

function onwork_ajax_create_project(){

  if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'create_project_nonce' ) || ! isset( $_REQUEST['nonce'] ) ) {
      exit( "No naughty business please" );
  }


  $project_id = $_POST['project_id'];
  $params = array();
  parse_str($_POST['project_data'], $params);

  $result = wp_update_post(array(
    'ID' => $project_id,
    'post_title' => sanitize_text_field($params['title']),
    'post_content' => wp_kses_post($params['description']),
    'post_type' => 'projects',
    'post_author' => get_current_user_id(),
    'post_status'   => 'pending',
  ), true);

  if(isset($params['project_category'])) {
    update_post_meta( $project_id, 'project_category', get_term_by('id', $params['project_category'], 'project-categories','ARRAY_A')['name']);
    onwork_set_hierarchical_terms('project-categories', $params['project_category'], $project_id);
  }

  if(isset($params['project_seller_type'])) {
    update_post_meta( $project_id, 'project_seller_type', get_term_by('id', $params['project_seller_type'], 'project-seller-type','ARRAY_A')['name']);
    $type_terms = array((int)$params['project_seller_type']);
    wp_set_post_terms( $project_id, $type_terms, 'project-seller-type', false );
  }

  if($params['project_type'] == 'Fixed') {
    update_post_meta( $project_id, 'project_type', sanitize_text_field($params['project_type']));
    update_post_meta( $project_id, 'project_price', sanitize_text_field($params['project_price']));  
  } elseif($params['project_type'] == 'Hourly') {
    update_post_meta( $project_id, 'project_type', sanitize_text_field($params['project_type']));
    update_post_meta( $project_id, 'estimated_hours', sanitize_text_field($params['estimated_hours']));
    update_post_meta( $project_id, 'project_price', sanitize_text_field($params['project_price']));
  }

  if(isset($params['project_duration'])) {
    update_post_meta( $project_id, 'project_duration', get_term_by('id', $params['project_duration'], 'project-duration','ARRAY_A')['name']);
    $type_terms = array((int)$params['project_duration']);
    wp_set_post_terms( $project_id, $type_terms, 'project-duration', false );
  }
  
  if(isset($params['project_level'])) {
    update_post_meta( $project_id, 'project_level', get_term_by('id', $params['project_level'], 'project-level','ARRAY_A')['name']);
    $type_terms = array((int)$params['project_level']);
    wp_set_post_terms( $project_id, $type_terms, 'project-level', false );
  }
  
  if(isset($params['english_level'])) {
    update_post_meta( $project_id, 'english_level', get_term_by('id', $params['english_level'], 'english-level','ARRAY_A')['name']);
    $type_terms = array((int)$params['english_level']);
    wp_set_post_terms( $project_id, $type_terms, 'english-level', false );
  }

  if(isset($params['locations'])) {
    update_post_meta( $project_id, 'locations', get_term_by('id', $params['locations'], 'locations','ARRAY_A')['name']);
    $type_terms = array((int)$params['locations']);
    wp_set_post_terms( $project_id, $type_terms, 'locations', false );
  }

  if(isset($params['skills'])) {
    $integerIDs = array_map('intval', $params['skills']);
    $integerIDs = array_unique($integerIDs);
    wp_set_post_terms( $project_id, $integerIDs, 'skills' );
  }

  if(isset($params['languages'])) {
    $integerIDs = array_map('intval', $params['languages']);
    $integerIDs = array_unique($integerIDs);
    wp_set_post_terms( $project_id, $integerIDs, 'languages' );
  }

  // if(isset($params['attachments'])) {

  //   $img_ids = json_decode($params['attachments']);

  //   if ($img_ids) {
  //     foreach ( $img_ids as $key) {
  //       $url[$key] = wp_get_attachment_url($key);
  //     }
  //   }

    // update_post_meta( $project_id, 'attachments', $url);
  // }

  // if($params['featured_project']) {
  //   update_post_meta( $project_id, 'featured_project', true);
  // } else {
  //   update_post_meta( $project_id, 'featured_project', false);
  // }

  if($params['project_update']) {
    update_post_meta( $project_id, 'project_update', true);
  }

  if (is_wp_error($result)) {
    wp_send_json_error(array('message' => esc_html__( 'Error!!! Please contact admin', 'prolancer' )));
  }else{
    
    
    
    wp_send_json_success(array( 
      'message' => esc_html__( 'Project created!', 'prolancer' ),
      'projects_url' => onwork_get_page_url_by_template('onwork-dashboard.php').'=projects'
    ));
  }  
  wp_die();  
}
add_action('wp_ajax_onwork_ajax_create_project',  'onwork_ajax_create_project' );
add_action('wp_ajax_nopriv_onwork_ajax_create_project',  'onwork_ajax_create_project' );


// add_action('wp_ajax_onwork_ajax_create_project',  'onwork_ajax_create_project');


// function onwork_ajax_create_project(){
//     if(!wp_verify_nonce( $_REQUEST['_wpnonce'], 'onwork-create-project-from' )){
//       wp_send_json_error(array(
//         'message' => 'Nonce verification failed'
//       ));

//     }
//     wp_send_json_error(array(
//       'message' => 'Something Went Wrong'
//     ));
// }