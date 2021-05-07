<?php

namespace Project\Models;

class Customer extends DataConnector {

    public function getTotalCustomers()
    {
        $sql = "SELECT COUNT(id) AS total_customers from customer";

        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
}
