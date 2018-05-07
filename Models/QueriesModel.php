<?php
// My database class
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 16:40
 */
class QueriesModel
{
    private $db;
    private $dbname;
    private $dbusername;
    private $dbpassword;

    public function __construct($dbname, $dbusername, $dbpassword)
    {
        $this->dbname = $dbname;
        $this->dbusername = $dbusername;
        $this->dbpassword = $dbpassword;

        // Calling a function to create the PDO connection
        $this->createPdoConnection();
    }

    private function createPdoConnection() {
        try {
            // Creating the PDO connection
            $this->db = new PDO('mysql:host=localhost;dbname='.$this->dbname, $this->dbusername, $this->dbpassword);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // If the connection doesn't work then I display an error message
            echo '<h1>Connection to database failed!</h1>';
            echo "<p>$e</p>";
        }
    }

    //Function to execute a PDO statement and return the data
    public function pdoStatement($sql, $data=array()) {
        $statement = $this->db->prepare( $sql );
        try{
            $statement->execute( $data );
        } catch (Exception $e){
            echo "<p>Exception: $e</p>";
        }
        return $statement;
    }
}