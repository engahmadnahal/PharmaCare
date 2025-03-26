<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email ?? 'none',
            'mobile' => $this->mobile ?? 'none',
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'created_at' => $this->created_at->format('Y-m-d'),

            // Medical Info
            'medical_info' => [
                'width' => $this->info?->width,
                'length' => $this->info?->length,
                'blood_type' => $this->info?->blood_type,
                'is_allergies' => (bool) $this->info?->is_allergies,
                'is_genetic_diseases' => (bool) $this->info?->is_genetic_diseases,
                'genetic_diseases' => $this->info?->genetic_diseases,
                'allergies' => $this->info?->allergies,
            ],

            // Drugs
            'drugs' => $this->drugs->map(function ($drug) {
                return [
                    'id' => $drug->id,
                    'name' => $drug->name,
                    'dosage' => $drug->dosage,
                    'diseases' => $drug->diseases,
                    'type' => $drug->type,
                    'duration' => $drug->duration,
                ];
            }),

            // Medical Records
            'medical_records' => $this->medicalRecords->map(function ($record) {
                return [
                    'id' => $record->id,
                    'name' => $record->name,
                    'description' => $record->description,
                    'type' => $record->type,
                    'file' => $record->file ? Storage::url($record->file) : null,
                ];
            }),
        ];
    }
}
