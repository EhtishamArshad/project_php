<?php

namespace Project\Models;

class Orders extends DataConnector
{

    public function getTotalOrders()
    {
        $sql = "SELECT COUNT(id) AS total_orders from orders";

        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }

    public function getMonthlyOrders()
    {
        $sql = "SELECT  MONTH(purchase_date) as month_name ,COUNT(*) as total_orders
        FROM orders
        GROUP BY YEAR(purchase_date), MONTH(purchase_date)";

        $monthlyOrders = [];
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $monthlyOrders[$row['month_name']] = $row['total_orders'];
        }
        return  $monthlyOrders;
    }
}
