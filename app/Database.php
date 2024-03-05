<?php

namespace App\StoreSearch;

class Database
{
    public static function create($database)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . $database;

        $check_table = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");

        if($check_table == $table_name) {
            return;
        }

        $sql = "CREATE TABLE {$table_name} (
        store_id mediumint(9) NOT NULL AUTO_INCREMENT,
        store_name VARCHAR(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        store_address VARCHAR(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        store_lat VARCHAR(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        store_long VARCHAR(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        store_city VARCHAR(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        created_at DATETIME DEFAULT NOW() NULL,
        PRIMARY KEY  (store_id)
        ) COLLATE=utf8mb4_unicode_520_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function save()
    {
    }
}