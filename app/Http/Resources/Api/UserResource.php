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
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'gender' => $this->gender,
            'avater' => $this->avater != null ? Storage::url($this->avater) : asset('media/users/300_21.jpg'),
            'date_of_birth' => $this->date_of_birth,
            'status' => $this->status,
            'is_parent' => $this->parent_id != null,
            'created_at' => $this->created_at->diffForHumans(),
            'token' => $this->token,
        ];
    }
}
