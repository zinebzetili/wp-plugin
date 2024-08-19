<?php
// Create database tables
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('DB_NAME') || !defined('DB_USER') || !defined('DB_PASSWORD') || !defined('DB_HOST')) {
    echo 'WordPress database credentials are not set up in wp-config.php file.';
    exit;
}

function create_wpdb(){
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . 'employee';
$sql = "CREATE TABLE " .$table_name."(
    id int(30) AUTO_INCREMENT NOT NULL,
    email_address varchar(250)  NOT NULL,
    password varchar(250) NOT NULL,
    first_name varchar(250) NOT NULL,
    last_name varchar(250) NOT NULL,
    position varchar(250) NOT NULL,
    phone_number int(20),
    address varchar(250),
    profile_picture blob,
    age int(3),
    biography varchar(250),
    department varchar(250),
    spaciality varchar(250),
    reporting_structure varchar(250),
    employment_status varchar(250),
    office_location varchar(250),
    office_work_hours varchar(250),
    education_and_certifications,
    membership mediumtext,
    work_experience longtext,
    skills_and_abilities longtext,
    training_and_development longtext,
    personal_interests longtext,
    performance_metrics mediumtext,
    security_clearances mediumtext,
    projects_and_contributions longtext,
    awards_and_recognition longtext,
    professional_development_goals longtext,
    volunteer_experience longtext,
    PRIMARY KEY (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta($sql);
echo "Tables created successfully!";
register_activation_hook(__FILE__, 'create_wpdb');
}
?>
