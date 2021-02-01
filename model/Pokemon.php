<?php
require_once('core/AbstractModel.php');
require_once('Repository/PokemonRepository.php');

class Pokemon extends PokemonRepository
{
    protected string $tableName = 'pokemon';

    private int $id;

    private string $name;

    private string $types;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }

    public function __toString()
    {
        return $this->name;
    }
}
