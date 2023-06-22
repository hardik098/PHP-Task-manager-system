<?php
    // echo "Delete-list page";
    include('configure/constants.php');

    //Check whether list_id is assigned or not
    if(isset($_GET['list_id']))
    {
        //Delete list from Database
        $list_id = $_GET['list_id'];
        $sql = "DELETE FROM `tbl_lists` WHERE list_id = $list_id";
        // echo $sql; //To Check query is right or not

        if(mysqli_query($conn,$sql))
        {
            //Create session to display messahe
            $_SESSION["delete"]="List Deleted Successfully!";

            //Redirect to manage-list page
            header("Location: ".URL."manage-lists.php?success=2");
        }
        else
        {
            //Create session to display message
            $_SESSION["delete_fail"]="Error in Deleting List! Please try again.";

            //Redirect to manage-list page
            header("Location: ".URL."manage-lists.php?error=1");
        }

    }
    else
    {
        //Redirect to manage-list page
        header("Location: ".URL."manage-lists.php");
    }

?>