<?php

/**
 * 
 * Product Model
 */
class Product extends Model
{
   protected $ran;
   protected $allowedColumns = [
      'productid',
      'barcode',
      'catid',
      'pro_name',
      'quantity',
      'threshold',
      'cost_price',
      'selling_price',
      'hide',
      'shopid'
   ];

   protected $beforeInset = [
      //  'make_course_id',
   ];
   protected $afterSelect = [
      'get_Category',
   ];

   public function validate($data)
   {
      $this->errors = array();
      //checking errors for School Name
      if (empty($data['pro_name'])) {
         $this->errors['pro_name'] = "Please Enter Product Name!";
      }

      if (empty($data['catid'])) {
         $this->errors['catid'] = "Please Choose a Category!";
      }

      if (empty($data['quantity'])) {
         $this->errors['quantity'] = "Please Enter the Quantity!";
      }

      if (empty($data['threshold'])) {
         $this->errors['threshold'] = "Please Enter the Threshold!";
      }

      if (empty($data['cost_price'])) {
         $this->errors['cost_price'] = "Please Enter the Cost Price!";
      }

      if (empty($data['selling_price'])) {
         $this->errors['selling_price'] = "Please Enter the Selling Price!";
      }

      if (empty($data['hide'])) {
         $this->errors['hide'] = "Please Choose a Hide!";
      }

      //check if the errors are empty
      if (count($this->errors) == 0) {
         return true;
      }
      return false;
   }

   public function get_Category($data)
   {
      $category = new Category();
      foreach ($data as $key => $row) {
         $result = $category->where('id', $row->catid);
         $data[$key]->category = is_array($result) ? $result[0] : array();
      }
      return $data;
   }

   public function get_Prod_Total($data)
   {
      $sales = new Sale();
      foreach ($data as $key => $row) {
         $arr = [
            'productid' => $row->productid,
            'shopid'    => Auth::getShop()->shopid,
         ];
         $result = $sales->where_query("SELECT SUM(quantity) AS total_prod_quantity, `price` AS prod_unit_price, SUM(quantity * price) AS total_prod_amount FROM `sales` WHERE `productid` =:productid AND `shopid` =:shopid",$arr);
         $data[$key]->prod_totals = is_array($result) ? $result[0] : array();
      }
      return $data;
   }
}
