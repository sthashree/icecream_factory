<?php

 /*** define the site path ***/
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path.'/..');

 /*** include the init.php file ***/
 include '../includes/init.php';

 $product_id 	= addslashes($_POST['product_id']);
 $type_id 		= addslashes($_POST['type_id']);

 $objProduct = new Product($registry->db);
 $objProduct->product_id = $product_id;
$result = $objProduct->getPrice($type_id);
echo $result[0]->price;

?>