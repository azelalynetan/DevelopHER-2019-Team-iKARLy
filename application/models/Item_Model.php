<?php

class Item_Model extends CI_Model {

    public function fetch($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows()) ? $query->result() : false;
    }

    public function insertData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

}