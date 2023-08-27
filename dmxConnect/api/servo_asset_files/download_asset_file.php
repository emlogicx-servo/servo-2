<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_file"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "fileDownload",
      "module": "fs",
      "action": "download",
      "options": {
        "path": "{{'/uploads/asset_files/'+$_POST.asset_file}}",
        "filename": "download"
      },
      "outputType": "boolean",
      "output": true
    }
  }
}
JSON
);
?>