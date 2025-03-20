<?php

namespace App\Enum;

class ConcentrationUnit
{
    const MG = 'mg';
    const ML = 'ml';
    const G = 'g';
    const MCG = 'mcg';
    const IU = 'iu';
    const MCG_G = 'mcg/g';
    const MG_G = 'mg/g';
    const G_G = 'g/g';
    const MCG_ML = 'mcg/ml';
    const MG_ML = 'mg/ml';
    const G_ML = 'g/ml';
    
    

    public static function getUnits()
    {
        return [
            self::MG,
            self::ML,
            self::G,
            self::MCG,
            self::IU,
            self::MCG_G,
            self::MG_G,
            self::G_G,
            self::MCG_ML,
            self::MG_ML,
            self::G_ML,
        ];
    }

    public static function getUnitsForValidation()
    {
        return implode(',', self::getUnits());
    }
}