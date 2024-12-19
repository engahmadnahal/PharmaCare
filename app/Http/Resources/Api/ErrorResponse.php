<?php

namespace App\Http\Resources\Api;

use App\Helpers\Messages;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponse extends JsonResource
{

    public $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return [
            'status' => false,
            'message' => Messages::getMessage($this->msg),
        ];
    }
}
