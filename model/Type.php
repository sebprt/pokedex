<?php
require_once('Repository/TypeRepository.php');

class Type extends TypeRepository
{
    protected string $tableName = 'type';

    private int $id;

    private string $label;

    private array $pokemons;

    public function __construct()
    {
        $this->pokemons = [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getPokemons(): array
    {
        return $this->pokemons;
    }

    public function __toString()
    {
        return $this->label;
    }
}
