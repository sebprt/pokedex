<?php
require_once 'core/AbstractModel.php';

class PokemonRepository extends AbstractModel
{
    public function findAll(string $columns = '', string $inner = null,
                            string $condition = null, string $groupBy = null,
                            string $order = null, int $limit = null,
                            int $offset = null)
    {

        return parent::findAll("pokemon.* , group_concat(DISTINCT T.label ORDER BY T.label DESC SEPARATOR ',') as types", 'INNER JOIN pokemon_has_type as PHT ON PHT.pokemon_id = pokemon.id 
        INNER JOIN type as T ON PHT.type_id = T.id', null, 'pokemon.id, pokemon.name');
    }

    public function findOneById($id, string $columns = '*', string $inner = null, string $groupBy = null)
    {
        return parent::findOneById($id, "pokemon.* , group_concat(DISTINCT T.label ORDER BY T.label DESC SEPARATOR ',') as types",
            "INNER JOIN pokemon_has_type as PHT ON PHT.pokemon_id = pokemon.id 
        INNER JOIN type as T ON PHT.type_id = T.id");
    }

    public function save($data)
    {
        if (empty($data["id"])) {
            parent::save(array_slice($data, 0, 1));

            if (!empty($data["types"])) {
                foreach ($data["types"] as $type) {

                    $sql = ' INSERT INTO pokemon_has_type (pokemon_id, type_id)';
                    $sql .= ' SELECT id,' . $type . ' FROM pokemon where name="' . $data["name"] . '";';
                    self::createQuery($sql, get_class($this));
                }
            }
        } else {
            $result = $this->getAllTypesId($data);

            if (!empty($data["types"])) {
                parent::save(array_slice($data, 0, 2));

                foreach ($result as $value){
                    $sql = ' DELETE FROM pokemon_has_type WHERE type_id='.$value["type_id"].' AND pokemon_id='.$data["id"].';';
                    self::createQuery($sql, get_class($this));
                }

                foreach ($data["types"] as $type)  {
                    $sql = ' INSERT INTO pokemon_has_type VALUES ('.$data["id"].', '.$type.');';
                    self::createQuery($sql, get_class($this));
                }

                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("Location: http://$host$uri/form/".$data["id"]);

            } else {
                parent::save($data);
            }
        }
    }

    public function getAllTypesId($data){
        $sql = "SELECT DISTINCT PHT.type_id
                FROM pokemon as P
                INNER JOIN pokemon_has_type as PHT 
                ON PHT.pokemon_id = P.id
                WHERE PHT.pokemon_id = ".$data["id"];
        $query = self::DB()->query($sql, PDO::FETCH_ASSOC);

        return $query->fetchAll();
    }
}
