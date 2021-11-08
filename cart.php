  <?php

$connect = mysqli_connect("localhost", "root", "", "test");
if(isset($_POST["quantity"])){
   
foreach ($_POST["quantity"] as $key => $value){
  if($value > 0){
   $query = "INSERT INTO cart (id_product,Quantity) VALUES ( $key , $value) ";
      $result = mysqli_query($connect, $query);
  }
}
}
?>
<html>

  
<body>
     <center> <a href="index.php"><h2> product page </h2> <style type="width 100%"></style></a> </center> 


 <center> <h3>Order Details</h3>  </center>  
                <div class="table-responsive">  
                    <table border="4"> 
                          <tr>  
                               <th width="30%">Item Name</th>  
                               <th width="30%">Quantity</th>  
                               <th width="30%">Price</th>  
                               <th width="30%">Total</th>  
                               <th width="30%">Action </th>
                             
                              
                          </tr>  
                    
                          <?php

                           $query = "SELECT * FROM cart LEFT JOIN tbl_product ON cart.id_product = tbl_product.pid ";
                           $result = mysqli_query($connect, $query);
                           if(mysqli_num_rows($result) >0)
                           {     
                             while($row = mysqli_fetch_array($result))
                              {
                                
                                

                              echo "<tr>
                               <td ><center>".$row['name']."</td></center>  
                               <td ><center>".$row['Quantity']."</td></center>   
                               <td ><center>".$row['price']."</td></center>   
                               <td ><center>".$row['price']*$row['Quantity'] ."</td></center> 
                               <td><form action='deleteCart.php' method='POST'><input type='hidden' name='item' value='".$row["id"]."'/><input type='submit' name='delete' value='delete' /></form></td></tr>";
                                "</tr>" ;

                              }
                          }else {
                            echo "<tr><td colspan='5'><center>No Product in cart </center></td></tr>";
                          }
                          
                          ?>
                  
                     </table>  
                </div>  
           </div>  
           <br />  
      </body>  
 </html>