<?php

namespace HashbarFree\AnalyticsCash; 

class Cash_Data {

    /**
     * [read]
     * @param  array  $args
     * @return [array] traking array
    */
    public static function cached(){
        global $wpdb;

        $order_by                  = 'totalviews';
        $table_name 	           = $wpdb->prefix . 'hthb_analytics';
        $sql_total_count           = "SELECT SUM(views) AS totalviews, SUM(clicks) AS totalclicks FROM $table_name WHERE %d"; // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- $table_name is $wpdb->prefix + a hardcoded string, not user input.
        $sql_postwise_count        = "SELECT post_id, SUM(views) AS totalviews, SUM(clicks) AS totalclicks FROM $table_name WHERE %d GROUP BY post_id"; // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- $table_name is $wpdb->prefix + a hardcoded string, not user input.
        $sql_caountrywise_count    = "SELECT country, SUM(views) AS totalviews, SUM(clicks) AS totalclicks FROM $table_name WHERE %d GROUP BY country ORDER BY $order_by DESC LIMIT 10"; // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- $table_name and $order_by are hardcoded above, not user input.
        $total_traking_count       = get_transient( 'total_ht_traking_count' );
        $postwise_traking_count    = get_transient( 'postwise_ht_traking_count' );
        $countrywise_traking_count = get_transient( 'countrywise_ht_traking_count' );

        if ( false === $total_traking_count ) {
            $total_traking_query = $wpdb->prepare( $sql_total_count, 1 ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- $sql_total_count is a hardcoded string built above.
            $total_traking_count = $wpdb->get_results( $total_traking_query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,PluginCheck.Security.DirectDB.UnescapedDBParameter -- $total_traking_query is the result of $wpdb->prepare() above.
            set_transient( 'total_ht_traking_count', $total_traking_count );
        }

        if ( false === $postwise_traking_count ) {
            $postwise_traking_query = $wpdb->prepare( $sql_postwise_count, 1 ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- $sql_postwise_count is a hardcoded string built above.
            $postwise_traking_count = $wpdb->get_results( $postwise_traking_query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,PluginCheck.Security.DirectDB.UnescapedDBParameter -- $postwise_traking_query is the result of $wpdb->prepare() above.
            set_transient( 'postwise_ht_traking_count', $postwise_traking_count );
        }

        if ( false === $countrywise_traking_count ) {
            $countrywise_traking_query = $wpdb->prepare( $sql_caountrywise_count, 1 ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- $sql_caountrywise_count is a hardcoded string built above.
            $countrywise_traking_count = $wpdb->get_results( $countrywise_traking_query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,PluginCheck.Security.DirectDB.UnescapedDBParameter -- $countrywise_traking_query is the result of $wpdb->prepare() above.
            set_transient( 'countrywise_ht_traking_count', $countrywise_traking_count );
        }
    }

    /**
     * [purge_cache] Manage Object Cache
     * @return [void] 
    */
    public static function delete_cache() { 	
        $get_total_count       = get_transient( 'total_ht_traking_count');
        $get_postwise_count    = get_transient( 'postwise_ht_traking_count');
    	$get_countrywise_count = get_transient( 'countrywise_ht_traking_count');

    	if ( false !== $get_total_count ) {
        	delete_transient('total_ht_traking_count');
    	}

        if ( false !== $get_postwise_count ) {
            delete_transient('postwise_ht_traking_count');
        }

        if ( false !== $get_countrywise_count ) {
            delete_transient('countrywise_ht_traking_count');
        }
    }

}