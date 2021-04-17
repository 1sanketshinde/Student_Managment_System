<?php
  $conn = mysqli_connect('localhost','root','','ajaxcrude');
   
   extract($_POST);//this is for extracting all data 
   
//below code is for display all the data on page
   
if(isset($_POST['readrecord'])){

  $data = '<table class="table table-bordered table-striped">
            <tr>
               <th>No.</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Email</th>
               <th>phone no.</th>
               <th>Edit</th>
               <th>Delete</th>
            </tr>';

  $displayquery=" SELECT * FROM crudtable ";   
  $result = mysqli_query($conn, $displayquery);
  
  if(mysqli_num_rows($result) >0){
       
      $number=1;
      while ($row = mysqli_fetch_array($result)){
         
           $data  .='<tr>
                         <td>'.$number.'</td>
                         <td>'.$row['firstname'].'</td>  
                         <td>'.$row['lastname'].'</td> 
                         <td>'.$row['email'].'</td>   
                         <td>'.$row['phone'].'</td>   
                         <td>
                              <button onclick="Getuserdetails('.$row['id'].')" class="btn btn-success">EDIT</button>
                         </td>                   
                         <td>
                              <button onclick="deleteuser('.$row['id'].')" class="btn btn-danger">DELETE</button>
                         </td>                           
                   </tr>';
                   $number++;
      }
     
  }     
      $data.='</table>';
       echo $data;
            
}


/*below code is for insert data into database*/

  if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']))
  {
     $query= "INSERT INTO `crudtable`(`firstname`, `lastname`, `email`, `phone`) VALUES ('$firstname','$lastname','$email','$phone')";
      mysqli_query($conn,$query);
  }


  // DELETE USER RECORDS
       if(isset($_POST['deleteid'])){
          
          $userid=$_POST['deleteid'];
          $q="DELETE FROM crudtable WHERE id='$userid' ";
          mysqli_query($conn,$q);
       }

   // get user id for update

    if(isset($_POST['id']) && isset($_POST['id']) !="")
    {

        $user_id= $_POST['id'];
        $query = "SELECT * FROM crudtable WHERE id ='$user_id'";
        if(!$result = mysqli_query($conn,$query)) {
              exit(mysqli_error());
           }

           $response = array();
            
            if(mysqli_num_rows($result) > 0){
                 while ($row = mysqli_fetch_assoc($result)) {
                    $response = $row;
               }
         }
         else
         {
            $response['status'] = 200;
            $response['message']= "Data not Found";
         }
        echo json_encode($response);
      }
      else{
         $response['status'] = 200;
         $response['message']= "invalid Request";
      }

      //update table
      if(isset($_POST['hidden_user_idupd'])){
        
         $hidden_user_idupd= $_POST['hidden_user_idupd'];
         $firstnameupd=$_POST['firstnameupd'];
         $lastnameupd= $_POST['lastnameupd'];
         $emailupd= $_POST['emailupd'];
         $phoneupd = $_POST['phoneupd'];

         $query = "UPDATE `crudtable` SET `firstname`='$firstnameupd',
                  `lastname`='$lastnameupd',`email`='$emailupd',`phone`='$phoneupd' WHERE id='$hidden_user_idupd'";

      if (!$result = mysqli_query($conn,$query)){
         exit(mysqli_error());
      }

      }
   
?>