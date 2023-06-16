<?php

if(isset($_POST['cancelar_pedido'])){

   $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
   $update_orders->execute(['canceled', $get_id]);
   header('location:orders.php');

}