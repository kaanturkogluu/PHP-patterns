<?php
//ön bilgi : function keywordu ile fonksiyon tanımlanır
//ön bilgi : fonksiyon tanımlandıktan sonraki gelen ":int" - ":void" - ":str" keywordleri geri dönüş tipini temsil eder
//ön bilgi: "$" keyword değişken tanımlamak için kullanılır
//çn bilgi : "echo" keyword ekrana çıktıları basmak için kullanılır.
// ön bilgi : "$this" keyword sinif içerisindeki değişkeni temsil eder diyebiliriz.

// interface oluşturarak işe başlayalım
interface Strategy
{
    // Interface içerisine, implemente edilecek olan her bir sınıfın sahip olması gereken metotlarımızı tanımlıyoruz.
    public function doOperation(int $num1, int $num2): int;
}

// Kullanılacak ilk algoritma sınıfı
class OperationAdd implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 + $num2;
    }
}

// Kullanılacak ikinci algoritma sınıfı
class OperationSubtract implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 - $num2;
    }
}

// Kullanılacak üçüncü algoritma sınıfı
class OperationMultiply implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 * $num2;
    }
}

// Çalışacak olan algoritmayı belirleyecek olan sınıf
class Context
{
    private $strategy;

    public function setStrategy(Strategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $num1, int $num2): int
    {
        return $this->strategy->doOperation($num1, $num2);
    }
}
// -----------------------------------------Kullanım-------------------------------------//
 // 1 - Yeni nesneni üret
// 2- kullanılacak algoritmayı belirt
// 3 - işlemini tamamla

$context = new Context();
// Toplama işlemi
$context->setStrategy(new OperationAdd());
$result = $context->executeStrategy(5, 3);
echo "Toplama Sonucu: " . $result . "<br>";

// Çıkarma işlemi
$context->setStrategy(new OperationSubtract());
$result = $context->executeStrategy(10, 4);
echo "Çıkarma Sonucu: " . $result . "<br>";

// Çarpma işlemi
$context->setStrategy(new OperationMultiply());
$result = $context->executeStrategy(8, 2);
echo "Çarpma Sonucu: " . $result . "<br>";
?>
