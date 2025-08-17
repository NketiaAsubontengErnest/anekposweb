<?php

/**
 * 
 * Wallet Model
 */
class Wallet extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'shopid',
        'years',
        'startdate',
        'enddate',
    ];

    protected $beforeInset = [
        //  'make_course_id',
    ];
    protected $afterSelect = [];

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
}
