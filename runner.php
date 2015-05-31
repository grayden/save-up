<?php

require 'vendor/autoload.php';

use SaveUp\Jobs\Builder;

$jobs_json = json_decode(file_get_contents('backup.json'), true);

date_default_timezone_set('America/New_York');

foreach($jobs_json["backups"] as $type => $params) {
    (new Builder($type, $params))->job()->backup();
}
