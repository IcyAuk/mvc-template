<?php

function show($stuff)
{
    echo "<pre>";
    echo print_r($stuff,true);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}