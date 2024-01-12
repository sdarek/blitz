<?php
class Category
{
    private $id;
    private $name;
    private $description;

    public function __construct($id, $name, $description)
    {
        $this->name = $name;
        $this->id = $id;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getId(): int
    {
        return $this->id;
    }


}