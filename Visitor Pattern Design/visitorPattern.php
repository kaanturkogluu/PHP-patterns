<?php
interface Animal {
    public function accept(AnimalVisitor $visitor);
}

class Lion implements Animal {
    public function accept(AnimalVisitor $visitor) {
        $visitor->visitLion($this);
    }
}

class Elephant implements Animal {
    public function accept(AnimalVisitor $visitor) {
        $visitor->visitElephant($this);
    }
}

class Giraffe implements Animal {
    public function accept(AnimalVisitor $visitor) {
        $visitor->visitGiraffe($this);
    }
}
interface AnimalVisitor {
    public function visitLion(Lion $lion);
    public function visitElephant(Elephant $elephant);
    public function visitGiraffe(Giraffe $giraffe);
}
class AnimalInfoVisitor implements AnimalVisitor {
    public function visitLion(Lion $lion) {
        echo "Lion: Majestic creature with a loud roar.\n";
    }

    public function visitElephant(Elephant $elephant) {
        echo "Elephant: Giant animal with a long trunk.\n";
    }

    public function visitGiraffe(Giraffe $giraffe) {
        echo "Giraffe: Tall herbivore with a long neck.\n";
    }
}
$lion = new Lion();
$elephant = new Elephant();
$giraffe = new Giraffe();

$visitor = new AnimalInfoVisitor();

$lion->accept($visitor);
$elephant->accept($visitor);
$giraffe->accept($visitor);
