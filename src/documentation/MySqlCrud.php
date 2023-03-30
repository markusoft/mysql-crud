<?php

/**
 * @author        	Mark Angelo Angulo
 * @created         12/25/2022
 * @why             Because Laziness is a Virtue
 * @version			1.0.0
 */

interface MySqlCrud
{
    /**
     * Change connection maybe to another database
     * @param string $connection - database config name usually on your database.php file
     */
    public function change_connection($connection);
            
    /**
     * Set table for query
     * @param string $table - database table name
     */
    public function table($table);

    /**
     * Retrieve single record
     * @param string $id - primary key of the record to be retrieved
     * @param string $related_table - optional related database table
     * @param array $options - see options below
     */
    public function find($id, $related_table = NULL, $options = []);

    /**
     * Will filter the query using url parameters like (limit,offset,sort,order,etc)
     */
    public function filter();
    
    /**
     * Will filter custom query using url parameters like (limit,offset,sort,order,etc)
     * @param string $query - sql string
     * @param string|array $parameters - custom query parameters
     */
    public function filter_query($query, $parameters = NULL);
    
    /**
     * Search results
     * @param string $search - Search term
     * @param string|array $search_fields - database columns to be searched
     */
    public function search($search, $search_fields);
    
    /**
     * Will fetch records after given date
     * @param string $date - start date from which records will be retrieved
     * @param string|array $columns - column/s in which date will be checked
     */
    public function last_fetch($date, $columns);

    /**
     * Same with limit - will limit retrieved records
     * @param int $limit - number of records to be retrieved
     * @param int $offset - optional number of records to be skipped
     */
    public function take($limit, $offset = NULL);
    
    /**
     * Same with offset - will skip retrieved records
     * @param int $offset - number of records to be skipped
     */
    public function skip($offset);
    
    /**
     * Change the response case
     * @param string $case - case to be used (underscore,camel,pascal,etc)
     */
    public function switch_case($case);
    
    /**
     * Retrieve related records
     * @param string $table - related database table name
     * @param array $options - see options below
     */
    public function with($table, $options = []);

    /*
     * Retrieve related records with callback query
     * @param string $table - related database table name
     * @param function callback - see callback below
     * @param array $options - see options below
     */
    public function where_with($table, $callback, $options = []);

    /**
     * Retrieve related records with callback query on the pivot table
     * @param string $table - related database table name
     * @param function pivot_callback - see callback below
     * @param array $options - see options below
     */
    public function where_pivot($table, $pivot_callback, $options = []);
    
    /**
     * Retrieve related records with callback query on both table and the pivot table
     * @param string $table - related database table name
     * @param function callback - see callback below
     * @param function pivot_callback - see callback below
     * @param array $options - see options below
     */
    public function where_with_pivot($table, $callback, $pivot_callback, $options = []);
    
    /**
     * Add a custom column to the query
     * @param string name - name of the custom key to be added
     * @param function callback - see callback below
     * @param array $options - see options below
     */
    public function with_custom($name, $callback, $options = []);
    
    /**
     * Will retrieve only records that has related records
     * @param string $table - related database table name
     * @param type $options - see options below
     */
    public function has($table, $options = []);
    
    /**
     * Will retrieve only records that has related records with callback query
     * @param type $table - related database table name
     * @param type $callback - see callback below
     * @param type $options - see options below
     */
    public function where_has($table, $callback, $options = []);
    
    /**
     * Will retrieve only records that has no related records
     * @param string $table - related database table name
     * @param type $options - see options below
     */
    public function has_no($table, $options = []);
    
    /**
     * Will retrieve only records that has no related records with callback query
     * @param string $table - related database table name
     * @param function $callback - see callback below
     * @param array $options - see options below
     */
    public function where_has_no($table, $callback, $options = []);
    
    /**
     * Retrieves the number of records being retrieved
     * @param string $table - related database table name
     * @param array $options - see options below
     */
    public function with_count($table, $options = []);
    
    /**
     * Retrieves the number of records being retrieved
     * @param string $table - related database table name
     * @param array $options - see options below
     */
    public function has_count($table, $options = []);
    
    /**
     * Attach existing records to another record
     * @param string $table - related database table name
     * @param array $records - Array of primary keys to be attached
     * @param array $options - see options below
     */
    public function attach($table, $records, $options = []);
    
    /**
     * Create and attach new records to another record
     * @param string $table - related database table name
     * @param array $records - array of new record to be attached
     * @param boolean $new - create a new record for each queried records
     * @param array $options - see options below
     */
    public function attach_new($table, $records, $new = FALSE, $options = []);

    /**
     * Remove relation between records
     * @param string $table - related database table name
     * @param array $records - array of primary keys to be detached
     * @param array $options - see options below
     */
    public function detach($table, $records, $options = []);
    
    /**
     * Attach existing records to another record and detach relations not in sync
     * @param string $table - related database table name
     * @param array $records - array of primary keys to be sync
     * @param boolean $delete - delete related records not in sync
     * @param array $options - see options below
     */
    public function sync($table, $records, $delete = FALSE, $options = []);
    
    /**
     * Create and attach new records to another record and detach relations not in sync
     * @param string $table - related database table name
     * @param array $records - array of new record to be sync
     * @param boolean $new - create a new record for each queried records
     * @param boolean $delete - delete related records not in sync
     * @param array $options - see options below
     */
    public function sync_new($table, $records, $new = FALSE, $delete = FALSE, $options = []);

    /**
     * Executes attach, detach, add, edit and sync functions
     */
    public function save();

    /**
     * Executes find, filter, with, has and most query functions 
     * @param array $options - see options below
     */
    public function get_result($options = []);
    
    /*
     * Retrieves records with children, grand children and so on
     * @param array $options = [
     *      referenced_key - field being referenced usually primary key
     *      referencing_key - if no pivot table is set parent field, otherwise parent field on the same table
     *      parent_referencing_key - parent field on pivot table
     *      pivot table - table with recursion usually table that references same table twice
     * ]
     * @param array $get_options - same options used in get_result (see options below)
     */
    public function get_recursive($options, $get_options = []);
    
    /**
     * Executes insert query
     * @param array $records - Array of the record to be inserted
     * @param array $options - see options below
     */
    public function add($records, $options = []);
    
    /**
     * Executes update query
     * @param array $records - Array of the record to be updated
     * @param array $options - see options below
     */
    public function edit($records, $options  = []);
    
    /**
     * Executes either an insert query if the record exists otherwise updates the record
     * @param array $record - record to be inserted or updated
     * @param array $options - see options below
     */
    public function push($record, $options = []);
    
    /**
     * Executes delete query
     * @param int|string|array $ids - key or keys to be deleted
     * @param type $options - see options below
     */
    public function destroy($ids = [], $options = []);
    

    /*
    |--------------------------------------------------------------------------
    | Useful Public Functions
    |--------------------------------------------------------------------------
     */
    
    /**
     * Retrieve current database table name
     * @returns string
     */
    public function get_table();
    
    /**
     * Retrieves current tables primary key
     * @returns string
     */
    public function get_primary_key();
    
    /**
     * Retrieves current limit
     * @returns integer
     */
    public function get_limit();
    
    /**
     * Retrieves current offset
     * @returns integer
     */
    public function get_offset();
    
    /**
     * Retrieve number of results
     */
    public function get_result_count();
    
    /**
     * Change case of a certain word
     * @param string $str - string to be changed
     * @param string $case - case to which the string will be changed (camel, pascal, underscore, etc)
     */
    public function change_case($str, $case = 'human');
    
    /**
     * Change array values to a certain case
     * @param array $arr - array with values to be changed
     * @param string $case - case to which the keys will be changed (camel, pascal, underscore, etc)
     */
    public function change_array_case($arr, $case = 'mixed');
    
    /**
     * Change array and inner arrays (recursive) values to a certain case
     * @param array $arr - array with values to be changed
     * @param string $case - case to which the keys will be changed (camel, pascal, underscore, etc)
     */
    public function recursive_change_array_case($arr, $case = 'mixed');
    
    /**
     * Change associative array keys to a certain case
     * @param array $assoc - associative array with keys to be changed
     * @param string $case - case to which the keys will be changed (camel, pascal, underscore, etc)
     */
    public function change_array_keys_case($assoc, $case = 'mixed');
    
    /**
     * Change associative array and inner arrays (recursive) keys to a certain case
     * @param array $assoc - associative array with keys to be changed
     * @param string $case - case to which the keys will be changed (camel, pascal, underscore, etc)
     */
    public function recursive_change_array_keys_case($assoc, $case = 'mixed');
    
    
    /*
    |--------------------------------------------------------------------------
    | Options - Array of options to be used on some functions
    |--------------------------------------------------------------------------
    |
    | string rename - Rename records to be retrieved instead of default database table name
    | string primary_key - The primary key column of the table
    | string referencing_key - The column being referenced from the table (foreign_key)
    | string referenced_key - The column being referenced on the other table
    | string pivot_table - 
    | string pivot_referencing_key -
    | string pivot_referenced_key - 
    | array mutators - 
    | array accessors - 
    | array fractals - 
    | 
    | $options = array(
    |       'rename' => 'record_name',
    |       'primary_key' => 'id',
    |       'referencing_key' => 'user_id',
    |       'referenced_key' => 'id',
    |       'pivot_table' => 'user_roles',
    |       'pivot_referencing_key' => 'role_id',
    |       'pivot_referenced_key' => 'id',
    | )
    |
    */
    
    /*
    |--------------------------------------------------------------------------
    | Callback - Callback function to be called
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
}