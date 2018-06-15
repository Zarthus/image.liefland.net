<?php

$headers = Config::get()['headers'];

foreach ($headers as $header => $expectation) {
    if (!isset($_SERVER[$header])) {
        unauthorized();
    }

    if ($_SERVER[$header] !== $expectation) {
        unauthorized();
    }
}
