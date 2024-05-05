<?php

interface IKomutlar
{
    public function Calistir();
}

class Siparis // receiver , alicim
{
    private $siparisId;
    private $siparisMiktari;

    public function __construct($siparisId, $siparisMiktari)
    {
        $this->siparisId = $siparisId;
        $this->siparisMiktari = $siparisMiktari;
    }

    public function al()
    {
        echo "Sipariş alındı: Ürün ID: $this->siparisId, Adet: $this->siparisMiktari\n";
    }
}

class SiparisAl implements IKomutlar
{
    private $siparis;

    public function __construct(Siparis $siparis)
    {
        $this->siparis = $siparis;
    }

    public function Calistir()
    {
        $this->siparis->al();
    }
}

class Garson // Invoker ım ( davet eden olarak düşünebiliriz,  Kullanılacak işlemi davet ediyor)
{
    private $komut;

    public function komutuAyarla(IKomutlar $komut)
    {
        $this->komut = $komut;
    }

    public function al()
    {
        if ($this->komut !== null) {
            $this->komut->Calistir();
        } else {
            echo "Garson: Lütfen önce bir komut ayarlayın.\n";
        }
    }
}


// Kullanım
$siparis = new Siparis("ABC123", 2);
$siparisAlKomut = new SiparisAl($siparis);

$garson = new Garson();
$garson->komutuAyarla($siparisAlKomut);
$garson->al();

//Kısacası, Garson (Invoker) bir komut (SiparisAl - Command) üzerinden bir işlemi çağırır.
// Bu komut, gerçek işlemi gerçekleştirmek için Siparis sınıfını (Receiver) kullanır.
// Bu tasarım deseni, istemci (Invoker) ile alıcı (Receiver) arasındaki bağlantıyı gevşeterek daha esnek bir sistem sağlar.