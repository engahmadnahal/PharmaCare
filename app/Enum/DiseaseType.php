<?php

namespace App\Enum;

class DiseaseType
{
    const GENETIC_DISEASE = 'genetic_disease';
    const ALLERGY = 'allergy';
    const GENERAL_DISEASE = 'general_disease';
    const CHRONIC_DISEASE = 'chronic_disease';

    public static function getTypes()
    {
        return [
            self::GENETIC_DISEASE,
            self::ALLERGY,
            self::GENERAL_DISEASE,
            self::CHRONIC_DISEASE,
        ];
    }
}
