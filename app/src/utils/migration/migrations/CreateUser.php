<?php
require_once(__DIR__."/../MigratorHelper.php");
require_once(__DIR__."/../MigratorInterface.php");
class CreateUser extends MigratorHelper implements MigratorInterface
{   

    /**
     * Verify the migration.
     *
     * @return boolean
     */
    public function verify()
    {
        return !(parent::hasTable('User'));
    }

    /**
     * Run the migrations.
     *
     * @return boolean
     */
    public function up()
    {
        $query = "CREATE TABLE `User` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `uuid` varchar(36) NOT NULL,
            `username` varchar(255) NOT NULL,
            `password` text NOT NULL,
            `role` enum('user','admin') NOT NULL,
            `balance` double NOT NULL DEFAULT '0',
            `status` enum('active','trial','inactive') NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username_UNIQUE` (`username`)
          ) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
          ";
          
        return  $this->conn->query($query);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return boolean
     */
    public function down()
    {
        $query = "DROP table User;";
        return  $this->conn->query($query);
    }

    
}
