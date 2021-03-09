<?php


namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    const EMAIL = 'email';
    const PASSWORD = 'password';

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            self::EMAIL => 'required|email|exists:users,email|max:255',
            self::PASSWORD => 'required|min:3|max:255',
        ];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->get(self::EMAIL);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get(self::PASSWORD);
    }

    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }
}
