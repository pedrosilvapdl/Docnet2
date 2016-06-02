<?php 
session_start(); 
 //test_class.php  
 include 'database.php';  
 $data = new Databases;  
 $success_message = '';  


 /*
This is the submission of the form, and escaping the strings to control what is inputed.
 */
 if(isset($_POST["submit"]))  
 {  
      $insert_data = array(  
           'courier'     =>     mysqli_real_escape_string($data->con, $_POST['courier']),  
           'consignment_id'     =>     mysqli_real_escape_string($data->con, $_POST['consignment_id']),
           'data_transport'     =>     mysqli_real_escape_string($data->con, $_POST['data_transport']),
           'post_date'     =>     mysqli_real_escape_string($data->con, date("Y-m-d"))
 /*
This is the insersion of the data in the database.
 */
      );  
      if($data->insert('consignment', $insert_data))  
      {  
           $success_message = 'Post Inserted';  
      }       
 }  
 ?>  
 <!DOCTYPE html>  
<!--
Althou this was not requested, 
I ended up building a very basic interface so I could have a visual representation of my work
-->
 <html>  
      <head>  
           <title>BOB SHOP INC</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
            
      </head>  
      <body>  `
           <br /><br />  
           <div class="container" style="width:700px;">  
                <form method="post"> 
                <h1>Welcome to BOB's </h1> 
                <br>
                     <label>Courier</label>  
                     <input type="text" name="courier" class="form-control" required/>  
                     <br />  
                     <label>Consignment ID</label>  
                     <textarea type="text" name="consignment_id" class="form-control" required></textarea>  
                     <br />  
                     <label>Data Transport</label>  
                     <textarea name="data_transport" class="form-control" required></textarea>  
                     <label>Post Date</label>  
                     <textarea name="post_date" class="form-control" required></textarea>  
                     <br />  
                     <input type="submit" name="submit" class="btn btn-info" value="Submit" required />  
                     
                     <span class="text-success">  
                     <?php  
                     if(isset($success_message))  
                     {  
                          echo $success_message;  
                     }  
                     ?>  
                     </span>  
                </form>  
                <br />  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <td width="30%">Courier</td>  
                      
                               <td width="15%">Consigment_id</td>  
                               <td width="10%">Data Trasport</td>
                               <td width="15%">Post Date</td>    

                          </tr>  
                          <?php  
                          $post_data = $data->select('consignment');  
                          foreach($post_data as $post)  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $post["courier"]; ?></td>  
                               <td><?php echo substr($post["consignment_id"], 0, 200); ?></td>
                               <td><?php echo substr($post["data_transport"], 0, 200); ?></td>
                               <td><?php echo substr($post["post_date"], 0, 200); ?></td> 
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  