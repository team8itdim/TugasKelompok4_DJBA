<?php
class Connection
{
   private $hostname = "localhost";
   private $dbname = "team_8";
   private $username = "root";
   private $password = "";

   public function connect()
   {
      return new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
   }
}
