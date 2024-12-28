<?php


trait Database
{
    private function connect()
    {
        $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
        $conn = new PDO($dsn,DBUSER,DBPASSWORD);
        return $conn;
    }

    public function query($query, $data = [])
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        $check = $stmt->execute($data);
        if($check)
        {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
        return false;
    }

    public function getRow($query, $data = [])
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        $check = $stmt->execute($data);
        if($check)
        {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result[0];
            }
        }
        return false;
    }
}