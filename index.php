<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "test");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                 
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_POST["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="index.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  
 
<!DOCTYPE html>
<html>
	<head>
		<title>shopping_cart</title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
   <center> <a href="cart.php"><h3>cart page</h3> <style type="width 100%"></style></a> </center> 
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<h3 align="center">shopping_cart </h3><br />
			<br /><br />
               <form action="Cart.php" method="POST">
               
			<?php
				$query = "SELECT * FROM tbl_product ORDER BY pid ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) >0)
				{
					while($row = mysqli_fetch_array($result))
					{

				?>

                    
			<div class="col-md-4">
               					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger"><?php echo $row["price"]; ?></h4>

                             <input type="number" name="quantity[<?php echo $row["pid"]; ?>]" value="0" />
						<input type="hidden" name="hidden_name[<?php echo $row["pid"]; ?>]" value="<?php echo $row["name"]; ?>" />
              
						<input type="hidden" name="hidden_price[<?php echo $row["pid"]; ?>]" value="<?php echo $row["price"]; ?>" />
                             
                          </div>  
                
                </div>  
                <?php  
                     }  
                }  
                ?>  
                 <center><input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" /> </center> 
                 </form>  
                 <div style="clear:both"></div>  
                <br />  
          </div>
     </body>
</html>
