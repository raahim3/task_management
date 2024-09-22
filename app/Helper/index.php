<?php

function formatText($string) {
    $string = str_replace('_', ' ', $string);
    $string = ucwords($string);
    return $string;
}

function formatDate($date) {
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    return $dateObj->format('d-m-Y');
}