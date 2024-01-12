<?php
class ShoppingCart
{
    private $cartid;
    private $customerid;
    private $productid;
    private $quantity;
    private $isordered;

    public function __construct($cartid, $customerid, $productid, $quantity, $isordered)
    {
        $this->cartid = $cartid;
        $this->customerid = $customerid;
        $this->productid = $productid;
        $this->quantity = $quantity;
        $this->isordered = $isordered;
    }

    public function getCartid()
    {
        return $this->cartid;
    }

    public function setCartid($cartid)
    {
        $this->cartid = $cartid;
    }

    public function getCustomerid()
    {
        return $this->customerid;
    }

    public function setCustomerid($customerid)
    {
        $this->customerid = $customerid;
    }

    public function getProductid()
    {
        return $this->productid;
    }

    public function setProductid($productid)
    {
        $this->productid = $productid;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getIsordered()
    {
        return $this->isordered;
    }

    public function setIsordered($isordered)
    {
        $this->isordered = $isordered;
    }


}