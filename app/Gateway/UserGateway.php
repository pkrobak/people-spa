<?php


namespace App\Gateway;


use App\Models\User;

class UserGateway
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserGateway constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return bool
     */
    public function create(string $email, string $name, string $password): bool
    {
        return $this->user->newQuery()->insert([
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'email_verified_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);
    }
}
