<html>
  <head>
      <title>
         user details
      </title>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
 
  <style>
      .container-fluid{
         background: linear-gradient(#ff6f69,#ffcc5c);
         width:100%;
         height:100%;
      }
  </style>
  </head>
  <body>
     <div class="container-fluid">
     <div class="container">
        <h1 class="text-secondary  text-uppercase text-center">STUDENT MANAGEMENT SYSTEM</h1>
     

     <div class="d-flex justify-contant-end float-right">
        <!-- Button to Open the Modal -->
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              ADD DETAILS
           </button>
     </div>
      
      <div>
          <h2 class="text-danger">ALL RECORDS</h2>
        <div id="records_contant">
            
        </div>
     </div>

     <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">STUDENT MANAGEMENT SYSTEM</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="addform">
          <div class="form-group">
             <label>firstname</label>
             <input type="text" name="firstname" id="firstname" class="form-control">
          </div>
          <div class="form-group">
             <label>lastname</label>
             <input type="text" name="lastname" id="lastname" class="form-control">
          </div>

          <div class="form-group">
            <label> email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
             <label>phone number</label>
             <input type="text" name="phone" id="phone" class="form-control">
          </div>
      </div>

      <!-- Modal footer -->



      <div class="modal-footer">
      <button type="button" name= "save" class="btn btn-success" data-dismiss="modal" onclick="addrecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      
      </div>

      

    </div>
  </div>
   </form>
</div>
<!-------------------------------------update modal------------------------>

      <!-- The Modal -->
<div class="modal" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajax crude operation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div class="form-group">
             <label>firstname</label>
             <input type="text" name="frstname" id="updatefirstname" class="form-control">
          </div>
          <div class="form-group">
             <label>lastname</label>
             <input type="text" name="lastname" id="updatelastname" class="form-control">
          </div>

          <div class="form-group">
            <label> email</label>
            <input type="email" name="email" id="updateemail" class="form-control">
          </div>
          <div class="form-group">
             <label>phone number</label>
             <input type="text" name="phone" id="updatephone" class="form-control">
          </div>
      </div>

<!------------------------- Modal footer -------------------------->



      <div class="modal-footer">
      <button type="button" name= "save" class="btn btn-success" data-dismiss="modal" onclick="updateuserdetail()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           <input type="hidden" name="" id="hidden_user_id">
      </div>

      

    </div>
  </div>

</div>

     </div>



</div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
     <script type="text/javascript">
   
        $(document).ready(function(){                                                                                                                                                                                                                                         
                 readRecords();
        });

// Below function for read records from database

      function readRecords(){   
              var readrecord="readrecord";
               $.ajax({
                  url:"backend.php",
                  type:'post',
                  data:{readrecord:readrecord},
                  success:function(data,status){
                     $('#records_contant').html(data);
                  },
               })
          
      }

// Below function for adding records into database

         function addrecord(){
             var  firstnames = $('#firstname').val();
             var  lastname  = $('#lastname').val();
             var email = $('#email').val();
             var  phone = $('#phone').val();

             $.ajax ({

                 url:"backend.php",
                 type:'post',
                 data: {
                       firstname:firstnames,
                       lastname:lastname,
                       email:email,
                       phone:phone
                 },
                  
                  success:function(data,status){
                     
                      readRecords();
                      $("#addform").trigger("reset");
                  },
                 
              });

         }

         
// Below function for delete records from database

          function deleteuser(deleteid){
             
             var conf= confirm("Are you sure");
             if(conf==true){
                $.ajax({
                   url:"backend.php",
                   type:'post',
                   data:{deleteid:deleteid},
                   success:function(data,status){
                        readRecords();
                   },
                });
             }

          }

          function Getuserdetails(id){

              $('#hidden_user_id').val(id);

                $.post("backend.php",{
                   id:id
                   },function(data,status){
                     
                   
                    var user=JSON.parse(data);
                    $('#updatefirstname').val (user.firstname);
                    $('#updatelastname').val(user.lastname);
                    $('#updateemail').val(user.email);
                    $('#updatephone').val(user.phone);
                  }
   
                  );
                     $('#update_user_modal').modal("show");

                  }

          function updateuserdetail(){
             var firstnameupd = $('#updatefirstname').val();   
             var lastnameupd= $('#updatelastname').val();  
             var emailupd = $('#updateemail').val();  
             var phoneupd = $('#updatephone').val(); 

             var hidden_user_idupd = $('#hidden_user_id').val();

             $.post("backend.php",{

                hidden_user_idupd:hidden_user_idupd,
                firstnameupd:firstnameupd,
                lastnameupd:lastnameupd,
                emailupd:emailupd,
                phoneupd:phoneupd,
             },
                function(data,status){
                   $('#update_user_modal').modal("hide");
                   readRecords();
                
                 }
                  );   
               
          }        


     </script>            
    </body>
</html>
