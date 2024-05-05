<?php


// Mediator arayüzü
interface ChatMediator
{
    public function sendMessage(string $message, User $user);
}

// ConcreteMediator sınıfı
class ChatRoom implements ChatMediator
{
    private $users = [];

    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    public function sendMessage(string $message, User $user)
    {
        foreach ($this->users as $participant) {
            if ($participant !== $user) {
                $participant->receiveMessage($message);
            }
        }
    }
}

// Colleague arayüzü
interface User
{
    public function sendMessage(string $message);

    public function receiveMessage(string $message);
}

// ConcreteColleague sınıfı
class ChatUser implements User
{
    private $mediator;
    private $name;

    public function __construct(ChatMediator $mediator, string $name)
    {
        $this->mediator = $mediator;
        $this->name = $name;
    }

    public function sendMessage(string $message)
    {
        echo "{$this->name} sends message: $message\n";
        $this->mediator->sendMessage($message, $this);
    }

    public function receiveMessage(string $message)
    {
        echo "{$this->name} receives message: $message\n";
    }
}

// Kullanım
$chatRoom = new ChatRoom();

$user1 = new ChatUser($chatRoom, 'Alice');
$user2 = new ChatUser($chatRoom, 'Bob');
$user3 = new ChatUser($chatRoom, 'Charlie');

$chatRoom->addUser($user1);
$chatRoom->addUser($user2);
$chatRoom->addUser($user3);

$user1->sendMessage('Hello, everyone!');
$user2->sendMessage('Hi, Alice!');
$user3->sendMessage('Hey, Bob!');


