<?php

namespace Project\Models;

class Revenue extends DataConnector
{

    public function getTotalRevenue()
    {
        $sql = "SELECT (quantity*price) AS total from orderItems";

        $revenue = [];
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($revenue, $row['total']);
        }
        return array_sum($revenue);
    }
}
