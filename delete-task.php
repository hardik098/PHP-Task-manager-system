<?php
    // echo "Delete-task page";
    include('configure/constants.php');

    //Check whether task_id is getted through url or not
    if(isset($_GET['task_id']))
    {
        //Delete task from Database

        //Get task_id
        $task_id = $_GET['task_id'];

        $sql = "DELETE FROM `tbl_tasks` WHERE task_id = $task_id";
        // echo $sql; //To Check query is right or not

        if(mysqli_query($conn,$sql))
        {
            //Create session to display messahe
            $_SESSION["delete"]="Task Deleted Successfully!";

            //Redirect to home page
            header("Location: ".URL);
        }
        else
        {
            //Create session to display message
            $_SESSION["delete_fail"]="Error in Deleting Task! Please try again.";

            //Redirect to home page
            header("Location: ".URL."/home.php");
        }

    }
    else
    {
        //Redirect to Home page
        header("Location: ".URL."/home.php");
    }

?>