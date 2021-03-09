<?php


namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    const NAME = 'name';
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
            self::NAME => 'required|max:255',
            self::EMAIL => 'required|email|unique:users|max:255',
            self::PASSWORD => 'required|min:3|confirmed|max:255',
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->get(self::NAME);
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
}
