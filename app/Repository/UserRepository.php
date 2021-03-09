<?php


namespace App\Repository;


use App\Gateway\UserGateway;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Hashing\Hasher;

class UserRepository
{
    /**
     * @var Encrypter
     */
    private $encrypter;

    /**
     * @var UserGateway
     */
    private $gateway;
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * UserRepository constructor.
     * @param Encrypter $encrypter
     * @param UserGateway $gateway
     * @param Hasher $hasher
     */
    public function __construct(Encrypter $encrypter, UserGateway $gateway, Hasher $hasher)
    {
        $this->encrypter = $encrypter;
        $this->gateway = $gateway;
        $this->hasher = $hasher;
    }

    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return bool
     */
    public function create(string $email, string $name, string $password): bool
    {
        return $this->gateway->create($email, $name, $this->hasher->make($password));
    }
}
