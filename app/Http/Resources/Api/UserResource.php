<?php

namespace App\Http\Resources\Api;

use App\Models\DeleteAccountUser;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return [
            // 'code_active_debug' => $this->code_active_debug,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'isSelectedAddress' => $this->is_selected_address,
            'isNotify' => boolval($this->isNotify),
            'date' => $this->created_at->diffForHumans(),
            'mobile' => $this->mobile,
            'avater' => $this->avater != null ? Storage::url($this->avater) : asset('media/users/300_21.jpg'),
            'token' => $this->token,
            // 'token_type' => $this->token_type
            
        ];
    }
}
