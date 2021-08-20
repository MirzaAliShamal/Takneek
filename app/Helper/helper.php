<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Setting;
use App\Models\User;
use App\Models\Book;


function uploadFile($file, $path){
    $name = time().'-'.str_replace(' ', '-', $file->getClientOriginalName());
    $file->move($path,$name);
    return $path.'/'.$name;
}

function bookUUID() {
    $no = "TK".substr(str_shuffle("A0B1C2D3E4F5G6HI7J8K9L"), 0, 10);

    if (bookUUIDExists($no)) {
        return bookUUID();
    } else {
        return $no;
    }
}

function bookUUIDExists($number) {
    return Book::where('uuid', $number)->exists();
}

function roles() {
    return Role::all();
}

function setting() {
    return Setting::pluck('value', 'key')->toArray();
}


function commaSeparatedString($string) {
    return explode(',', $string);
}

function checkPerm($manage, $assign_id, $permission_id) {
    $permission = Permission::find($permission_id);
    if ($manage == "role") {
        $role = Role::find($assign_id);

        $check = DB::table('role_has_permissions')->where('role_id', $assign_id)->where('permission_id', $permission_id)->first();
    } else {
        $user = User::find($assign_id);

        $check = DB::table('model_has_permissions')->where('model_id', $assign_id)->where('permission_id', $permission_id)->first();
    }

    if ($check) {
        return "checked";
    } else {
        return "";
    }
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
