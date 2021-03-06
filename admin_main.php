<?php session_start();
if($_SESSION['status_login'] != 1){
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">';
    exit();
}
include("connect.php");
include("function.php");
$menu = "admin";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Admin!</title>

  </head>
  <body>

  <?php include("theme/navbar.php"); ?>

 <!-- body main -->
 <div class="container">
  <br>
  <p class="text-center"><h1> Admin</h1></p>
  <br>
  <?php if($_GET['id'] == ""){ ?>
  <p class="text-center"><h3>Add Admin</h3></p>
  <form method="POST" action="admin_add_save.php">
      <div class="form-group">
        <label>Usernam</label>
        <input type="text" class="form-control" name="username">
      </div>
       <div class="form-group">
        <label>Password</label>
        <input type="test" class="form-control" name="password">
      </div>
       <div class="form-group">
        <label>Name</label>
        <input type="test" class="form-control" name="name">
      </div>
       
        
      
      
      <button type="submit" class="btn btn-primary">save</button>
  </form>
<?php } ?>

<!--- edit -->
 <?php if($_GET['id'] != ""){ 

  $result = mysqli_query($con,"SELECT * FROM admin WHERE admin_id = '".$_GET['id']."'");
  $data = mysqli_fetch_assoc($result);


  ?>
  <p class="text-center"><h3>Add edit </h3></p>
  <form method="POST" action="admin_edit_save.php">
  <input type="hidden" value="<?php echo $data['admin_id'];?>" name="id">
      <div class="form-group">
        <label>Usernam</label>
        <input type="text" class="form-control" name="username" value="<?php echo $data['username'];?>" readonly>
      </div>
       <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password" value="<?php echo $data['password'];?>">
      </div>
       <div class="form-group">
        <label>Name</label>
        <input type="test" class="form-control" name="name" value="<?php echo $data['name'];?>">
      </div>
      
      <button type="submit" class="btn btn-info">edit</button>
     <a href="admin_main.php"> <button type="button" class="btn btn-primary">Add</button></a>
  </form>
<?php } ?>




<!-- table data -->
 <br>

    <table id="table_id" class="display">
    <thead>
        <tr>
            <th>id</th>
            <th>Username</th>
            <th>password</th>
            <th>name</th>
         
            <th>edit</th>
            <th>delete </th>
            
        </tr>
    </thead>
    <tbody>
      <?php 
      $result = mysqli_query($con,'SELECT * FROM admin');
       while($data = mysqli_fetch_assoc($result)){
        //var_dump($data);
        ?>
       
        <tr>
            <td><?php echo $data['admin_id'];?></td>
            <td><?php echo $data['username'];?></td>
            <td><?php echo $data['password'];?></td>
            <td><?php echo $data['name'];?></td>
            
            <td>
              <a href="admin_main.php?id=<?php echo $data['admin_id'];?>" Onclick="return Confirmedit();">
                          <button type="button" class="btn btn-info">edit</button></a>
            </td>
            <td>
              <a href="admin_delete.php?id=<?php echo $data['admin_id'];?>" Onclick="return ConfirmDelete();">
                          <button type="button" class="btn btn-danger">delete</button></a>
            </td>
           

        </tr>
        <?php 
      }
      ?>
       
    </tbody>
  </table>

   


    
 </div>



 <!-- end body -->
<?php include("theme/footer.php"); ?>
   
    <!-- table js-->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
          $('#table_id').DataTable();
      } );
    </script>

    <script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }
</script>  


<script>
    function Confirmedit()
    {
      var x = confirm("Are you sure you want to edit?");
      if (x)
          return true;
      else
        return false;
    }
</script>  

  </body>
</html>

