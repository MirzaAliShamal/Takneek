<?php

use Carbon\Carbon;
use App\Models\Setting;




    function uploadFile($file, $path){
        $name = time().'-'.str_replace(' ', '-', $file->getClientOriginalName());
        $file->move($path,$name);
        return $path.'/'.$name;
    }


    function setting()
    {
        return Setting::pluck('value', 'key')->toArray();
    }


    function commaSeparatedString($string)
    {
        return explode(',', $string);
    }



?>
