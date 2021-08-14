<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Models\Setting;




function uploadFile($file, $path){
    $name = time().'-'.str_replace(' ', '-', $file->getClientOriginalName());
    $file->move($path,$name);
    return $path.'/'.$name;
}

function roles()
{
    return Role::all();
}

function setting()
{
    return Setting::pluck('value', 'key')->toArray();
}


function commaSeparatedString($string)
{
    return explode(',', $string);
}



function sendMail($data)
{
    if (array_key_exists("pdf",$data)) {
        $mail = Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
            $message->to($data['to'], $data['name'])->subject($data['subject'])->attachData($data['pdf']->output(), "invoice.pdf");
        });
    }else {
        $mail = Mail::send($data['view'], ['data' => $data['data']], function ($message) use ($data) {
            $message->to($data['to'], $data['name'])->subject($data['subject']);
        });
    }
}

?>
