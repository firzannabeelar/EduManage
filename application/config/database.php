<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

/**
 * Read DB connection parameters from environment variables.
 * Set these in Vercel (or .env locally) as:
 * DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
 *
 * Supabase defaults:
 *  - port: 5432
 *  - requires TLS/SSL (we set sslmode=require in DSN)
 */

$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbPort = getenv('DB_PORT') ?: '5432';
$dbName = getenv('DB_DATABASE') ?: 'postgres';
$dbUser = getenv('DB_USERNAME') ?: 'postgres';
$dbPass = getenv('DB_PASSWORD') ?: '';

// Build a PDO DSN for PostgreSQL with sslmode=require (Supabase needs TLS)
$dsn = "pgsql:host={$dbHost};port={$dbPort};dbname={$dbName};sslmode=require";

$db['default'] = array(
    // Use PDO driver for Postgres
    'dsn'      => $dsn,
    'hostname' => $dbHost,
    'username' => $dbUser,
    'password' => $dbPass,
    'database' => $dbName,
    'dbdriver' => 'pdo',        // use PDO with pgsql DSN above
    'dbprefix' => '',
    'pconnect' => FALSE,
    // show db errors only when not in production
    'db_debug' => (defined('ENVIRONMENT') && ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);