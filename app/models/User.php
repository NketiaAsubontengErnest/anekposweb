<?php

/**
 * 
 * User Model
 */
class User extends Model
{
   protected $ran;
   protected $allowedColumns = [
      'username',
      'password',
      'shopid',
      'firstname',
      'lastname',
      'phone',
      'rank',
      'officer'
   ];

   protected $beforeInset = [
      'make_user_id',
      'hash_password',
   ];

   protected $afterSelect = [
      'get_Shop',
   ];
   public function validate($data)
   {
      $this->errors = array();
      //checking errors for first name
      if (empty($data['firstname'])) {
         $this->errors['firstname'] = "First name can't be empty";
      }
      if (empty($data['firstname']) || !preg_match('/^[a-z A-Z-]+$/', $data['firstname'])) {
         $this->errors['firstname'] = "Only letters allowed in first name";
      }

      //checking errors for last name
      if (empty($data['lastname'])) {
         $this->errors['lastname'] = "Last name can't be empty";
      }
      if (empty($data['lastname']) || !preg_match('/^[a-z A-Z-]+$/', $data['lastname'])) {
         $this->errors['lastname'] = "Only letters allowed in last name";
      }

      //check if the errors are empty
      if (count($this->errors) == 0) {
         return true;
      }
      return false;
   }

   public function make_user_id($data)
   {
      $ids = $this->query("SELECT * FROM `users` WHERE `shopid` =:shopid ORDER BY ID DESC LIMIT 1", ['shopid'=>Auth::getShop()->shopid])[0]->username;

      $ids = substr($ids, 3);

      $ids++;
      if ($ids < 10) {
         $ids = "000" . $ids;
      } elseif ($ids < 100) {
         $ids = "00" . $ids;
      } elseif ($ids < 1000) {
         $ids = "0S" . $ids;
      }

      $data['username'] = Auth::getShop()->initials. '' . $ids;
      $data['password'] = Auth::getShop()->initials. '' . $ids;

      $data['shopid'] = Auth::getShop()->shopid;

      return $data;
   }

   public function hash_password($data)
   {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      return $data;
   }

   public function checkretypepass($data)
   {
      $this->errors = array();
      if (empty($data['password']) || empty($data['retyppassword'])) {
         $this->errors['password'] = "Passwords cant be empty!";
      } elseif ($data['password'] != $data['retyppassword']) {
         $this->errors['password'] = "Passwords missmatch!";
      } elseif (strlen($data['password']) < 8) {
         $this->errors['password'] = "Passwords length should not be < 8";
      } else {
         unset($data['retyppassword']);
         return $this->hash_password($data);
      }
      return false;
   }

   public function get_Shop($data)
   {
      $shops = new Shop();

      foreach ($data as $key => $row) {
         if (!empty($row->shopid)) {
            $result = $shops->where('shopid', $row->shopid);
            $data[$key]->shop = $result[0];
         }
      }
      return $data;
   }
   
   public function get_Officer($data)
   {
      $offi = new User();
      foreach ($data as $key => $row) {
         if (!empty($row->id)) {
            $result = $offi->where('id', $row->officer);
            $data[$key]->officer = is_array($result) ? $result[0] : array();
         }
      }
      return $data;
   }
}
