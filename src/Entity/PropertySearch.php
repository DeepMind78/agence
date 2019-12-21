<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{
   private $maxPrice;
   
   private $minSurface;

   private $options;

   public function __construct()
   {
       $this->options = new ArrayCollection();
   }

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

   public function setOptions($options){
        $this->options = $options;
        return $this;
   }

   public function getOptions(){
        return $this->options;
   }

   
}
