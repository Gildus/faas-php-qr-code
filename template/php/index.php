<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/function/vendor/autoload.php';

$stdin = fgets(STDIN);

(new \App\Handler())->handle($stdin);