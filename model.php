<?php

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
    public function aanvvulling() {
        // als er besteld gaat worden dan zou de voorraad 
        // voor dit artikel moeten worden aangevuld tot deze returnn waarde
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

class order {

    public $order;
    public $description;
    public $orderDate;
    public $delDate;
    public $customer;

}
