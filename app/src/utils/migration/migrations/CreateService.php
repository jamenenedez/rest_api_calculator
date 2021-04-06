<?php
require_once(__DIR__."/../MigratorHelper.php");
require_once(__DIR__."/../MigratorInterface.php");
class CreateService extends MigratorHelper implements MigratorInterface
{   

    /**
     * Verify the migration.
     *
     * @return boolean
     */
    public function verify()
    {
        return !(parent::hasTable('Service'));
    }

    /**
     * Run the migrations.
     *
     * @return boolean
     */
    public function up()
    {
        $query = "CREATE TABLE `Service` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `uuid` varchar(36) NOT NULL,
            `type` enum('addition','subtraction','multiplication','division','square_root','free_form','random_string') NOT NULL,
            `cost` double NOT NULL,
            `status` enum('active','beta','inactive') NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
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
        $query = "DROP table Service;";
        return  $this->conn->query($query);
    }

    
}
