<?php

// Aggregate arayüzü
interface IteratorAggregate
{
    public function getIterator(): Iterator;
}

// ConcreteAggregate sınıfı
class ProductCategory implements IteratorAggregate
{
    private $name;
    private $products = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addProduct($productName)
    {
        $this->products[] = $productName;
    }

    public function getIterator(): Iterator
    {
        return new CategoryIterator($this);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getProducts()
    {
        return $this->products;
    }
}

// Iterator arayüzü
interface Iterator
{
    public function first();
    public function next();
    public function isDone();
    public function currentItem();
}

// ConcreteIterator sınıfı
class CategoryIterator implements Iterator
{
    private $category;
    private $index = 0;

    public function __construct(ProductCategory $category)
    {
        $this->category = $category;
    }

    public function first()
    {
        $this->index = 0;
    }

    public function next()
    {
        $this->index++;
    }

    public function isDone()
    {
        return $this->index >= count($this->category->getProducts());
    }

    public function currentItem()
    {
        return $this->category->getProducts()[$this->index];
    }
}

// Client sınıfı
class ECommerceApp
{
    public static function showCategoriesAndProducts(IteratorAggregate $categories)
    {
        $iterator = $categories->getIterator();

        while (!$iterator->isDone()) {
            $category = $iterator->currentItem();
            echo "Kategori: " . $category->getName() . "\n";

            $productIterator = $category->getIterator();
            while (!$productIterator->isDone()) {
                echo "  - " . $productIterator->currentItem() . "\n";
                $productIterator->next();
            }

            $iterator->next();
        }
    }
}

// Kullanım
$category1 = new ProductCategory("Elektronik");
$category1->addProduct("Telefon");
$category1->addProduct("Bilgisayar");

$category2 = new ProductCategory("Giyim");
$category2->addProduct("Tişört");
$category2->addProduct("Pantolon");

$categories = new CategoryCollection();
$categories->addCategory($category1);
$categories->addCategory($category2);

ECommerceApp::showCategoriesAndProducts($categories);

?>
