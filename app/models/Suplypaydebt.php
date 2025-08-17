<?php

/**
 * 
 * Suplypaydebt Model
 */
class Suplypaydebt extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'suplid',
        'shopid',
        'userid',
        'amount',
        'date',
    ];

    protected $beforeInset = [];
    protected $afterSelect = [
        'get_Suplayer',
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

    public function get_Suplayer($data)
    {
        $supplyers = new Supplier();
        foreach ($data as $key => $row) {
            $result = $supplyers->where('suplid', $row->suplid);
            $data[$key]->customer = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
