<?php

/**
 * 
 * Shop Model
 */
class Sale extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'productid',
        'ordernumber',
        'shopid',
        'quantity',
        'price',
        'datesold',
        'userid',
        'profit',
        'hide',
        'expiredate',
    ];

    protected $beforeInset = [];
    protected $afterSelect = [
        'get_Product',
    ];

    public function validate($data)
    {
        $this->errors = array();
        //checking errors for School Name

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_Product($data)
    {
        $prod = new Product();
        foreach ($data as $key => $row) {
            if (!empty($row->productid)) {
                $result = $prod->where('productid', $row->productid);
                $data[$key]->product = $result[0];
            }
        }
        return $data;
    }

    public function calculate_Sales($date)
    {
        $sales = new Sale();
        return $sales->query("SELECT SUM(`quantity` * `price`) AS daily_total_sales FROM `sales` WHERE `datesold` =:datesold AND `userid`=:userid AND `shopid`=:shopid", [
            'datesold' => $date,
            'userid' => Auth::getUsername(),
            'shopid' => Auth::getShop()->shopid
        ])[0]->daily_total_sales;
    }
}
