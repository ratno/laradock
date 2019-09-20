#!/usr/local/bin/php -q
<?php
error_reporting(E_ERROR);
$env = file_get_contents("env-example");

$project = $argv[1];
$php_ver = $argv[2];

if(!$project && !$php_ver) {
    die("proses setup gagal, gunakan: ./setup.php project_name php_version\n");
}

$env = str_replace([
    "DATA_PATH_HOST=~/.laradock/data",
    "COMPOSE_PROJECT_NAME=laradock",
    "PHP_VERSION=7.3",
    "MYSQL_DATABASE=default",
    "MYSQL_USER=default",
    "MYSQL_PASSWORD=secret",
    "MYSQL_ROOT_PASSWORD=root",
    "PERCONA_DATABASE=homestead",
    "PERCONA_USER=homestead",
    "PERCONA_PASSWORD=secret",
    "PERCONA_ROOT_PASSWORD=root",
    "POSTGRES_DB=default",
    "POSTGRES_USER=default",
    "POSTGRES_PASSWORD=secret",

],[
    "DATA_PATH_HOST=~/.laradock/{$project}",
    "COMPOSE_PROJECT_NAME={$project}",
    "PHP_VERSION={$php_ver}",
    "MYSQL_DATABASE=appdb",
    "MYSQL_USER=ratno",
    "MYSQL_PASSWORD=ratno",
    "MYSQL_ROOT_PASSWORD=ratno",
    "PERCONA_DATABASE=appdb",
    "PERCONA_USER=ratno",
    "PERCONA_PASSWORD=ratno",
    "PERCONA_ROOT_PASSWORD=ratno",
    "POSTGRES_DB=appdb",
    "POSTGRES_USER=ratno",
    "POSTGRES_PASSWORD=ratno",
],$env);

$fenv = fopen(".env","w+");
fwrite($fenv,$env);
fclose($fenv);