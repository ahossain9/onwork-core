<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__( 'Message', 'prolancer' ); ?></h2>
</div>


<div class="white-padding">
  <?php
  if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
  } else if ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
  } else {
    $paged = 1;
  }

  global $wpdb;
  $table = 'prolancer_messages';

  if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
    $query = "SELECT * FROM ${table} WHERE `receiver_id` = '" . get_current_user_id() . "'";
    $receiver_ids = $wpdb->get_results($query);

    if($receiver_ids) {

    foreach($receiver_ids  as $receiver_id){  
      $sender_ids[] = $receiver_id->sender_id;
    }

    $chat_members = array_unique($sender_ids); ?>

    <div class="row message-box">
      <div class="col-md-4">
        <div class="message-box-sidebar">
          <div class="nav nav-tabs">
            <?php foreach ($chat_members as $key => $chat_member) { ?>
              <a href="#" class="nav-link <?php if($key==0){echo'active';} ?>" data-bs-toggle="pill" data-bs-target="#chat-<?php echo esc_attr($key); ?>-tab" type="button" role="tab" aria-selected="<?php if($key==0){echo'true';} ?>">
                <span class="d-flex align-items-center">
                  <?php
                  $sender_profile_image_id = get_posts(array(
                    'post_type'   => 'sellers',
                    'author'    => $chat_member,
                    'numberposts' => 1,
                  ))[0]->ID;

                  $sender_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($sender_profile_image_id, 'seller_profile_attachment', true )),array('30', '30') ,false);

                  if (!empty($sender_image)) {
                    echo wp_kses($sender_image,array(
                      "img" => array(
                          "src" => array(),
                          "alt" => array(),
                          "style" => array()
                      )
                    ));
                  } else {
                      echo get_avatar($chat_member, 30 );
                  }?>
                  <span>
                    <?php
                    $user_name = get_post_meta($sender_profile_image_id, 'seller_profile_name', true );
                    if (!empty($user_name)) {
                      echo esc_html($user_name);
                    } else {
                      echo esc_html(get_the_author_meta('display_name', $chat_member));
                    } ?>
                  </span>
                </span>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="tab-content">
        <?php foreach ($chat_members as $key => $chat_member) { ?>
          <div class="tab-pane fade <?php if($key==0){echo'show active';} ?>" id="chat-<?php echo esc_attr($key); ?>-tab">
            <div class="chat-box">
              <?php
              $message_query = "SELECT * FROM ${table} WHERE `receiver_id` = '" . get_current_user_id() . "' AND `sender_id` = '".$chat_member."' OR  `sender_id` = '" . get_current_user_id() . "' AND `receiver_id` = '".$chat_member."'";

              $messages = $wpdb->get_results($message_query);

              foreach ($messages as $message) {
              $sender_id = $message->sender_id;
              $receiver_id = $message->receiver_id;

              if ($receiver_id == get_current_user_id()) { ?>
                <div class="chat-list">
                  <div class="row">
                    <div class="col-3">
                      <a href="<?php echo get_author_posts_url($message->sender_id); ?>" target="_blank">
                        <?php
                        $sender_profile_image_id = get_posts(array(
                          'post_type'   => 'sellers',
                          'author'    =>  $message->sender_id,
                          'numberposts' => 1,
                        ))[0]->ID;

                        $sender_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($sender_profile_image_id, 'seller_profile_attachment', true )),array('60', '60') ,false);

                        if (!empty($sender_image)) {
                          echo wp_kses($sender_image,array(
                            "img" => array(
                                "src" => array(),
                                "alt" => array(),
                                "style" => array()
                            )
                          ));
                        } else {
                            echo get_avatar( $message->sender_id, 60 );
                        }?>
                      </a>
                    </div>
                    <div class="col-9">
                      <p><?php echo esc_html( $message->message ); ?></p>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div class="chat-list message_sender">
                  <div class="row">
                    <div class="col-9">
                      <p><?php echo esc_html( $message->message ); ?></p>
                    </div>
                    <div class="col-3 text-end">
                      <a href="<?php echo get_author_posts_url($message->sender_id); ?>" target="_blank">
                        <?php
                        $sender_profile_image_id = get_posts(array(
                          'post_type'   => 'sellers',
                          'author'    => $message->sender_id,
                          'numberposts' => 1,
                        ))[0]->ID;

                        $sender_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($sender_profile_image_id, 'seller_profile_attachment', true )),array('60', '60') ,false);

                        if (!empty($sender_image)) {
                          echo wp_kses($sender_image,array(
                            "img" => array(
                                "src" => array(),
                                "alt" => array(),
                                "style" => array()
                            )
                          ));
                        } else {
                            echo get_avatar($message->sender_id, 60 );
                        }?>
                      </a>
                    </div>
                  </div>
                </div>
              <?php }
            } ?>
            </div>
            <form id="reply-message-form">
              <div class="row">
                <div class="col-2 text-center">
                  <a href="<?php echo get_author_posts_url(get_current_user_id()); ?>" target="_blank">
                    <?php
                    $sender_profile_image_id = get_posts(array(
                      'post_type'   => 'sellers',
                      'author'    => get_current_user_id(),
                      'numberposts' => 1,
                    ))[0]->ID;

                    $sender_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($sender_profile_image_id, 'seller_profile_attachment', true )),array('60', '60') ,false);

                    if (!empty($sender_image)) {
                      echo wp_kses($sender_image,array(
                        "img" => array(
                            "src" => array(),
                            "alt" => array(),
                            "style" => array()
                        )
                      ));
                    } else {
                        echo get_avatar(get_current_user_id(), 60 );
                    }?>
                  </a>
                </div>
                <div class="col-10">
                  <form id="reply-message-form">
                      <textarea name="message" name="message" placeholder="<?php echo esc_attr__( 'Type your message here...','prolancer' ); ?>"></textarea>
                      <a href="#" class="send-message prolancer-btn mt-4" data-nonce="<?php echo wp_create_nonce('messages_nonce'); ?>" data-sender-id="<?php echo get_current_user_id(); ?>" data-receiver-id="<?php echo esc_attr( $chat_member ); ?>"><?php echo esc_html__( 'Send message','prolancer' ); ?></a>
                  </form>
                </div>
              </div>              
            </form>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
    <?php } else {?>
    <div class="white-padding">
      <p class="mb-0"><?php echo esc_html__( 'No Message found!','prolancer' ); ?></p>
    </div>
    <?php } 
  } ?> 
</div>