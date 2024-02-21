<?php

namespace App\Http\Traits;
trait BreadcrumbTrait
{
    public function getBreadCrumb($type,$message) {
        return [
            "type" =>$type,
            "message" => $message
        ];
    }
}
?>
