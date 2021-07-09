<?php

$env_file_path = __DIR__ .'/../../env.php';

if(file_exists($env_file_path)) {
    $variables = include $env_file_path;

    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }
}



if(!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        return $value;
    }
}

if(!function_exists('dd')) {
    function dd()
    {
        $args  =  func_get_args();

        foreach($args as $arg) {
            echo'<pre>';
            print_R($arg);
            echo '</pre>';
        }

        die();

    }
}

?>