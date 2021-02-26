<?php

/**
 * Connection
 */
class Connection
{
    /**
     * The singleton instance
     *
     */
    private static $PDOInstance;

    public function __construct()
    {
        if (!self::$PDOInstance) {
            $params = parse_ini_file('database.ini');
            $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
                $params['host'],
                $params['port'],
                $params['database'],
                $params['user'],
                $params['password']);
            try {
                self::$PDOInstance = new PDO($conStr);
            } catch (PDOException $e) {
                die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
            }
        }
        return self::$PDOInstance;
    }

    

  
    /**
     * Execute an SQL statement and return the number of affected rows
     *
     * @param string $statement
     */
    public function exec($statement)
    {   
        return self::$PDOInstance->exec($statement);
    }

    /**
     * Retrieve a database connection attribute
     *
     * @param int $attribute
     * @return mixed
     */
    public function getAttribute($attribute)
    {
        return self::$PDOInstance->getAttribute($attribute);
    }

   
    /**
     * Returns the ID of the last inserted row or sequence value
     *
     * @param string $name Name of the sequence object from which the ID should be returned.
     * @return string
     */
    public function lastInsertId($name)
    {   
        
        return self::$PDOInstance->lastInsertId($name);
    }

 

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object
     *
     * @param string $statement
     * @return PDOStatement
     */
    public function query($statement)
    {
        return self::$PDOInstance->query($statement);
    }

  
    /**
     * Quotes a string for use in a query
     *
     * @param string $input
     * @param int $parameter_type
     * @return string
     */
    public function quote($input, $parameter_type = 0)
    {
        return self::$PDOInstance->quote($input, $parameter_type);
    }

}
