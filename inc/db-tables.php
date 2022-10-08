<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
global $wpdb;

maybe_create_table(
    "onwork_project_proposals",
    "
	CREATE TABLE onwork_project_proposals (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime ,
		`updated_on` datetime,
		`project_id` int (11),
		`proposed_price` int (11),
		`earned_money` float(9,2),
		`day_to_complete` int (11),
		`cover_letter` text (300),
		`attachment_ids` varchar (300),
		`seller_id` int (11),
		`buyer_id` int (11),
		`status` varchar (300),
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
);

maybe_create_table(
    "onwork_service_orders",
    "
	CREATE TABLE onwork_service_orders (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime ,
		`updated_on` datetime,
		`service_id` int (11),
		`delivery_time_id` int (11),
		`service_price` int (11),
		`total_price` int (11),
		`seller_id` int (11),
		`buyer_id` int (11),
		`status` varchar (300),
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
);

maybe_create_table(
    "onwork_project_messages",
    "
	CREATE TABLE onwork_project_messages (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime ,
		`updated_on` datetime,
		`proposal_id` int (11),
		`message` text (300),
		`attachment_id` varchar (300),
		`sender_id` int (11),
		`receiver_id` int (11),
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
);

maybe_create_table(
    "onwork_service_messages",
    "
	CREATE TABLE onwork_service_messages (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime ,
		`updated_on` datetime,
		`order_id` int (11),
		`message` text (300),
		`attachment_id` varchar (300),
		`sender_id` int (11),
		`receiver_id` int (11),
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
);

maybe_create_table(
    "onwork_reviews",
    "
	CREATE TABLE onwork_reviews (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime ,
		`updated_on` datetime,
		`project_id` int (11),
		`review` text (300),
		`star` varchar (300),
		`seller_id` int (11),
		`buyer_id` int (11),
		`type` varchar (300),
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
);

maybe_create_table(
    "onwork_messages",
    "
	CREATE TABLE onwork_messages (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime,
		`updated_on` datetime,
		`message` text (300),
		`sender_id` int (11),
		`receiver_id` int (11),
		`read` boolean DEFAULT false,
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
);

maybe_create_table(
    "onwork_notifications",
    "
	CREATE TABLE onwork_notifications (
		`id` int (11) NOT NULL AUTO_INCREMENT,
		`timestamp` datetime,
		`updated_on` datetime,
		`type` varchar (50),
		`title` text (300),
		`image` varchar (300),
		`url` varchar (300),
		`sender_id` int (11),
		`receiver_id` int (11),
		`read` boolean DEFAULT false,
		 PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
);
