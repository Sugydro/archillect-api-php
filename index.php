<?php
header('X-PHP: test');
http_response_code($_GET['code'] ?? 200);
echo 'Test output';
var_dump($_GET);
var_dump(opcache_get_status());
