<?php 

if(isset($_POST['delete_item'])){

   $cart_id = $_POST['cart_id'];
   $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
   
   $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
   $verify_delete_item->execute([$cart_id]);

   if($verify_delete_item->rowCount() > 0){
      $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
      $delete_cart_id->execute([$cart_id]);
      $success_msg[] = 'Cart item deleted!';
   }else{
      $warning_msg[] = 'Cart item already deleted!';
   } 

}

