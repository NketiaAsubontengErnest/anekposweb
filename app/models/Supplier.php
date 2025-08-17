<?php

/**
 * 
 * Supplier Model
 */
class Supplier extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'suplid',
        'shopid',
        'suplname',
        'suplphone',
        'supllocation',
    ];

    // protected $beforeInset = [
    //    //  'make_course_id',
    // ];
    protected $afterSelect = [
        'get_Supplyer_total_debt',
        'get_Supplyer_total_pay',
    ];

    public function validate($data)
    {
        $this->errors = array();
        //checking errors for Customer
        if (empty($data['suplname'])) {
            $this->errors['suplname'] = "Please Enter Supplyer Name!";
        }

        if (empty($data['suplphone'])) {
            $this->errors['suplphone'] = "Please Enter Supplyer Phone!";
        }

        //   if(count($data['custphone']) < 10){
        //      $this->errors['custphone'] = "Please Enter Supplyer Phone can't be more than 10!";
        //   }

        if (empty($data['supllocation'])) {
            $this->errors['supllocation'] = "Please Enter Supplyer Name!";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_Supplyer_total_debt($data)
    {
        $custdebts = new Supplierdebt();
        foreach ($data as $key => $row) {
            $result = $custdebts->query('SELECT SUM(`amount`) AS total_debt FROM `supplierdebts` WHERE `suplid` =:suplid AND `shopid` =:shopid', [
                'suplid' => $row->suplid,
                'shopid' => Auth::getShop()->shopid,
            ]);
            $data[$key]->supplyer_total_debt = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_Supplyer_total_pay($data)
    {
        $custpaydebt = new Suplypaydebt();
        foreach ($data as $key => $row) {
            $result = $custpaydebt->query('SELECT SUM(`amount`) AS total_pay FROM `suplypaydebts` WHERE `suplid` =:suplid AND `shopid` =:shopid', [
                'suplid' => $row->suplid,
                'shopid' => Auth::getShop()->shopid,
            ]);
            $data[$key]->supplyer_total_pay = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
