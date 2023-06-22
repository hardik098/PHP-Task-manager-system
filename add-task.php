<?php
    include('configure/constants.php');
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS Add-Task</title>
    <link rel="stylesheet" href="<?php echo URL;?>styles.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo URL?>/home.php">Home</a>
    <h3>Add New Task Here</h3>
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
        ?>
    </p>
    <form action="" method="post">
    <table class="tbl-form">
            <tr>
                <td>Task Name : </td>
                <td><input type="text" name="task_name" id="" required></td>
            </tr>

            <tr>
                <td>Task Description :</td>
                <td><textarea name="task_desc" id="" cols="30" rows=""></textarea></td>
            </tr>

            <tr>
                <td>Select List : </td>
                <td>
                    <select name="list_id" id="">
                        <?php 
                            //Query to get all lists from table
                            $sql = "SELECT * FROM tbl_lists";

                            $res = mysqli_query($conn,$sql);
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
                                        $list_id = $row['list_id'];
                                        $list_name = $row['list_name'];
                                        ?>
                                        <option value="<?php echo $list_id;?>"><?php echo $list_name;?></option>
                                        <?php
                                    } 
                                    
                                }
                                else
                                {
                                    //Display none
                                    ?>
                                    <option selected disabled hidden>No Lists Found!</option>
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
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select></td>
            </tr>

            <tr>
                <td>Deadline : </td>
                <td><input type="date" name="deadline" id=""></td>
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

    //Get all filled data to insert in database
    $task_name=$_POST['task_name'];
    $task_desc=$_POST['task_desc'];
    $priority=$_POST['priority'];
    $list_id=$_POST['list_id'];
    $deadline=$_POST['deadline'];
    // echo ($list_id);
    // echo ($task_desc);

    //Insert Query
    $sql2 = "INSERT INTO `tbl_tasks`(`task_name`, `task_desc`, `list_id`, `task_priority`, `task_deadline`) VALUES ('$task_name','$task_desc',$list_id,'$priority','$deadline')";
    // echo $sql2;

    //Execute Query
    if(mysqli_query($conn,$sql2))
    {
        // echo "Data inserted successfully";
        
        //create a session variable to display message
        $_SESSION['add'] = "Task added succsessfully";
        
        //Redirect to home page
        header("location: ". URL."/home.php");
        
    }
    else
    {
        // echo "Error!!";

        //create a session variable to save messae
        $_SESSION['add_fail'] = "Error!!";

        //Redirect to add-task page
        header('Location :'.URL.'add-task.php');
    }
    
}

/*else
{
    echo 'Form not submitted';
}*/

?>