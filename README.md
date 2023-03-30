# What is MySql CRUD
[MySql Crud](https://github.com/markusoft/mysql-crud) is a Plug and Play PHP Library created to Auto-magically build CRUD capabilities for your MySql Database. Although it has similarities with Query Builder and Eloquent ORM but on Steroids, it is not meant to replace them but to complement and work in conjuction with them.

# Easy Peasy Summary

[Basic Functionalities](#basic-functionalities)

| Function | Code | Description |
|----------|------|-------------|
| [table($db_table)](#table) | $crud->table('products') | Sets database table |
| [find($id)](#find) | $crud->find(1) | Retrieve records with id = 1 |
| [add($records)](#add) | $crud->add($records) | Add record/s |
| [edit(records)](#edit) | $crud->edit($records) | Edit record/s |
| [delete($ids)](#delete) |  $crud->delete($ids) | Delete record/s |
| [get()](#get) | $crud->table('products')->get() | Executes get queries |
| [reset()](#reset) | $crud->reset() | Reset Query |
| [close()](#close) | $crud->close() | Close database connection |
	
[Query Builder](#query-builder)

| Function | Code | Description |
|----------|------|-------------|
| [where()](#where) | $crud->where('id', 1) | Adds where clause |
| [where_raw($sql)](#where-raw) | $crud->where_raw($sql) | Adds raw where clause |
| [or_where()](#or-where) | $crud->or_where('status', 'active') | Add or where clause |
| [where_in($column, $in)](#where-in) | $crud->where_in('id', [1,2,3]) | Add where in clause |
| [or_where_in($column, $in)](#or-where-in) | $crud->or_where_in('id', [1,2,3]) | Add or where in clause |
| [where_not_in($column, $in)](#where-not-in) | $crud->where_not_in('id', [1,2,3]) | Add or where not in clause |
| [like($column, $like)](#like) | $crud->like('name', 'iphone') | Add like clause |
| [or_like($column, $like)](#or-like) | $crud->or_like('name', 'iphone') | Add or like clause |
| [having()](#having) | $crud->having('status', 'active') | Add having clause |
| [or_having()](#or-having) | $crud->or_having('status', 'active') | Add or having clause |
| [having_in($column, $in)](#having-in) | $crud->having_in('id', [1,2,3]) | Add having in clause |
| [or_having_in($column, $in)](#or-having-in) | $crud->or_having_in('id', [1,2,3]) | Add or having in clause |
| [having_not_in($column, $in)](#having-not-in) | $crud->having_not_in('id', [1,2,3]) | Add or having not in clause |
| [group_by($group)](#group-by) | $crud->group_by('status') | Add group by clause |
| [sort or order_by($sort, $order')](#order-by) | $crud->order_by('name', 'asc') | Add order by clause |
| [take or limit($limit, $offset)](#limit) | $crud->limit(100) | Add limit clause |
| [skip or offset($offset)](#offset) | $crud->offset(100) | Add offset clause |

[Advance Get Functionalities](#advance-get-functionalities)

| Function | Code | Description |
|----------|------|-------------|
| [search($search, $columns)](#search) | $crud->search('ipone', ['name', 'description']) | Search tables |
| [filter()](#filter) | $crud->filter() | Adds filters from url limit, sort etc |
| [query or raw()](#raw) | $crud->raw('SELECT * FROM products') | Creates a raw sql query |
| [filter_query or filter_raw()](#filter-raw) | $crud->filter_raw() | Filters raw sql query |
| [switch_case($case)](#switch-case) | $crud->switch_case('pascal') | Changes record cases |
	
[Advance Get Related Functionalities](#advance-get-related-functionalities)

| Function | Code | Description |
|----------|------|-------------|
| [with($table)](#with) | $crud->with('products') | Retrieves related records |
| [with_recursive($table, $recursive_options)](#with-recursive) | $crud->with_recursive('categories') | with_recursive('categories') | Retrieves recursive records |
| [where_with($table, $callback)](#where-with) | $crud->where_with('products', static function($query){ return $query->where('status', 'active'); }) | Work with related table |
| [where_pivot($table, $callback)](#where-pivot) | $crud->where_pivot('categories', static function($query){ return $query->where('status', 'active'); }) | Work with pivot tables |
| [where_with_pivot($table, $callback, $pivot_callback)](#where-with-pivot) | $crud->where_with_pivot('categories', static function($query){ return $query->where('status', 'active'); }) | Work with related and pivot tables |
| [with_custom($name, $callback)](#with-custom) | $crud->with_custom('any', static function($record){ return $record['foo'] = 'bar'; }) | Add or edit anything on records |
| [has($table)](#has) | $crud->has('products') | Queries only records that has
| [where_has($table, $callback)](#where-has) | $crud->where_has('products', static function($query){ return $query->where('status', 'active'); }) | Queries only records that has and filtered more |
| [has_no($table)](#has-no) | $crud->has_no('products') | Queries only records that has no |
| [where_has_no($table, $callback)](#where-has-no) | $crud->where_has_no('products', , static function($query){ return $query->where('status', 'active'); }) | Queries only records that has no and filtered more |
| [with_count($table)](#with-count) | $crud->with_count('products') | Returns only the count of records |
| [has_count($table)](#has-count) | $crud->has_count('products') | Returns only the records that has count |
	
[Advance Add Functionalities](#advance-add-functionalities)

| Function | Code | Description |
|----------|------|-------------|
| [push($record)](#push) | $crud->push(record) | Adds or updates record if existing |
| [attach($table, $records)](#attach) | $crud->attach('products', [1,2,3]) | Attach records |
| [attach_new($table, $records, $new)](#attach-new) | $crud->attach_new('products', $records) | Attach new records |
| [detach($table, $records)](#detach) | $crud->detach('products', [1,2,3]) | Detach records |
| [sync($table, $records)](#sync) | $crud->sync('products', $records) | Attaches records and detaches the old ones |
| [sync_new($table, $records)](#sync-new) | $crud->sync_new('products', $records) | Attaches new records and detaches the old ones |
| [save()](#save) | $crud->save() | Executes above functions |
	
[Helpful Functions](#helpful-functions)

| Function | Code | Description |
|----------|------|-------------|
| [get_result_count()](#get-result-count) | $crud->get_result_count() | Get result count |
| [get_db_table_case()](#get-db-table-case)  | $crud->get_db_table_case() | Get database table case |
| [get_db_column_case()](#get-db-column-case)  | $crud->get_db_column_case() | Get database column case |
| [change_case($str, $case)](#change-case)  | $crud->change_case('Your Text', 'pascal') | Change text case |
| [recursive_change_array_case($arr, $case)](#recursive-change-array-case)  | $crud->recursive_change_array_case() | Change array case |
| [recursive_change_array_keys_case($assoc, $case)](#recursive-change-array-keys-case)  | $crud->recursive_change_array_keys_case | Change array keys case |
| [flatten_json($json, $case)](#flatten-json)  | $crud->flatten_json($json, 'pascal') | Flatten json |
| [validate($validate, $validations)](#validate)  | $crud->validate($records, $validations) | Use built-in validation |
| [get_validation_errors()](#get-validation-errors)  | $crud->get_validation_errors() | Get validation errors |

# Table of Contents
- [What is MySql CRUD](#what-is-mysql-crud)
- [Easy Peasy Summary](#easy-peasy-summary)
- [Installation](#installation)
	- [Install via Composer](#install-via-composer)
	- [Manual installation](#manual-installation)
	- [PHP Users](#php-users)
	- [Codeigniter Users](#codeigniter-users)
	- [Laravel Users](#laravel-users)
	- [Other PHP Frameworks](#other-php-frameworks)
-[Basic Functionalities](#basic-functionalities)
-[Query Builder](#query-builder)
-[Advance Get Functionalities](#advance-get-functionalities)
-[Advance Get Related Functionalities](#advance-get-related-functionalities)
-[Advance Add Functionalities](#advance-add-functionalities)
-[Helpful Functions](#helpful-functions)
-[Built-in Validation](#built-in-validation)
-[Configuration](#configuration)
-[Database Table Configuration](#database-table-configuration)

# Installation
To install this project, you have two options:

## Install via Composer

To install using Composer, run the following command:
	
	composer require mg3lo/mysql-crud

## Manual Installation

To install manually, follow these steps:

1. Download the [library](https://github.com/markusoft/dev-tools/raw/main/Mg3lo.zip) from [developer tools](https://github.com/markusoft/dev-tools).
2. Unzip the downloaded file to your extensions directory.

### System requirements

- PHP 7.0 or higher
- MySQL 5.0 or higher

Note: Tested on the following versions but might work on older versions as well.

## PHP Users
1. Download the sample [installation](https://github.com/markusoft/dev-tools/raw/main/PHP-MySqlCrud%20v%5B1.0.0%5D.zip) or Install via composer

	```php
	composer require mg3lo/mysql-crud
	```
	
2. Load the library on php file
	```php
	<?php
	// Load library installed via composer
	require_once './vendor/autoload.php'; 
	
	// Or load library installed manually
	require_once './Mg3lo/vendor/autoload.php'; 

	use Mg3lo\MySqlCrud;
	```

3. Connect to your database

	```php
	<?php
	
	require_once './vendor/autoload.php'; 
	
	use Mg3lo\MySqlCrud;

	// connect to your database
	$crud = new MySqlCrud([
	  'username' => 'root',
	  'password' => '',
	  'database' => 'my_database'
	]);

	// do your magic
	$products = $crud->table('products')->get();
	```

4. Enjoy!

## Codeigniter Users
1. Unzip the sample library for [Codeigniter 3](https://github.com/markusoft/dev-tools/raw/main/CI3-MySqlCrud%20v%5B1.0.0%5D.zip) or [Codeigniter 4](https://github.com/markusoft/dev-tools/raw/main/CI4-MySqlCrud%20v%5B1.0.0%5D.zip) or Install via composer

	```php
	composer require mg3lo/mysql-crud
	```
	
2. Load the library on your controller
	```php
	<?php 
	  // Load library installed via composer
	  require_once FCPATH . 'vendor/autoload.php'; 
	
	  // Or load library installed manually
	  require_once APPPATH . 'third_party/Mg3lo/vendor/autoload.php';
		
	  use Mg3lo\MySqlCrud;
	```

3. Connect to your database

	```php
	<?php 
	  require_once APPPATH . 'third_party/Mg3lo/vendor/autoload.php';
		
	  use Mg3lo\MySqlCrud;
		
	  class Crud extends CI_Controller {

		public function index()
		{
		  // connect to your mysql database
		  $crud = new MySqlCrud([
			'username' => 'root',
			'password' => '',
			'database' => 'my_database'
		  ]);
		  
		  // do your magic
		  $products = $crud->table('products')->get();
		}
	  }
	```

4. Enjoy!

## Laravel Users
1. Install via composer or unzip the [library](https://github.com/markusoft/dev-tools/raw/main/Laravel-MySqlCrud%20v%5B1.0.0%5D.zip) according to folder structure
	```php
	composer require mg3lo/mysql-crud
	```
2. Load the library on your route or controller
	```php
	// load the library if you did not install it via composer
	require_once app_path('Mg3lo/vendor/autoload.php');
	use Mg3lo\MySqlCrud;
	```
3. Connect to your database

	```php
	use Mg3lo\MySqlCrud;
	
	// connect to your mysql database
    $crud = new MySqlCrud([
	  'host' => env(DB_HOST),
	  'username' => env(DB_USERNAME),
	  'password' => env(DB_PASSWORD),
	  'database' => env(DB_DATABASE),
    ]);
	
	// do your magic
    $products = $crud->table('products')->get();
	```

4. Enjoy!

## Other PHP Frameworks
1. Download the sample [installation](https://github.com/markusoft/dev-tools/raw/main/PHP-MySqlCrud%20v%5B1.0.0%5D.zip) or Install via composer

	```php
	composer require mg3lo/mysql-crud
	```
	
2. Load the library
	```php
	<?php
	// Load library installed via composer
	require_once './vendor/autoload.php'; 
	
	// Or load library installed manually
	require_once '.Your_Directory/Mg3lo/vendor/autoload.php'; 

	use Mg3lo\MySqlCrud;
	```

3. Connect to your database

	```php
	<?php
	
	require_once './vendor/autoload.php'; 
	
	use Mg3lo\MySqlCrud;

	// connect to your database
	$crud = new MySqlCrud([
	  'username' => 'root',
	  'password' => '',
	  'database' => 'my_database'
	]);

	// do your magic
    $products = $crud->table('products')->get();
	```

4. Enjoy!

# Basic Functionalities
Here are the basics

## Table
Set database table name

	$crud->table('products')
	     ->get();
	
## Find
Find specific record

	$crud->table('products')
	     ->find(1)
	     ->get();

We can also use find to retrieve child records. In this example we get products that belongs to category 1

	$crud->table('categories')
	     ->find(1, 'products')
	     ->get();
		 
## Add
Adding record

	$product = [
		'name' => 'iphone',
		'description' => 'cellphone',
		'price' => 999
	];

	$crud->table('products')
	     ->add($product);
		 
Adding multiple records

	$products = [
	  [
		'name' => 'iphone',
		'description' => 'cellphone',
		'price' => 999
	  ],
	  [
		'name' => 'android',
		'description' => 'cellphone',
		'price' => 499
	  ]
	];

	$crud->table('products')
	     ->add($products);
		 
## Edit
Edit record

	$product = [
	  'id' => 1,
	  'name' => 'iphone',
	  'description' => 'cellphone',
	  'price' => 999
	];

	$crud->table('products')
	     ->edit($product);
		 
Edit multiple records

	$products = [
	  [
	    'id' => 1,
		'name' => 'iphone',
		'description' => 'cellphone',
		'price' => 999
	  ],
	  [
	    'id' => 2,
		'name' => 'android',
		'description' => 'cellphone',
		'price' => 499
	  ]
	];

	$crud->table('products')
	     ->add($products);
		 
## Delete
Delete record

	$crud->table('products')
		 ->where('id', 1)
	     ->delete();
		 
Delete multiple records

	$crud->table('products')
	     ->delete([1,2,3]);
		 
## Get
Execute get queries

	$crud->table('products')
		 ->where('price', '<', 1000)
	     ->get();


## Reset
Reset query

	$crud->reset();
	

## Close
Close database connection

	$crud->close();
	
# Query Builder
Query Builder

## Where
Where clause

	$crud->table('products')
		 ->where('price', 999)
	     ->get();
		 
You can also use where using eloquent syntax

	$crud->table('products')
		 ->where('price', '=', 999)
	     ->get();
		 
Or multiple where clauses
	
	$crud->table('products')
		 ->where([
			['price', '=', 999],
			['status', '=' 'active']
		  ])
	     ->get();
		 
## Where Raw
Where clause

	$crud->table('products')
		 ->where_raw('id = 1')
	     ->get();
		 
## Or Where
Or where clause

	$crud->table('products')
		 ->where('description', 'cellphone')
		 ->or_where('price', '<', 1000)
	     ->get();
		  
## Where In
Where in clause

	$crud->table('products')
		 ->where_in('id', [1,2,3])
	     ->get();

## Or Where In
Or where in clause

	$crud->table('products')
		 ->where_in('id', [1,2,3])
		 ->or_where_in('status', ['deleted','archived']
	     ->get();
 
## Where Not In
where not in clause

	$crud->table('products')
		 ->where_not_in('id', [1,2,3])
	     ->get();

## Like
Like clause

	$crud->table('products')
		 ->like('name', 'phone')
	     ->get();
		 
## Or Like
Or like clause

	$crud->table('products')
		 ->like('name', 'phone')
		 ->or_like('description', 'phone')
	     ->get();
		 
## Having
Having clause

	$crud->table('products')
		 ->where('price', '<', 1000)
		 ->having('status', 'active')
	     ->get();
		 
## Or Having
Or having clause

	$crud->table('products')
		 ->where('price', '<', 1000)
		 ->having('status', 'active')
		 ->or_having('status', 'archived')
	     ->get();
		 
## Having In
Having in clause

	$crud->table('products')
		 ->where('price', '<', 1000)
		 ->having_in('status', ['archived','deleted'])
	     ->get();
		 
## Or Having In
Or having in clause

	$crud->table('products')
		 ->where('price', '<', 1000)
		 ->having_in('status', ['archived','deleted'])
		 ->or_having_in('description', ['phone','tablet']
	     ->get();
		 
## Having Not In
Having not in clause

	$crud->table('products')
		 ->where('price', '<', 1000)
		 ->having_not_in('status', ['archived','deleted'])
	     ->get();
		 
## Group By
Group by clause

	$crud->table('products')
		 ->where('price', '<', 1000)
		 ->group_by('status')
	     ->get();
		 
## Order By
Order by clause defaults to ascending

	$crud->table('products')
		 ->order_by('price')
	     ->get();
		 
We can pass second order parameter

	$crud->table('products')
		 ->order_by('price', 'desc')
	     ->get();


## Sort
Same with order by clause

	$crud->table('products')
		 ->order_by('price', 'desc')
	     ->get();
		 
## Limit
Limit clause

	$crud->table('products')
		 ->limit(100)
	     ->get();
		 
We can pass second parameter for offset

	$crud->table('products')
		 ->limit(100, 100)
	     ->get();
		 
## Take
Same with limit clause

	$crud->table('products')
		 ->take(100, 100)
	     ->get();
		 
## Offset
Offset clause

	$crud->table('products')
		 ->offset(100)
	     ->get();
		 
## Skip
Same with offset clause

	$crud->table('products')
		 ->skip(100)
	     ->get();
		 
# Advance Get Functionalities

## Search
Search records

	$crud->table('products')
		 ->search('name', 'phone')
	     ->get();
		
## Filter
Filter results from url parameters limit, offset, sort, order or case

	$crud->table('products')
		 ->filter()
	     ->get();
		
		
## Raw
Query using raw sql

	$crud->raw('SELECt * FROM products')
	     ->get();
		 
## Query
Same with raw

	$crud->query('SELECt * FROM products')
	     ->get();
		 
## Filter Raw
Filters raw query using url parameters

	$crud->raw('SELECt * FROM products')
		 ->filter_raw()
	     ->get();
		 
## Filter Query
Same with filters raw

	$crud->query('SELECt * FROM products')
		 ->filter_query()
	     ->get();
		 
## Switch Case
Change the case of the queried records

	$crud->table('products')
		 ->switch_case('pascal')
	     ->get();
		 
# Advance Get Related Functionalities
Retrieves related records

## With
Retrieves records with related tables

	$crud->table('categories')
		 ->with('products')
	     ->get();

## With Recursive
Retrieves records with recursive

	$crud->table('categories')
		 ->with('categories')
	     ->get();

## Where With
Further query related tables

	$crud->table('categories')
		 ->where_with('products', static function($query){
		    return $query->where('status', 'active')
		 })
	     ->get();
		 
## Where Pivot
Further query pivot tables

	$crud->table('categories')
		 ->where_pivot('products', static function($query){
		    return $query->where('status', 'active')
		 })
	     ->get();
		 
## Where With Pivot
Further query related and pivot tables

	$crud->table('categories')
		 ->where_with_pivot('products', static function($related_query){
		   return $related_query->where('price', '<', 1000);
		 }, static function($pivot_query){
		   return $pivot_query->where('status', 'active);
		 })
	     ->get();
		 
## With Custom
Adds additional info to records

	$crud->table('users')
		 ->with_custom('products', static function($user){
		   $user['foo'] = 'bar';
		   return user;
		 })
	     ->get();
		 
## Has
Retrieves only records that has related records

	$crud->table('categories')
		 ->has('products')
	     ->get();
		 
## Where Has
Further query has table

	$crud->table('categories')
		 ->where_has('products', static function($query){
		    return $query->where('price', '<', 1000)
		 })
	     ->get();

## Has No
Retrieves only records that has no related records

	$crud->table('categories')
		 ->has_no('products')
	     ->get();
		 
## Where Has No
Further query has no table

	$crud->table('categories')
		 ->where_has_no('products', static function($query){
		    return $query->where('price', '<', 1000)
		 })
	     ->get();
		 
## With Count
Retrieves only record count of related records

	$crud->table('categories')
		 ->with_count('products')
	     ->get();

## Has Count
Retrieves only record count that has related records

	$crud->table('categories')
		 ->has_count('products')
	     ->get();
		 
# Advance Add Functionalities

## Push
Checks if the record exists and updates it otherwise create it

	$product = [
	  'id' => 1,
	  'name' => 'iphone',
	  'description' => 'cellphone'
	];
	
	$crud->table('products')
		 ->push($product);

## Attach
Attach existing records to related table

	$crud->table('categories')
		 ->attach('products', [1,2]);
		 ->save();
		 
## Attach New
Attach new record to related table

	$product = [
	  'name' => 'iphone',
	  'description' => 'cellphone'
	];
	
	$crud->table('categories')
		 ->attach_new('products', $product);
		 ->save();

## Detach
Removes relation to related record

	$crud->table('categories')
		 ->detach('products', [1,2]);
		 ->save();

## Sync
Attach relation to related record and remove all previous relations

	$crud->table('categories')
		 ->sync('products', [1,2]);
		 ->save();

## Sync New
Attach a new record to related record and remove all previous relations

	$product = [
	  'name' => 'iphone',
	  'description' => 'cellphone'
	];
	
	$crud->table('categories')
		 ->sync_new('products', $product);
		 ->save();

## Save
Executes advance add functionalities

# Helpful Functions


## Get Result Count
Retrieves result count

	$crud->table('products')
		 ->get_result_count();
		 
## Get DB Table Case
Retrieves database table case

	$crud->get_db_table_case();
	
## Get DB Column Case
Retrieves database column case

	$crud->get_db_column_case();
	
## Change Case
Convert text from one case to another

	$crud->change_case('My Text', 'pascal');
	
## Recursive Change Array Case
Change array case from one case to another
	
	$crud->recursive_change_array_case($arr, 'pascal');
	
## Recursive Change Array Keys Case
Change array keys case from one case to another

	$crud->recursive_change_array_case($assoc, 'pascal');
	
## Flatten Json
Flatten a json file to single dimension array

## Validate
Built-in form validation

	$product = [
	  'name' => 'iphone',
	  'description' => 'cellphone'
	];
	
	$validations = [
	  'name' => [
	    'rules' => 'required'
	  ],
	  'description' => [
	    'rules' => 'max:255'
	  ]
	];
	
	$crud->validate($product, $validations);

## Get Validation Errors
Retrieve errors

	$crud->get_validation_errors();
	
# Built-in Validation
Built in validation

	$validations = [
	  'column' => [
	    'rename' => 'New Name',
		'rules' => ['required', 'min:8'],
		'custom' => [
		  'pci' => static function($val) {
		    return preg_match('/^(?=^.{6,99}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-_=+.])(?!.*?(.)\1{1,})^.*$/', $val);
		  }
		],
		'messages' => [
		  'pci' => static function($val){ return "{$val} should be pci"; },
		  'required' => static function(){ return 'This field is required'; },
		  'min' => static function(){ return 'Minimum is 6 characters'; }
		]
	  ]
	]

## Rules

| Rule | Usage | Description |
|------|-------|-------------|
| alpha | 'alpha' | Alpha characters |
| alphadash | 'alphadash' | Alpha characters and dashes |
| alphanum | 'alphanum' | Alpha numeric characters |
| array | 'array' | Array |
| base64 | 'base64' | base64 encoded |
| boolean | 'boolean' | True or false |
| decimal | 'decimal' | Decimal numbers |
| differs | 'differs:confirm_password' | Different from other fields or text |
| email | 'email' | Valid email |
| greater | 'greater:50' | Greater than the value |
| in | 'in:a,b,c' | Within choices |
| integer | 'integer' | Integer value |
| lesser | 'lesser:100' | Lesser than the value |
| matches | 'matches:confirm_password' | Matches other fields or text |
| max | 'max:255' | Maximum characters | 
| min | 'min:8' | Minimum characters |
| natural | 'natural' | Natural numbers |
| not | 'not' | Not similar |
| number | 'number' | Valid number |
| phone | 'phone' | Valid phone number |
| required | 'required' | Value is required |
| url | 'url' | Valid URL |

#Configuration
Make sure your configuration are correct

## Database Table Configuration
Optionally you can configure your database tables

	$config['database_tables'] =  [
    'users' => 
    [
      'primary_key' => 'id',
      'accessors' => 
        [
          'birthdate' => static function($value) {
            return date('M d, Y', strtotime($value));
          }
        ],
      'mutators' => 
        [
          'password' => static function($value) {
            return password_hash($value, PASSWORD_BCRYPT, ["cost" => 12]);
          },
        ],
      'fractals' => 
        [
          'add' => static function($record) {
            return [
              'id' => (int) $record['id'],
              'email' => $record['username'],
              'first_name' => $record['first_name'],
              'last_name' => $record['last_name'],
              'gender' => $record['gender'],
              'birthdate' => $record['birthdate'],
              'is_active' => $record['is_active'],
              'date_created' => $record['date_created'],
              'date_updated' => $record['date_created'],
              'avatar' => $record['avatar'],
              'first_time_log_in' => $record['first_time_log_in'],
              'numbers_of_login' => $record['numbers_of_login']
            ];
          },
          'read' => static function($record) {
            return [
              'id' => (int) $record['id'],
              'email' => $record['username'],
              'first_name' => $record['first_name'],
              'last_name' => $record['last_name'],
              'full_name' => $record['first_name'] . ' ' . $record['last_name'],
              'gender' => $record['gender'],
              'birthdate' => $record['birthdate'],
              'is_active' => $record['is_active'],
              'date_created' => $record['date_created'],
              'date_updated' => $record['date_created'],
              'avatar' => $record['avatar'],
              'login' => [
                'first_time_log_in' => $record['first_time_log_in'],
                'numbers_of_login' => $record['numbers_of_login']
              ]
            ];
          }
        ],
      'related_tables' => 
        [
          'students' => [
            'table' => 'users',
            'referencing_key' => 'user_id',
            'referenced_key' => 'id'
          ]
        ],
      'validations' => 
        [
          'add' => [
            'id' => "required|int",
            'email' => "required|email",
          ],
          'edit' => [
            'id' => "required|int|greater_than[0]",
            'email' => "email"
          ]
        ],
      // note that additional validations will only apply if validations is not present
      'additional_validations' =>
        [
          'add' => [
            'id' => "greater:0",
            'email' => "unique:users.email",
          ],
          'edit' => [
            'id' => "greater:0",
            'email' => "email"
          ]
        ]
    ],
  ];