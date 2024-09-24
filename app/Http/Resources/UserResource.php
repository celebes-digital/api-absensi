<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_user'       => $this->id_user,
            'email'         => $this->email,
            'avatar'        => $this->avatar,
            'is_admin'      => $this->is_admin,
            'last_active'   => $this->last_active,
            'created_at'    => $this->created_at,
            'pegawai'       => new PegawaiResource($this->whenLoaded('pegawai')),
        ];
    }
}
