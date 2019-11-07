<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getValidationMessages($validator)
    {
        $msgs = $validator->errors()->getMessages();
        $msg = [];
        foreach ($msgs as $m) {
        foreach ($m as $val){
            array_push($msg, $val);
            }
        }
        
        return $msg;
    }

    public function getMeta($msg)
    {
        $message = [];
        
        if(is_array($msg)){
        $message = $msg;
        }else{
        array_push($message, $msg);
        }

        return [
        'message' => $message
        ];
    }
}
