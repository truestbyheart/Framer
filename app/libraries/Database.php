<?php

class Database {

    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $host = DB_HOST;


    private $db_handler;
    private $stmt;
    private $error;


    /**
     * Database constructor.
     */
    public function __construct()
    {
        // dsn url
        $dsn = "mysql:dbname=".$this->dbname.";host=".$this->host;
        $options = array(
            PDO::ATTR_PERSISTENT=>true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try{
            $this->db_handler = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e;
            echo $this->error;
        }

    }

    /**
     * @param $sql
     * Accepts SQL statement and prepare it to be used with the PDO work flow.
     */
    public function query($sql) {
        $this->stmt = $this->db_handler->prepare($sql);
    }

    /**
     * @param $param
     * @param $value
     * @param null $type
     * Finds out the type of the value provide and bind them to the statement.
     */
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch (true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type =PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param,$value,$type);
    }

    /**
     * @return mixed
     * Runs the SQL command.
     */
    public function execute() {
        return $this->stmt->execute();
    }

    /**
     * @return mixed
     * Formats the return records from the database int an array of objects.
     */
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     * Format the return record into an object.
     */
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     * Return the number of records stored on a table.
     */
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}

