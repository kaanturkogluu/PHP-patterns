<?php

// AbstractClass: Template Method içerir
abstract class CoffeeTemplate
{
    // Template Method: Kahve hazırlama sürecini belirler
    final public function prepareCoffee()
    {
        $this->boilWater();
        $this->brewCoffeeGrounds();
        $this->pourInCup();
        $this->addCondiments();
    }

    // Soyut metotlar, alt sınıflar tarafından uygulanmalıdır
    abstract protected function boilWater();
    abstract protected function brewCoffeeGrounds();
    abstract protected function pourInCup();
    abstract protected function addCondiments();
}

// ConcreteClass: AbstractClass'ı uygular ve bazı adımları değiştirir
class CoffeeWithHook extends CoffeeTemplate
{
    protected function boilWater()
    {
        echo "Su kaynatılıyor\n";
    }

    protected function brewCoffeeGrounds()
    {
        echo "Kahve demleniyor\n";
    }

    protected function pourInCup()
    {
        echo "Fincana dökülüyor\n";
    }

    protected function addCondiments()
    {
        echo "Şeker ve süt ekleniyor\n";
    }
}

class CoffeeWithoutHook extends CoffeeTemplate
{
    protected function boilWater()
    {
        echo "Su kaynatılıyor\n";
    }

    protected function brewCoffeeGrounds()
    {
        echo "Kahve demleniyor\n";
    }

    protected function pourInCup()
    {
        echo "Fincana dökülüyor\n";
    }

    protected function addCondiments()
    {
        // Burada hiçbir şey eklemiyoruz
    }
}

// Kullanım
echo "Kahve hazırlama süreci (hook kullanarak):\n";
$coffeeWithHook = new CoffeeWithHook();
$coffeeWithHook->prepareCoffee();

echo "\nKahve hazırlama süreci (hook kullanmadan):\n";
$coffeeWithoutHook = new CoffeeWithoutHook();
$coffeeWithoutHook->prepareCoffee();

?>
