<?php

trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "DESC";
    protected $order_column = "id";

    public function findAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->oder_type limit $this->limit offset $this->offset";
        return $this->query($query);
    }

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach($keys as $key)
        {
            $query .= $key . " = :" . $key . " && ";
        }
        foreach($data_not as $key => $value)
        {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, ' && ');

        $query .= " ORDER BY $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data,$data_not);

        $result = $this->query($query, $data);
        if($result)
        {
            return $result[0];
        }
        return false;
    }

    public function first($data, $data_not = [])
    {

    }

    public function insert($data)
    {
        //remove unwanted data
        if(!empty($this->allowedColumns))
        {
            foreach($data as $key => $value)
            {
                if(!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(",",$keys) .") VALUES (:". implode(",:",$keys) .")"; //implode turns array into string
        
        $this->query($query, $data);
        
        return false;
    }
    public function update($id, $data, $id_column = 'id')
    {
        
        //remove unwanted data
        if(!empty($this->allowedColumns))
        {
            foreach($data as $key => $value)
            {
                if(!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";
        
        foreach($keys as $key)
        {
            $query .= $key . " = :" . $key . ", ";
        }
        
        $query = trim($query, ', ');;
        $query .= " where $id_column = :$id_column";
        
        $data[$id_column] = $id;
        $this->query($query, $data);
        return false;
    }
    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :id ";
        $this->query($query, $data);
        return false;
    }
}