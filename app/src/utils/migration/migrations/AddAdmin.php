<?php
require_once(__DIR__."/../MigratorHelper.php");
require_once(__DIR__."/../MigratorInterface.php");
class AddAdmin extends MigratorHelper implements MigratorInterface
{   

    /**
     * Verify the migration.
     *
     * @return boolean
     */
    public function verify()
    {   
        return !(parent::hasRecords("Select * from User where username = 'tester@gmail.com'", 'User'));
    }

    /**
     * Run the migrations.
     *
     * @return boolean
     */
    public function up()
    {
        $query = "INSERT INTO User(uuid, username, password, role, balance, status)
                    VALUES (UUID(), 'tester@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active')";
          
        return $this->conn->query($query);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return boolean
     */
    public function down()
    {
        $query = "DROP table Record;";
        return  $this->conn->query($query);
    }

    
}
