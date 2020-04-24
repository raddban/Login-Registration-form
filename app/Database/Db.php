<?php

namespace Mail\Database;


class Db
{
    private $host;
    private $username;
    private $password;
    private $dbname;

    protected function connectDB()
    {
        $this->host = 'localhost';
        $this->username = 'arturs';
        $this->password = '00000000';
        $this->dbname = 'users';

        return new \mysqli($this->host, $this->username, $this->password, $this->dbname);
    }
}

