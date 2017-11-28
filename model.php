<?php

class order {
    public $order;
    public $description;
    public $orderDate;
    public $delDate;
    public $customer;

}

abstract class moa_item {
    public $item;
    public $description;
    public $stock;
    public $minStock;
    public $maxStock;

}

interface vooraadAanvulling {
    function aanvvulling();
    function isHetnoodzakelijkDeVoorraadAanTeVullen();
}

class item extends moa_item implements vooraadAanvulling {
    public $warehouse;

//    function __construct(
//                $p_item        ,       
//                $p_description ,         
//                $p_stock       ,       
//                $p_minstock    ,        
//                $p_maxstock    ,
//                $p_warehouse   ) {
//
//     
//
//       $this->item        = $p_item          ;
//       $this->description = $p_description   ; 
//       $this->stock       = $p_stock         ;
//       $this->minstock    = $p_minstock      ; 
//       $this->maxstock    = $p_maxstock      ;
//       $this->warehouse   = $p_warehouse     ;
//
//       
//       }


    public function aanvvulling() {
        // als er besteld gaat worden dat zou de voorraad 
        // voor dit artikel kunnen worden aangevuld tot

        $voorraadAnnvullenmet = $this->maxStock - $this->stock;
        return $voorraadAnnvullenmet;
    }

    public function isHetnoodzakelijkDeVoorraadAanTeVullen() {
        $ertuit = FALSE;
        if ($this->stock < $this->minStock) {
            $ertuit = TRUE;
        }
        return $ertuit;
    }

}
