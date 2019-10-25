<?php

namespace App\Redpencilit;

class CollegeDegree
{
    
    const ASSOCIATES_DEGREE = 1;
    
    const BACHELORS_DEGREE = 2;
    
    const MASTERS_DEGREE = 3;
    
    const DOCTORAL_DEGREE = 4;
    
    const PROFESSIONAL_DEGREE = 5;
    
    public static function all()
    {
        return [
            static::ASSOCIATES_DEGREE,
            static::BACHELORS_DEGREE,
            static::MASTERS_DEGREE,
            static::DOCTORAL_DEGREE,
            static::PROFESSIONAL_DEGREE
        ];
    }
}