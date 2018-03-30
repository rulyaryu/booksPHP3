<?php

    function doOrDoNotLink(string $getparam) {
        return isset($_GET[$getparam]) ? '&' . $getparam . '=' . urlencode($_GET[$getparam]) : '';
    }

?>