<?php
require_once('core/AbstractModel.php');

class Type extends AbstractModel
{
    protected string $tableName = 'type';

    private int $id;

    private string $label;

    private string $pokemons;

    public function __construct()
    {
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
    public function getPokemons(): string
    {
        return $this->pokemons;
    }

    /**
     * @param string $pokemon
     */
    public function setPokemons(string $pokemon): void
    {
        $this->pokemons = $pokemon;
    }

    public function __toString()
    {
        return $this->label;
    }
}
