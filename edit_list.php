<?php
    include('configure/constants.php');

    //Check whether list_id is passed or not.
    if(isset($_GET["list_id"]))
    {
        $list_id = $_GET['list_id'];

        //Query to get data of selected list
        $sql = "SELECT * from tbl_lists WHERE list_id = $list_id";

        //Execute the query
        $result = mysqli_query($conn,$sql);

        if($result==true)
        {
            //Get current values of selected list from databse
            $row = mysqli_fetch_assoc($result); //Returns PHP-Array
            // print_r($row);  //Prints 

            //Get data from array
            $list_name = $row['list_name'];
            $list_desc = $row['list_desc'];
        }
        else
        {
            //Redirect to manage-list page
            header("Location: ".URL."manage-lists.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS Update</title>
    <link rel="stylesheet" href="<?php echo URL;?>styles.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>

    <!-- <div class="menu"> -->
        <a class="btn-secondary" href="<?php echo URL?>/home.php">Home</a>
        <a class="btn-secondary" href="<?php echo URL?>manage-lists.php">Manage Lists</a> <!--it is best practise to give full url link in every page-->
    <!-- </div> -->
    <h3>Update Your List Here</h3>
    <p>
        <?php
            //Check whether session is created or not
            if(isset($_SESSION['update_fail']))
            {
                //Display Session Message
                echo ($_SESSION['update_fail']);

                //Remove the message after display
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>

    <form action="" method="post">
        <table class="tbl-form">
            <tr>
                <td>List Name : </td>
                <td><input type="text" name="list_name" id="" value="<?php echo $list_name;?>" required></td>
            </tr>

            <tr>
                <td> List Description : </td>
                <td>
                    <textarea name="list_desc" id="" cols="" rows="">
                        <?php echo $list_desc;?>
                    </textarea>
                </td>
            </tr>

            <tr>
                <td><input type="submit" class="btn-extra" name="submit" value="UPDATE"></td>
            </tr>
        </table>
        
    </form>
    </div>
</body>
</html>

<?php
//Check whether update button is clicked or not
if(isset($_POST['submit'])) //  Name of the button will bw used
{
    // echo 'Form submitted successfully';

    //Get the updated values from form
    $list_name = $_POST['list_name'];
    $list_desc = $_POST['list_desc'];
    // echo ($list_name);
    // echo ($list_desc);

    //Insert Query
    $sql2 = "UPDATE `tbl_lists` SET `list_name` = '$list_name', `list_desc` = '$list_desc' WHERE `tbl_lists`.`list_id` = $list_id";
    // echo $sql2;

    //Execute Query
    if(mysqli_query($conn,$sql2))
    {
        // echo "Data updated successfully";
        
        //create a session variable to display message
        $_SESSION['update_success'] = "List updated successfully";
        
        // Redirect to manage-lists page
        header('Location:'.URL.'manage-lists.php');
    }
    else
    {
        // echo "Error!! Data not inserted!";

        //create a session variable for update-failed message
        $_SESSION['update_fail'] = "Failed to update list!";

        //Redirect to manage-list page
        header("location:". URL."edit_lists?list_id=".$list_id);
    }
    
}
