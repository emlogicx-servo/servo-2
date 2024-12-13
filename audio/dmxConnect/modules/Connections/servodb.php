<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "servodb",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "connectionString": "mysql:host=localhost;dbname=servodb;user=root;password=root",
        "meta"  : {}
    }
}
JSON;
?>