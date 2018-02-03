<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 1/30/2018
 * Time: 10:11 AM
 */

function validName($name) {
    return ctype_alpha($name);
}
function validAge($age) {
    return (is_numeric($age) && $age >= 18);
}
function validPhone($phone) {
    $phone = str_replace('-', '', $phone);
    $phone = str_replace(' ', '', $phone);
    $phone = str_replace('(', '', $phone);
    $phone = str_replace(')', '', $phone);
    return (is_numeric($phone) && (strlen($phone) > 9 && (strlen($phone) < 16)));
}
function validOutdoor($listOfOutdoor) {
    $validList = array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing');
    foreach ($listOfOutdoor as $activity) {
        if (!in_array($activity, $validList)) {
            return false;
        }
    }
    return true;
}
function validIndoor($listOfIndoor) {
    $validList = array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games');
    foreach ($listOfIndoor as $activity) {
        if (!in_array($activity, $validList)) {
            return false;
        }
    }
    return true;
}