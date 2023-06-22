<?php
    include('configure/constants.php'); 
    //Check whether task_id is passed or not.
    if(isset($_GET["task_id"]))
    {
        $task_id = $_GET['task_id'];

        //Query to get data of selected task
        $sql = "SELECT * from tbl_tasks WHERE task_id = $task_id";

        //Execute the query
        $result = mysqli_query($conn,$sql);

        if($result==true)
        {
            //Get current values of selected list from databse
            $row = mysqli_fetch_assoc($result); //Returns PHP-Array
            // print_r($row);  //Prints 

            //Get data from array
            $list_id = $row['list_id'];
            $task_name = $row['task_name'];
            $task_desc = $row['task_desc'];
            $priority = $row['task_priority'];
            $deadline = $row['task_deadline'];
        }
        else
        {
            //Redirect to Home page
            header("Location: ".URL);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS Update-Task</title>
    <link rel="stylesheet" href="<?php echo URL;?>styles.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>

    <p>
        <a class="btn-secondary" href="<?php echo URL?>/home.php">Home</a>
    </p>
    <h3>Update Your Task Here</h3>
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
                <td>Task Name : </td>
                <td><input type="text" name="task_name" id="" value="<?php echo $task_name;?>" required></td>
            </tr>

            <tr>
                <td>Task Description : </td>
                <td>
                    <textarea name="task_desc" id="">
                        <?php echo $task_name;?>
                    </textarea>
                </td>
            </tr>

            <tr>
                <td>Select List : </td>
                <td>
                    <select name="list_id" id="">
                        <?php 
                            //Query to get all tasks from table
                            $sql2 = "SELECT * FROM tbl_lists";

                            $res = mysqli_query($conn,$sql2);
                            if($res==true)
                            {
                                //Create variable to count returned number of rows
                                $count_rows = mysqli_num_rows($res);

                                //If list is present in database then display it in dropdown else display none as option

                                if($count_rows>0)
                                {
                                    //Display lists in dropdown
                                    while ($row=mysqli_fetch_assoc($res))
                                    {
                                        $list_id_db = $row['list_id'];
                                        $list_name = $row['list_name'];
                                        ?>
                                        <option <?php if($list_id==$list_id_db){echo "selected='selected'";}?> value="<?php echo $list_id;?>"><?php echo $list_name;?></option>
                                        <?php
                                    } 
                                    
                                }
                                else
                                {
                                    //Display none
                                    ?>
                                    <option <?php if($list_id==0){echo "selected='selected'";}?> selected disabled hidden>None</option>
                                    <?php
                                }
                            }
                        ?>
                    </select></td>
            </tr>

            <tr>
                <td>Priority : </td>
                <td>
                    <select name="priority" id="">
                        <option <?php if($priority=="Low"){echo "selected='selected'";}?> value="Low">Low
                        </option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'";}?> value="Medium">Medium
                        </option>
                        <option <?php if($priority=="High"){echo "selected='selected'";}?> value="High">High
                        </option>
                    </select></td>
            </tr>

            <tr>
                <td>Deadline : </td>
                <td><input type="date" name="deadline" value="<?php echo $deadline;?>"></td>
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
if(isset($_POST['submit'])) //  Name of the button will be used
{
    // echo 'Form submitted successfully';

    //Get the updated values from form
    $list_id = $_POST['list_id'];
    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_desc'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];
    // echo ($list_name);
    // echo ($list_desc);

    //Insert Query
    $sql3 = "UPDATE `tbl_tasks` SET `task_name`='$task_name',`task_desc`='$task_desc',`list_id`=$list_id,`task_priority`='$priority',`task_deadline`='$deadline' WHERE task_id = $task_id";
    // echo $sql3;

    //Execute Query
    if(mysqli_query($conn,$sql3))
    {
        // echo "Data updated successfully";
        
        //create a session variable to display message
        $_SESSION['update_success'] = "Task updated successfully";
        
        // Redirect to Home page
        header('Location:'.URL."/home.php");
    }
    else
    {
        // echo "Error!! Data not inserted!";

        //create a session variable for update-failed message
        $_SESSION['update_fail'] = "Failed to update Task!";

        //Redirect to manage-list page
        header("location:". URL."edit-task.php?list_id=".$list_id);
    // }
    
    }
}
?>