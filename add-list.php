<?php
include('configure/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS Add-List</title>
    <link rel="stylesheet" href="<?php echo URL;?>styles.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <!-- <div class="menu"> -->
    <a class="btn-secondary" href="<?php echo URL?>/home.php">Home</a>
    <a class="btn-secondary" href="<?php echo URL?>manage-lists.php">Manage Lists</a>
    <!-- </div> -->
    <h3>Add New List Here</h3>
    <p style="color:green; font-weight:bold">
        <?php
            //Check whether session is created or not
            if(isset($_SESSION['add_fail']))
            {
                //Display Session Message
                echo ($_SESSION['add_fail']);

                //Remove the message after display
                unset($_SESSION['add_fail']);
            }
            
            //Check whether session is created or not
            if(isset($_SESSION['add']))
            {
                //Display Session Message
                echo ($_SESSION['add']);

                 //Remove the message after display
                 unset($_SESSION['add']);
            }
            
        ?>
    </p>
    <form action="" method="post">
        <table class="tbl-form">
            <tr>
                <td>List Name : </td>
                <td><input type="text" name="list_name" id="" required></td>
            </tr>

            <tr>
                <td> List Description : </td>
                <td><textarea name="list_desc" id="" cols="30" rows=""></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" class="btn-extra" name="submit" value="SAVE"></td>
            </tr>
        </table>
        
    </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
    // echo 'Form submitted successfully';
    $list_name=$_POST['list_name'];
    $list_desc=$_POST['list_desc'];
    // echo ($list_name);
    // echo ($list_desc);

    //Insert Query
    $sql = "INSERT INTO `tbl_lists`(`list_name`, `list_desc`) VALUES ('$list_name','$list_desc')";
    // echo $sql;

    //Execute Query
    if(mysqli_query($conn,$sql))
    {
        // echo "Data inserted successfully";
        
        //create a session variable to display message
        $_SESSION['add'] = "List added successfully";
        
        // <script>alert("List added successfully")</script>
        

        //Redirect to manage-lists page
        header('Location :'.URL.'manage-lists.php');
      

        // <script type="text/javascript">
        //     window.location="manage-lists.php";
        // </script>

        
    
    }
    else
    {
        // echo "Error!!";

        //create a session variable to save messae
        $_SESSION['add_fail'] = "Error!!";

        //Redirect to add-list page
        header('Location :'.URL.'add-list.php');
    }
    
}

/*else
{
    echo 'Form not submitted';
}*/

?>
