<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "",
  "module": "core",
  "action": "redirect",
  "options": {
    "url": "/Login.php"
  }
}
JSON
);
?>