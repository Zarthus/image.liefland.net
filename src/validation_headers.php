<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    unauthorized();
}

if (!isset($_FILES['sharex_image'])) {
    unauthorized();
}
