<?php

namespace App;

class Cart 
{
   
 public $items=null;
 public $totalQty=0;
 public $totalPrice=0;
 public $Price=0;
 public $new_qty=0;
 public function __construct($oldCart)
 {
     if($oldCart){
         $this->items=$oldCart->items;
         $this->totalQty=$oldCart->totalQty;
         $this->totalPrice=$oldCart->totalPrice;
     }
 }
 public function add($item,$id){
        $storedItem=['qty'=>0,'price'=>$item->price,'item'=>$item];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem= $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price']= $item->price * $storedItem['qty'] ; 
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
        $this->Price = $item->price;

   }



   public function reduceByOne($id){
         $this->items[$id]['qty']--;
         $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
         $this->totalQty--;
         $this->totalPrice -= $this->items[$id]['item']['price'];

         if($this->items[$id]['qty'] <=0){
             unset($this->items[$id]);
         }
   }

   
   public function addByOne($id){
    $this->items[$id]['qty']++;
    $this->items[$id]['price'] += $this->items[$id]['item']['price'];
    $this->totalQty++;
    $this->totalPrice += $this->items[$id]['item']['price'];

    if($this->items[$id]['qty'] <=0){
        unset($this->items[$id]);
    }
}

   public function removeItem($id){
    $this->totalQty -=$this->items[$id]['qty'];
    $this->totalPrice -= $this->items[$id]['price'];
    unset($this->items[$id]);
   }


   public function removeallItem(){
    
    unset($this->items);
   }




   public function adddetails($item,$id,$quantity){
    $storedItem=['qty'=>$quantity,'price'=>$item->price,'item'=>$item];
    if($this->items){
        if(array_key_exists($id,$this->items)){
            $storedItem= $this->items[$id];
        }
    }
   
    if(isset($this->items[$id]['qty'])){
        $storedItem['qty']=$quantity + $this->items[$id]['qty'];
    
        $storedItem['price']= $item->price * $storedItem['qty'] ; 
        $this->items[$id] = $storedItem;
        $this->totalQty=$storedItem['qty'] ;
        $this->totalPrice += $item->price;
        $this->Price = $item->price;
    }else{
        $storedItem['qty']=$quantity ;
    
        $storedItem['price']= $item->price * $storedItem['qty'] ; 
        $this->items[$id] = $storedItem;
        $this->totalQty=$storedItem['qty'] ;
        $this->totalPrice += $item->price;
        $this->Price = $item->price;
    }


}
  



}
