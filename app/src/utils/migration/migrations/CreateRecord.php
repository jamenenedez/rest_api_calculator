<?php
require_once(__DIR__."/../MigratorHelper.php");
require_once(__DIR__."/../MigratorInterface.php");
class CreateRecord extends MigratorHelper implements MigratorInterface
{   

    /**
     * Verify the migration.
     *
     * @return boolean
     */
    public function verify()
    {   
        return !(parent::hasTable('Record'));
    }

    /**
     * Run the migrations.
     *
     * @return boolean
     */
    public function up()
    {
        $query = "CREATE TABLE `Record` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `uuid` varchar(36) NOT NULL,
            `service_id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `cost` double NOT NULL,
            `user_balance` double NOT NULL DEFAULT '0',
            `service_response` text NOT NULL,
            `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `status` enum('active','inactive') NOT NULL,
            PRIMARY KEY (`id`),
            KEY `FK_User_idx` (`user_id`),
            KEY `FK_Service_idx` (`service_id`),
            CONSTRAINT `FK_Service` FOREIGN KEY (`service_id`) REFERENCES `Service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `FK_User` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
          ";
          
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
