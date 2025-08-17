<?php

/**
 * 
 * Supplierdebt Model
 */
class Supplierdebt extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'suplid',
        'shopid',
        'userid',
        'invoicenum',
        'amount',
    ];

    protected $beforeInset = [];
    protected $afterSelect = [
        'get_Supplyer',
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

    public function get_Supplyer($data)
    {
        $suppliers = new Supplier();
        foreach ($data as $key => $row) {
            $result = $suppliers->where('suplid', $row->suplid);
            $data[$key]->supplyer = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
