<?php

namespace App\Entity;

class PropertySearch
{
   private $maxPrice;
   
   private $minSurface;

   public function getMaxPrice(){
       return $this->maxPrice;
   }

   public function setMaxPrice($maxPrice){
       $this->maxPrice = $maxPrice;
       return $this;
   }

   public function getMinSurface(){
       return $this->minSurface;
   }
   
   public function setMinSurface($minSurface){
       $this->minSurface = $minSurface;
       return $this;
   }

   
}
