<?php

/**
 * 
 * Shop Model
 */
class Shop extends Model
{
   protected $ran;
   protected $allowedColumns = [
      'shopid',
      'shopname',
      'location',
      'address',
      'phone',
      'email',
      'startdate',
      'enddate',
      'years',
      'initials',
      'logo',
   ];

   protected $beforeInset = [];
   // protected $afterSelect = [
   //     'get_Category',
   // ];

   public function validate($data)
   {
      $this->errors = array();
      //checking errors for School Name
      if (empty($data['shopname'])) {
         $this->errors['shopname'] = "Please Enter Shop Name!";
      }
      if (empty($data['address'])) {
         $this->errors['address'] = "Please Enter Shop Address!";
      }
      if (empty($data['location'])) {
         $this->errors['location'] = "Please Enter Shop Location!";
      }
      if (empty($data['years'])) {
         $this->errors['years'] = "Please Enter Shop Number of Years!";
      }
      if (empty($data['phone'])) {
         $this->errors['phone'] = "Please Enter Shop Phone!";
      }
      if (empty($data['initials']) || strlen($data['initials']) != 3) {
         $this->errors['initials'] = "Please Enter Shop Initials and must be 3 letters!";
      }

      //check if the errors are empty
      if (count($this->errors) == 0) {
         return true;
      }
      return false;
   }
}
