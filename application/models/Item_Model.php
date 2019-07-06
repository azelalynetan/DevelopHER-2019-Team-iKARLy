<?php

class Item_Model extends CI_Model {

    public function insertData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

}