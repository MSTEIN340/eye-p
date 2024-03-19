<?php
/**
 * Created by PhpStorm.
 * User: mstei
 * Date: 9/28/2019
 * Time: 8:20 PM
 */

function eye_p_activate_plugin() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'eye_p';
    $charset_collate = $wpdb->get_charset_collate();
       $SQL_CREATE = "CREATE TABLE IF NOT EXISTS `" . $table_name . "` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `userid` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `duration` time NOT NULL,
  `rating` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `geo` varchar(200) NOT NULL,
  `registered` int(11) NOT NULL,
  `accepted_terms` int(11) NOT NULL,
  `is_euro` int(11) NOT NULL,
  `other` blob NOT NULL,
  `visited_uri` varchar(200) NOT NULL,
  `human` varchar(200) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
)  $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($SQL_CREATE);
}








/*
	if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {

		wp_die( "You must update WordPress to use this plugin.", 'DataSet' );
	}


	global $wpdb;

//	$table_name = $wpdb->prefix . 'DROP_FIELD_DATA';
	//if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name )



		$createSQL = "CREATE TABLE " . $wpdb->prefix . "drop_field_data (
ID bigint(20) NOT NULL AUTO_INCREMENT,
TABLE_NAME varchar(60),
COLUMN_NAME varchar(60),
FORMNAME varchar(60),
DATA_TYPE varchar(60),
CHARACTER_MAXIMUM_LENGTH int(11),
FIELD_LENGTH int(11),
LABEL varchar(60),
ABSOLUTE int(11),
XPOS decimal(18,0),
YPOS decimal(18,0),
VISIBLE int(11),
WRAP int(11),
ALIGN int(11),
DROPDOWN_TABLE varchar(60),
DROPDOWN_COLUMN varchar(60),
FILTER_FIELD varchar(60),
DISABLED int(11),
INPUT_WIDTH decimal(18,2),
TEXT_HEIGHT int(11),
TEXT_WIDTH int(11),
LINK_TO varchar(300),
LINK_FIELD varchar(300),
PRIMARY KEY  (ID)
) ENGINE=MyISAM AUTO_INCREMENT=0 " . $wpdb->get_charset_collate() . ";";

$DB_DATA = "CREATE TABLE " . $wpdb->prefix . "msds_db_data (
ID bigint(20) NOT NULL AUTO_INCREMENT,
DRIVER varchar(40),
SERVER varchar(40),
HOST varchar(40),
DB_ALIAS varchar(40),
DB_NAME varchar(40),
DB_USER varchar(40),
DB_PASS varchar(40),
LAST_CONNECT date DATETIME DEFAULT CURRENT_TIMESTAMP,,
CONNECT_STATUS varchar(16),
SETUP_BY varchar(60),
SETUP_DATE timestamp(6),
AUDIT_USR varchar(60),
AUDIT_DT datetime(6) DATETIME ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (ID)
) ENGINE=MyISAM AUTO_INCREMENT=0 " . $wpdb->get_charset_collate() . ";";

$FORM_DATA = "CREATE TABLE "  . $wpdb->prefix . "msds_form_data (
ID bigint(20) NOT NULL AUTO_INCREMENT,
POST_ID bigint(20) NOT NULL,
DATABASE_NAME varchar(120) DEFAULT NULL,
TABLE_NAME varchar(120) DEFAULT NULL,
FORMNAME varchar(120) DEFAULT NULL,
PRIMARYKEY varchar(120) NOT NULL DEFAULT 'ID',
IDENTITY varchar(120) NOT NULL DEFAULT 'ID',
NAVIGATION int(11) DEFAULT NULL,
RIMARY KEY (ID)
) ENGINE=MyISAM" . $wpdb->get_charset_collate() . ";";




//	echo $createSQL;
		require( ABSPATH . "/wp-admin/includes/upgrade.php" );


		//table not in database. Create new table

		if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $wpdb->prefix . "drop_field_data'" ) != ($wpdb->prefix . "drop_field_data") ) {
         //   dbDelta($createSQL);
        }

    if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $wpdb->prefix . "msds_db_data'" ) != ($wpdb->prefix . "msds_db_data") ){
        // dbDelta( $DB_DATA );
    }

    if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $wpdb->prefix . "msds_form_data'" ) != ($wpdb->prefix . "msds_form_data") ){
        // dbDelta( $FORM_DATA );
    }
		$ms_dataset_opts = get_option('msds_opts');
		if(!$ms_dataset_opts ){
			$opts = [
				'PDO_NAME' => 'WP',
				'TABLE' => 'DROP_FIELD_DATA',
				'FORMNAME'=>'DATATEST'

			];
			add_option('msds_opts', $opts);

		}







}



*/
?>