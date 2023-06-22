<?php
include('configure/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS Manage-lists</title>
    <link rel="stylesheet" href="<?php echo URL;?>styles.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo URL?>/home.php">Home</a>
    <h3>Manage Lists</h3>
    <p style="color:green; font-weight:bold">
        <?php
            //Check whether Add session is created or not
            if(isset($_SESSION['add']))
            {
                //Display Session Message
                echo ($_SESSION['add']);

                 //Remove the message after display
                 unset($_SESSION['add']);
            }
            
            //Check whether Delete session is created or not
            if(isset($_SESSION['delete']))
            {
                //Display Session Message
                echo ($_SESSION['delete']);

                 //Remove the message after display
                 unset($_SESSION['delete']);
            }

            //Check for delete fail
            if(isset($_SESSION['delete_fail']))
            {
                //Display Session Message
                echo ($_SESSION['delete_fail']);

                 //Remove the message after display
                 unset($_SESSION['delete_fail']);
            }

            //Check whether update-session is created or not
            if(isset($_SESSION['update_success']))
            {
                //Display Session Message
                echo ($_SESSION['update_success']);

                 //Remove the message after display
                 unset($_SESSION['update_success']);
            }
        ?>
    </p>
    <div class="all-lists">
        <table class="tbl-content">
            <tr>
                <th>LIST NO.</th>
                <th>LIST NAME</th>
                <th>ACTION</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_lists";
                $res = mysqli_query($conn,$sql);
                if($res==TRUE)
                {
                    // echo "Query Executed";

                    //Count no. of rows
                    $count_rows = mysqli_num_rows($res);
                    // echo($count_rows);

                    //Create a variable to display sr. no. properly
                    $sr = 1;

                    //Check wether data is available or not
                    if($count_rows>0)
                    {
                        //echo Data available

                        //Get data from database
                        while($data=mysqli_fetch_assoc($res))
                        {
                            $list_id = $data['list_id'];
                            $list_name = $data['list_name'];
                            $list_desc = $data['list_desc'];
                            ?>

                            <tr>
                                <td><?php echo $sr++;?></td>
                                <td><?php echo $list_name;?></td>
                                <td>
                                    <a href="<?php echo URL;?>edit_list.php?list_id=<?php echo $list_id;?>">Edit</a>
                                    <a href="<?php echo URL;?>delete-list.php?list_id=<?php echo $list_id;?>">Delete</a>
                                </td>
                            </tr> 

                            <?php
                        }
                    }
                    else
                    {
                        //No data available
                        ?>
                        <tr>
                            <td colspan="3">No Lists Added Yet!!</td>
                        </tr>
                        <?php
                    }
                }
            ?> 
        </table>
        <button class="btn-link"><a class="link-primary" href="add-list.php">Add List</a></button>
    </div>
    </div>
</body>
</html>