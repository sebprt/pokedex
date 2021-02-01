<?php

abstract class AbstractModel
{

    protected static $bdd;
    protected string $tableName;

    /**
     * Create query object
     *
     * @param       $sql
     * @param       $classNameObject
     * @param array $params
     *
     * @return bool|PDOStatement
     */
    protected static function createQuery($sql, $classNameObject, $params = [])
    {
        $query = self::DB()->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, $classNameObject);
        $query->execute($params);

        return $query;
    }

    /**
     * Get PDO connection
     *
     * @return PDO
     */
    protected static function DB()
    {
        if (self::$bdd === null) {
            // Création de la connexion
            self::$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]);
        }

        return self::$bdd;
    }

    public function findAll(string $columns = '*', string $inner = null, string $condition = null,
                            string $groupBy = null, string $order = null, int $limit = null, int $offset = null)
    {
        $sql = 'SELECT ' . $columns . ' FROM ' . $this->tableName;

        if (!empty($inner)) {
            $sql .= " $inner";
        }

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }

        if (!empty($groupBy)) {
            $sql .= " GROUP BY $groupBy";
        }

        if (!empty($order)) {
            $sql .= " ORDER BY $order";
        }

        if (isset($limit) && isset($offset)) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        $sql .= ";";

        $query = self::createQuery($sql, get_class($this));

        return $query->fetchAll();
    }

    public function findOneById($id, string $columns = '*', string $inner = null)
    {
        $sql = 'SELECT ' . $columns . ' FROM ' . $this->tableName;

        if (!empty($inner)) {
            $sql .= " $inner";
        }
        $sql .= " WHERE " . $this->tableName . ".id=" . $id;

        $query = $this->createQuery($sql, get_class($this), [
            'id' => $id
        ]);

        return $query->fetch();
    }

    public function save($data)
    {
        if (empty($data["id"])) {
            $sql = 'INSERT INTO ' . $this->tableName . ' (';
            foreach ($data as $key => $value) {
                $sql .= $key . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ') VALUES (';
            foreach ($data as $key => $value) {
                $sql .= '"' . $value . '",';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ');';
        } else {
            $sql = 'UPDATE ' . $this->tableName . " SET ";
            foreach ($data as $key => $value) {
                $sql .= $key . "= '" . $value . "',";
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE id= " . $data["id"] . ";";
        }

        self::createQuery($sql, get_class($this));
    }
}
