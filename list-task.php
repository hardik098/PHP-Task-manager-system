<?php
    include('configure/constants.php'); 
    //Check whether list_id is passed or not.
    if(isset($_GET["list_id"]))
    {
        $list_id_url = $_GET['list_id'];
        
    }
    else
    {
        //Redirect to Home page
        header("Location: ".URL);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS List-Task</title>
    <link rel="stylesheet" href="<?php echo URL;?>styles.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <div class="menu">
        <a href="<?php echo URL?>/home.php">Home</a>
        <?php
            //Display lists from database here as menu

            //Query to get lists from database
            $sql2 = "SELECT * FROM tbl_lists";

            //execute the query
            $result = mysqli_query($conn, $sql2);

            //check query executed or not
            if($result==true)
            {
                //Display the lists in menu
                while ($row=mysqli_fetch_assoc($result))
                {
                    $list_id = $row['list_id'];
                    $list_name = $row['list_name'];
                    
                    ?>
                        <a href="<?php echo URL;?>list-task.php?list_id=<?php echo $list_id?>"><?php echo $list_name;?></a>
                        
                    <?php
                }
            }
        ?>
        <a href="<?php echo URL?>manage-lists.php">Manage Lists</a> <!--it is best practise to give full url link in every page-->
    </div>

    <div class="add-task">
        <table class="tbl-content">
            <tr>
                <th>TASK NO.</th>
                <th>TASK NAME</th>
                <th>PRIORITY</th>
                <th>DEADLINE</th>
                <th>ACTION</th>
            </tr>

            <?php
                //Sql to get all data
                $sql = "SELECT * FROM tbl_tasks WHERE list_id = $list_id_url";

                //Execute sql query
                $result = mysqli_query($conn, $sql);

                if($result==true)
                {
                    //Count rows first
                    $conut_rows = mysqli_num_rows($result);

                    if($conut_rows>0)
                    {
                        //Display tasks for a selected list
                        //Create a variablr to display task no. properly
                        $sn = 1;

                        //Get all data
                        while ($row=mysqli_fetch_assoc($result))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['task_priority'];
                            $deadline = $row['task_deadline'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $task_name;?></td>
                                    <td><?php echo $priority;?></td>
                                    <td><?php echo $deadline;?></td>
                                    <td>
                                        <a href="<?php echo URL;?>edit-task.php?task_id=<?php echo $task_id;?>">Edit</a>
                                        <a href="<?php echo URL;?>delete-task.php?task_id=<?php echo $task_id;?>">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //No data found
                        ?>
                        <tr>
                            <td colspan="5">No Task Added On This List!!</td>
                        </tr>
                        <?php
                    }
                }
            ?>

            <!-- <tr>
                <td>1</td>
                <td>xxxx</td>
                <td>High</td>
                <td>22-07-2023</td>
                <td>Edit Delete</td>
            </tr> -->
        </table>
        <button class="btn-link"><a class="link-primary" href="<?php echo URL?>add-task.php">Add Task</a></button>
    </div>
    </div>
</body>
</html>