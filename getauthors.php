<?php 
    header('Content-Type: application/json; charset=utf-8');

    $src = new SplFileObject('./out/src.csv', 'r') or die('somthing go wrong');

    $src -> setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD 
                        | SplFileObject::SKIP_EMPTY
                        | SplFileObject::DROP_NEW_LINE);
    
    $authorsarr = [];

    // while($src -> valid())  {
    //     $tmp = $src-> current();
    //     $authorsarr[] = utf8_encode($tmp);
    //     // echo $tmp . '<br>';
    //     $src -> next();
    // }    

    foreach ($src as $key => $value) {
        $tmp = substr($value[0], 0, strlen($value[0]) - 3);
        if(!empty($tmp))
        $authorsarr[] = utf8_encode($tmp);
    }

    // var_dump($authorsarr);
    // sort($authorsarr, SORT_NATURAL | SORT_FLAG_CASE);

    // function utf8ize($d) {
    //     if (is_array($d)) {
    //         foreach ($d as $k => $v) {
    //             $d[$k] = utf8ize($v);
    //         }
    //     } else if (is_string ($d)) {
    //         return utf8_encode($d);
    //     }
    //     return $d;
    // }

    // $utf8arr =  utf8ize($authorsarr);

    // $authCSV = new SplFileObject('./data/authors.csv', 'w');

    // $tmpArr = [];
    
    // foreach ($utf8arr as $key => $value) {
    //     $authCSV -> fputcsv($tmpArr, $value);
    // }
    echo json_encode($authorsarr, JSON_PRETTY_PRINT);
?>