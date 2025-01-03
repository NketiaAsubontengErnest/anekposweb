Customer
<?php
/**
 * 
 * Customer Model
 */
class Customer extends Model
{
   protected $ran;
   protected $allowedColumns = [
      'custid',
      'shopid',
      'custname',
      'custphone',
      'custlocation',
   ];

   protected $beforeInset = [
      //  'make_course_id',
   ];
   protected $afterSelect = [
      'get_Customer_total_debt',
      'get_Customer_total_pay',
   ];

   public function validate($data)
   {
      $this->errors = array();
      //checking errors for Customer
      if (empty($data['custname'])) {
         $this->errors['custname'] = "Please Enter Customer Name!";
      }

      if (empty($data['custphone'])) {
         $this->errors['custphone'] = "Please Enter Customer Phone!";
      }

      //   if(count($data['custphone']) < 10){
      //      $this->errors['custphone'] = "Please Enter Customer Phone can't be more than 10!";
      //   }

      if (empty($data['custlocation'])) {
         $this->errors['custlocation'] = "Please Enter Customer Name!";
      }

      //check if the errors are empty
      if (count($this->errors) == 0) {
         return true;
      }
      return false;
   }

   public function get_Customer_total_debt($data)
   {
      $custdebts = new Customerdebt();
      foreach ($data as $key => $row) {
         $result = $custdebts->query('SELECT SUM(`amount`) AS total_debt FROM `customerdebts` WHERE `custid` =:custid AND `shopid` =:shopid', [
            'custid' => $row->custid,
            'shopid' => Auth::getShop()->shopid,
         ]);
         $data[$key]->customer_total_debt = is_array($result) ? $result[0] : array();
      }
      return $data;
   }
   public function get_Customer_total_pay($data)
   {
      $custpaydebt = new Custpaydebt();
      foreach ($data as $key => $row) {
         $result = $custpaydebt->query('SELECT SUM(`amount`) AS total_pay FROM `custpaydebts` WHERE `custid` =:custid AND `shopid` =:shopid', [
            'custid' => $row->custid,
            'shopid' => Auth::getShop()->shopid,
         ]);
         $data[$key]->customer_total_pay = is_array($result) ? $result[0] : array();
      }
      return $data;
   }
}
