<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "csvImport",
  "module": "import",
  "action": "csv",
  "options": {
    "path": "/prod_templage_csv.csv",
    "header": true
  },
  "meta": [],
  "outputType": "array",
  "output": true
}
JSON
);
?>