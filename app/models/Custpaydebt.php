<?php

/**
 * 
 * Custpaydebt Model
 */
class Custpaydebt extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'custid',
        'shopid',
        'userid',
        'amount',
    ];

    protected $beforeInset = [];
    protected $afterSelect = [
        'get_Customer',
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

    public function get_Customer($data)
    {
       $customers = new Customer();
       foreach ($data as $key => $row) {
          $result = $customers->where('custid', $row->custid);
          $data[$key]->customer = is_array($result) ? $result[0] : array();
       }
       return $data;
    }

    
}
