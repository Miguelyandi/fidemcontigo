<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        // 'sqlsrv' => [
        //     'driver' => 'sqlsrv',
        //     'host' => env('DB_HOST', 'localhost'),
        //     'port' => env('DB_PORT', '1433'),
        //     'database' => env('DB_DATABASE', 'forge'),
        //     'username' => env('DB_USERNAME', 'forge'),
        //     'password' => env('DB_PASSWORD', ''),
        //     'charset' => 'utf8',
        //     'prefix' => '',
        // ],


        //CONEXION A LA BD R-FAST
        // 'sqlsrv1' => [
        //     'driver' => env('DB_CONNECTION_S'),
        //     'url' => env('DATABASE_URL_S'),
        //     'host' => env('DB_HOST_S', 'LFIDTEMP01'),
        //     'port' => env('DB_PORT_S', '1433'),
        //     'database' => env('DB_DATABASE_S', 'FIDEM'),
        //     'username' => env('DB_USERNAME_S', ''),
        //     'password' => env('DB_PASSWORD_S', ''),
        //     'charset' => 'utf8',
        //     'prefix' => '',
        //     'prefix_indexes' => true,
        // ]

        'local_sql' => [
        'driver' => 'sqlsrv',
        'host' => env('DB_HOST_S', 'LFIDTEMP01\laptop'), // Servidor SQL Server
        'port' => env('DB_PORT_S', '1433'), // Puerto SQL Server
        'database' => env('DB_DATABASE_S', 'FIDEM'), // Base de datos
        'username' => env('DB_USERNAME_S', ''), // Sin usuario por autenticación de Windows
        'password' => env('DB_PASSWORD_S', ''), // Sin contraseña por autenticación de Windows
        'charset' => 'utf8',
        'prefix' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // PDO::SQLSRV_ATTR_ENCRYPT => true,
            // PDO::SQLSRV_ATTR_TRUST_SERVER_CERTIFICATE => true,
        ],
    ],
],
        

                // conexion a Azure
        //         'azure_sql' => [
        //     'driver' => 'sqlsrv',
        //     'host' => env('AZURE_DB_HOST', '172.200.35.22'),
        //     'port' => env('AZURE_DB_PORT', '5090'),
        //     'database' => env('AZURE_DB_DATABASE', 'your_database'),
        //     'username' => env('AZURE_DB_USERNAME', 'your_user'),
        //     'password' => env('AZURE_DB_PASSWORD', 'your_password'),
        //     'charset' => 'utf8',
        //     'prefix' => '',
        //     'options' => [
        //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //         PDO::SQLSRV_ATTR_ENCRYPT => true, // Azure requiere conexiones encriptadas
        //     ],
        // ],



        // Conexion local
//         'local_sql' => [
//     'driver' => 'sqlsrv',
//     'host' => env('LOCAL_DB_HOST', 'LFIDTEMP01'), // Nombre del servidor
//     'port' => env('LOCAL_DB_PORT', '1433'), // Puerto de SQL Server
//     'database' => env('LOCAL_DB_DATABASE', 'FIDEM'), // Nombre de la BD
//     'username' => env('LOCAL_DB_USERNAME', ''), // Usuario de SQL Server
//     'password' => env('LOCAL_DB_PASSWORD', ''), // Contraseña de SQL Server
//     'charset' => 'utf8',
//     'prefix' => '',
//     'options' => [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::SQLSRV_ATTR_ENCRYPT => false, // No se requiere encriptación en local
//         PDO::SQLSRV_ATTR_TRUST_SERVER_CERTIFICATE => true, // Para evitar errores con SSL
//     ],
// ],


   // ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
