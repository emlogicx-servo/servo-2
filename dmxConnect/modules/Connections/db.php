<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "db",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "databaseType": "MySQL",
        "connectionString": "mysql:host=localhost;sslverify=false;port=3306;dbname=servodb;user=root;password=root;charset=utf8"
    }
}
JSON;
?>