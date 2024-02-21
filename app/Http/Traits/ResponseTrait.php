<?php

namespace App\Http\Traits;
trait ResponseTrait
{
    public function response($type,$message) {
        return [
            "type" =>$type,
            "message" => $message
        ];
    }
}


?>
