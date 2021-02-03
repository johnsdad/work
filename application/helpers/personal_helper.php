<?php 
/**
 * @description check path, create if not exist
 * 
 * 
 * @return none
 * @author Divik Prakash
 * */
function check_dir($path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, TRUE);
    }
    return $path;
}


/**
 * @ return an array of dates between range 
 * 
 * 
 * @return none
 * @author Divik Prakash
 * */
function createDateRange($start, $end, $format = 'Y-m-d') {
    $start  = new DateTime($start);
    $end    = new DateTime($end);
    $invert = $start > $end;

    $dates = array();
    $dates[] = $start->format($format);
    while ($start != $end) {
        $start->modify(($invert ? '-' : '+') . '1 day');
        $dates[] = $start->format($format);
    }
    return $dates;
}

function get_initial($string = NULL) {
    if (!$string) {
        return 'P';
    }
    $word_array = explode(' ', $string);
    $initial = '';
    foreach ($word_array as $word) {
        $initial .= strtoupper(substr($word, 0, 1));
    }
    return $initial;
}

function custom_text($string, $length = 25) {
  if(strlen($string)<=$length) {
    echo $string;
  } else {
    $y = substr($string, 0, $length) . '...';
    echo $y;
  }
}