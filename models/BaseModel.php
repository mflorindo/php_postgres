<?php

namespace models;

require_once __DIR__ . '/../Connection.php';
use \Connection;

/**
 * BaseModel
 */
class BaseModel
{
    
    /**
     * table
     *
     * @var String
     */
    public $table = null;    
    /**
     * Represents a connection. It will be populated by the Connection class.
     *
     * @var mixed
     */
    private $conn;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Connection();
    }
    
    /**
     * Insert a array in the table (database)
     *
     * @param  mixed $array
     * @return void
     */
    public function insert($array)
    {

        $sql = "insert into $this->table ";
        $fields = '';
        $values = '';
        foreach ($array as $key => $value) {
            if ($key != 'id') {
                $fields .= $key . ',';
                $values .= "'$value'" . ',';
            }
        }
        $fields = rtrim($fields, ',');
        $values = rtrim($values, ',');
        $sql .= "(" . $fields . ") values(" . $values . ")";
        $this->conn->exec($sql);
        

    }
    
    /**
     * Generate a query
     *
     * @param  mixed $sql
     * @return object
     */
    public function query($sql)
    {
        return $this->conn->query($sql);
    }
    
    /**
     * Updates a array in the table (database)
     *
     * @param  mixed $array
     * @param  mixed $id
     * @return void
     */
    public function update($array, $id)
    {

        $sql = "update $this->table  set ";
        $fields = '';
        $values = '';
        foreach ($array as $key => $value) {
            if ($key != 'id') {
                $fields .= $key . '=' . "'$value',";
            }
        }
        $fields = rtrim($fields, ',');
        $sql .= $fields . " where id=" . $id;

        //echo $sql;exit;
        $this->conn->exec($sql);

    }
    
    /**
     * Delete a item of the table
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $sql = "delete from $this->table where id = $id";
        
        $this->conn->exec($sql);

    }
    
    /**
     * Get the last id inserted in table
     *
     * @param  mixed $name
     * @return void
     */
    public function getLastInsertId($name){
        return $this->conn->lastInsertId($name);
    }

}
