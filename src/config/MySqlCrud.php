<?php

/*
|--------------------------------------------------------------------------
| License Key
|--------------------------------------------------------------------------
|
| Please support the library if you are using it on your website
| Developers eat too
| Or buy me a beer :)
|
*/
$config['license_key'] = '93f9b0d2bebe7729cbeb8add9808231d50a2ef8220576af3d584a450b49b6b1c';

/*
|--------------------------------------------------------------------------
| Database table names case
|--------------------------------------------------------------------------
|
| If your database uses uniform case for table names
| The library may be case insensitive
| (mixed) if your table names are not uniform otherwise its one of the ff:
| (camel, dash, pascal, snake, underscore)
|
*/
$config['db_table_case'] = 'mixed';

/*
|--------------------------------------------------------------------------
| Database column names case
|--------------------------------------------------------------------------
|
| If your database uses uniform case for column names
| The library may be case insensitive
| (mixed) if your column names are not uniform otherwise its one of the ff:
| (camel, dash, pascal, snake, underscore)
|
*/
$config['db_column_case'] = 'mixed';

/*
|--------------------------------------------------------------------------
| Language File
|--------------------------------------------------------------------------
|
| Overwrite texts here 
| or pass it as second parameter on the constructor
| $mysql = new MysqlCrud($config, $language);
|
*/
$config['language'] = [
    'error' => 'error',
    'database' => 'database',
    'connection' => 'connection',
    'transaction' => 'transaction',
    'method_chain' => 'method_chain',
    'exception' => 'exception',
    'table' => 'table',
    'find' => 'find',
    'where' => 'where',
    'get' => 'get',
    'get_recursive' => 'get_recursive',
    'add' => 'add',
    'edit' => 'edit',
    'save' => 'save',
    'delete' => 'delete',
    'attach' => 'attach',
    'detach' => 'detach',
    'sync' => 'sync',
    'after' => 'after',
    'after_fields' => 'after_fields',
    'no_table' => 'No table to work with',
    'no_where' => 'No where clause',
    'invalid_license' => 'Invalid License',
    'failed_to_connect' => 'Failed to connect to MySQL:',
    'unrelated_tables' => 'Unrelated tables',
    'cannot_detach' => 'Cannot detach',
    'cannot_delete_from' => 'Cannot delete from',
    'constraint_violation' => 'database constraint violation',
    'not_nullable' => 'is not NULLABLE',
    'not_exist' => 'does not exist',
    'invalid_after_date' => 'Invalid after date',
    'invalid_after_columns' => 'Invalid columns for after columns',
    'invalid_attach_table' => 'Invalid attach table',
    'invalid_detach_table' => 'Invalid detach table',
    'invalid_sync_table' => 'Invalid sync table',
    'database_transaction_failed' => 'Database transaction failed',
    'no_records_to_delete' => 'No records to be deleted',
    'no_records_to_work' => 'No records to work with try using find or where',
    'unable_to_add_empty_record' => 'Unable to add empty or invalid record',
    'non_recursive' => 'Unable to find foreign keys',
    'delete_all' => 'Delete without where clause is not supported to prevent accidentally deleting all records'
];

/*
|--------------------------------------------------------------------------
| Database table configurations
|--------------------------------------------------------------------------
|
| The library needs zero configuration but this is where you may override 
| your database table configurations. Database columns, relationships etc.
|
| Take note that these are global configurations, meaning it will affect all
| your queries when using this library. 
|
| primary_key - database table primary key (composite keys not supported)
| accessors - manipulate a certain column before retrieving it
| mutators - manipulate a certain column before storing it to the database
| fractals - manipulate the whole record befor retrieving or storing it
| validations - validations before creating or updating records see form_validation class
| additional_validations - by default validations will be based on your actual database table configuration
|                          additional validations may be added or overwrite them completely under validations
| related_tables - the library will know what tables are related to a certain table given that you designed your
|                  foreign keys correctly, otherwise you may re-define related tables here.
| 
*/

//$config['database_tables'] = 
//[
//    'users' => 
//        [
//            'primary_key' => 'id',
//            'accessors' => 
//                [
//                    'birthdate' => static function($value) {
//                        return date('M d, Y', strtotime($value));
//                    }
//                ],
//            'mutators' => 
//                [
//                    'password' => static function($value) {
//                        return password_hash($value, PASSWORD_BCRYPT, ["cost" => 12]);
//                    },
//                ],
//            'fractals' => 
//                [
//                    'add' => static function($record) {
//                        return [
//                            'id' => (int) $record['id'],
//                            'email' => $record['username'],
//                            'first_name' => $record['first_name'],
//                            'last_name' => $record['last_name'],
//                            'gender' => $record['gender'],
//                            'birthdate' => $record['birthdate'],
//                            'is_active' => $record['is_active'],
//                            'date_created' => $record['date_created'],
//                            'date_updated' => $record['date_created'],
//                            'avatar' => $record['avatar'],
//                            'first_time_log_in' => $record['first_time_log_in'],
//                            'numbers_of_login' => $record['numbers_of_login']
//                        ];
//                    },
//                    'read' => static function($record) {
//                        return [
//                            'id' => (int) $record['id'],
//                            'email' => $record['username'],
//                            'first_name' => $record['first_name'],
//                            'last_name' => $record['last_name'],
//                            'full_name' => $record['first_name'] . ' ' . $record['last_name'],
//                            'gender' => $record['gender'],
//                            'birthdate' => $record['birthdate'],
//                            'is_active' => $record['is_active'],
//                            'date_created' => $record['date_created'],
//                            'date_updated' => $record['date_created'],
//                            'avatar' => $record['avatar'],
//                            'login' => [
//                                'first_time_log_in' => $record['first_time_log_in'],
//                                'numbers_of_login' => $record['numbers_of_login']
//                            ]
//                        ];
//                    }
//                ],
//            'related_tables' => 
//                [
//                    'students' => [
//                        'table' => 'users',
//                        'referencing_key' => 'user_id',
//                        'referenced_key' => 'id'
//                    ]
//                ],
//            'validations' => 
//                [
//                    'add' => [
//                        'id' => "required|int",
//                        'email' => "required|valid_email",
//                    ],
//                    'edit' => [
//                        'id' => "required|int|greater_than[0]",
//                        'email' => "valid_email"
//                    ]
//                ],
//            // note that additional validations will only apply if validations is not present
//            'additional_validations' =>
//                [
//                    'add' => [
//                        'id' => "greater_than[0]",
//                        'email' => "is_unique[users.email]",
//                    ],
//                    'edit' => [
//                        'id' => "greater_than[0]",
//                        'email' => "valid_email"
//                    ]
//                ]
//        ],
//    
//    'next_table' => 
//          [
//              // configurations
//          ]
//];

return $config;