<?php


namespace App\Entities;


class CharacterEntity
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $culture;

    /**
     * @var string
     */
    private $born;

    /**
     * @var string
     */
    private $died;

    /**
     * @var array
     */
    private $titles;

    /**
     * CharacterEntity constructor.
     * @param string $url
     * @param string $name
     * @param string $gender
     * @param string $culture
     * @param string $born
     * @param string $died
     * @param array $titles
     */
    public function __construct(string $url, string $name, string $gender, string $culture, string $born, string $died, array $titles)
    {
        $this->url = $url;
        $this->name = $name;
        $this->gender = $gender;
        $this->culture = $culture;
        $this->born = $born;
        $this->died = $died;
        $this->titles = $titles;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getCulture(): string
    {
        return $this->culture;
    }

    /**
     * @return string
     */
    public function getBorn(): string
    {
        return $this->born;
    }

    /**
     * @return string
     */
    public function getDied(): string
    {
        return $this->died;
    }

    /**
     * @return array
     */
    public function getTitles(): array
    {
        return $this->titles;
    }

}
