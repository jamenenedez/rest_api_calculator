<?php

    interface MigratorInterface{
        public function verify();
        public function up();
        public function down();
    }

?>