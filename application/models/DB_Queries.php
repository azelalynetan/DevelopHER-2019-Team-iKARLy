<?php

class DB_Queries extends CI_Model {

    public function insertData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

}