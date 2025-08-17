<?php

/**
 * 
 * Batch Model
 */
class Batch extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'shopid',
        'productid',
        'batchcode',
        'quantity',
        'expiredate',
    ];

    protected $beforeInset = [
        //  'make_course_id',
    ];
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
        $products = new Product();
        foreach ($data as $key => $row) {
            $result = $products->where('productid', $row->productid);
            $data[$key]->product = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
