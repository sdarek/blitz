<?php
class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $category;
    private $supplier;
    private $image;

    public function __construct(string $name, float $price, string $description, string $category, string $supplier, $image = '', $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->category = $category;
        $this->supplier = $supplier;
        $this->image = $image ?? '';
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function getSupplier(): int
    {
        return $this->supplier;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    // Settery
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function setSupplier(string $supplier)
    {
        $this->supplier = $supplier;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }


}