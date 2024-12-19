<?php

namespace App\Http\Resources\Api;

use App\Helpers\Messages;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResponse extends JsonResource
{

    public $msg,$data,$hasData;
    public function __construct($msg,$data = null,$hasData = true)
    {
        $this->msg = $msg;
        $this->data = $data;
        $this->hasData = $hasData;
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
            'status' => true,
            'message' => Messages::getMessage($this->msg),
            'data' => $this->when($this->hasData,$this->data)
        ];
    }
}
