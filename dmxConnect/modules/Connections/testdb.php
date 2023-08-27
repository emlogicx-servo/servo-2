<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "testdb",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "connectionString": "mysql:host=localhost;dbname=testdb;user=root;password=root",
        "meta"  : {}
    }
}
JSON;
?>