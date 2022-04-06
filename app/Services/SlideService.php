<?php
namespace App\Services;
use App\Models\Noticias;

class SlideService 
{

    public function GetServiceSlide()
    {
        return $noticias=Noticias::latest()
        ->take(5)
        ->get();
    }
}