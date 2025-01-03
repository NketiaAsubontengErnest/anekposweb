<?php 
/**
 * 
 * Category Model
 */
class Category extends Model{
   protected $ran;
   protected $allowedColumns = [
      'category',
      'shopid',
   ];

   protected $beforeInset = [
    //  'make_course_id',
   ];
    // protected $afterSelect = [
    //     'get_Category',
    // ];
   
   public function validate($data){
      $this->errors = array();
      //checking errors for School Name
      if(empty($data['category'])){
         $this->errors['category'] = "Please Enter category Name!";
      }
     
      //check if the errors are empty
      if(count($this->errors) ==0){
         return true;
      }
      return false;
   }  
   
}
