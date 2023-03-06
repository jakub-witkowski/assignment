<?php
abstract class Product
{
    protected $name;
    protected $sku;
    protected $price;
   
    abstract public function print_attributes();

    public function getName(): string
    {
        return $this->name;
    }

    public function get_sku(): string
    {
        return $this->sku;
    }

    public function getPrice(): float
    {
         return $this->price;
    }
}

class Disc extends Product
{
    protected $size;

    public function getSize(): int
    {
        return $this->size;
    }
    
    public function print_attributes()
    {
        #printf("%s".PHP_EOL, $this->get_sku());
        #printf("%s".PHP_EOL, $this->getName());
        #printf("%.2f$".PHP_EOL, $this->getPrice());
        printf("Size: %d MB".PHP_EOL, $this->size); 
    }
}

class Book extends Product
{
    protected $weight;

    public function getWeight(): int
    {
        return $this->weight;
    }
    
    public function print_attributes()
    {
        #printf("%s".PHP_EOL, $this->get_sku());
        #printf("%s".PHP_EOL, $this->getName());
        #printf("%.2f$".PHP_EOL, $this->getPrice());
        printf("Weight: %d kg".PHP_EOL, $this->weight);
    }
}

class Chair extends Product
{
    protected $height;
    protected $width;
    protected $length;

    public function getHeight() : int
    {
        return $this->height;
    }

    public function getWidth() : int
    {
        return $this->width;
    }

    public function getLength() : int
    {
        return $this->length;
    }
    
    public function print_attributes()
    {
        #printf("%s".PHP_EOL, $this->get_sku());
        #printf("%s".PHP_EOL, $this->getName());
        #printf("%.2f$".PHP_EOL, $this->getPrice());
        printf("Dimensions: %d x %d x %d cm".PHP_EOL, $this->height, $this->width, $this->length);
    }
}

function attributes($products)
{
    foreach ($products as $product) {
        echo $product->print_attributes() . PHP_EOL;
    }
}