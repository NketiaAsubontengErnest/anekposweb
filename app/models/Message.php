<?php

/**
 * 
 * Message Model
 */
class Message extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'name',
        'email',
        'subject',
        'phone',
        'message',
        'sentdatetime'
    ];

    // protected $beforeInset = [
    //    //  'make_course_id',
    // ];
    protected $afterSelect = [];

    public function validate($data)
    {
        $this->errors = array();
        //checking errors for Customer
        if (empty($data['name'])) {
            $this->errors['name'] = "Please Enter Name!";
        }
        if (empty($data['phone'])) {
            $this->errors['phone'] = "Please Enter Phone!";
        }

        if (empty($data['email'])) {
            $this->errors['email'] = "Please Enter Email Phone!";
        }
        if (empty($data['subject'])) {
            $this->errors['subject'] = "Please Enter Subject!";
        }
        if (empty($data['message'])) {
            $this->errors['message'] = "Please Enter Message!";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Please Enter Valid Email!";
        }
        if (!preg_match('/^[0-9]{10,15}$/', $data['phone'])) {
            $this->errors['phone'] = "Please Enter Valid Phone Number!";
        }
        if (strlen($data['message']) < 10) {
            $this->errors['message'] = "Message must be at least 10 characters long!";
        }
        if (strlen($data['phone']) < 10) {
            $this->errors['phone'] = "Phone must be at least 10 characters long!";
        }
        if (strlen($data['subject']) < 3) {
            $this->errors['subject'] = "Subject must be at least 3 characters long!";
        }
        if (strlen($data['name']) < 3) {
            $this->errors['name'] = "Name must be at least 3 characters long!";
        }
        if (strlen($data['email']) < 5) {
            $this->errors['email'] = "Email must be at least 5 characters long!";
        }
        if (strlen($data['name']) > 50) {
            $this->errors['name'] = "Name must not exceed 50 characters!";
        }
        if (strlen($data['email']) > 100) {
            $this->errors['email'] = "Email must not exceed 100 characters!";
        }
        if (strlen($data['subject']) > 100) {
            $this->errors['subject'] = "Subject must not exceed 100 characters!";
        }
        if (strlen($data['message']) > 500) {
            $this->errors['message'] = "Message must not exceed 500 characters!";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
}
