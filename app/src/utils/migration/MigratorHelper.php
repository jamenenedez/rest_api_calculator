<?php
require_once(__DIR__ . '../../../config/db.php');
class MigratorHelper
{
    public function __construct()
    {
        // Get DB Object
        $this->db = new db();
        // Connect        
        $this->conn = $this->db->connect();
    }

    public function migrate(array $migrations)
    {
        $messages = array();
        foreach ($migrations as $migration) {
            $migrationPath = __DIR__ . "/../migration/migrations/" . $migration . ".php";
            if (!file_exists($migrationPath)) {
                $messages[] = "Migration does not exists";
            } else {
                require_once($migrationPath);
                if (class_exists($migration)) {
                    $migrationObject = new $migration();
                    if ($migrationObject->verify()) {
                        $result = $migrationObject->up();
                        $messages[] = ($result == true) ? "Migration executed successfuly" : "Migrations executed wrong";
                    } else {
                        $messages[] = "The migration has already been made";
                    }
                } else {
                    $messages[] = "Class does not exists";
                }
            }
        }
        return $messages;
    }

    public function hasColumn($column, $table)
    {
        $query  = "SHOW COLUMNS FROM $table LIKE '$column'";
        $result = $this->conn->query($query);
        $record = $result->fetch(PDO::FETCH_OBJ);
        return ($record) ? true : false;
    }
    public function hasTable($table)
    {
        $dbname = $this->db->getName();
        $query = "SELECT count(*) as total FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '$table' AND TABLE_SCHEMA = '$dbname'";
        $result = $this->conn->query($query);
        $record = $result->fetch(PDO::FETCH_OBJ);
        return ($record->total > 0);
    }

    public function hasRecord($record, $column, $table)
    {
        if($this->hasTable($table)){
            $query = "select * from $table where `$column` like '$record'";
            $result = $this->conn->query($query);
            $record = $result->fetch(PDO::FETCH_OBJ);
            return ($record) ? true : false;
        }
        return false;
    }

    public function hasRecords($query, $table)
    {
        if($this->hasTable($table)){
            $result = $this->conn->query($query);
            $records = $result->fetchAll(PDO::FETCH_OBJ);
            return !empty($records);
        }
        return false;
    }

}
