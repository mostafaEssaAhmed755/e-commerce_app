<?php
namespace Modules\Orders\Contracts;

interface OrderContract
{
    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function findOrderByNumber($orderNumber);

    public function storeOrderDetails($params);
}
