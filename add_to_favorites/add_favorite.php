<?php
function get_current_user_id() {
	if ( ! function_exists( 'wp_get_current_user' ) ) {
		return 0;
	}
	$user = wp_get_current_user();
	return ( isset( $user->ID ) ? (int) $user->ID : 0 );
}

session_start();
include('connection.php');

if(isset($_POST['add_to_favorite']))
{
    $eventid = (int)$_POST['eventid'];
    $userid = get_current_user_id();


    $query = "INSERT INTO favorites (eventid, userid)
    VALUES (:eventid, :userid)";
    $query_run = $conn->prepare($query);

    $data = [
        ':eventid' => $eventid,
        ':userid' => $userid,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: add_favorite.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header('Location: add_favorite.php');
        exit(0);
    }
}

if(isset($_POST['remove_from_favorite']))
{
    $eventid = (int)$_POST['eventid'];
    $userid = (int)$_POST['userid'];


    $query = "DELETE FROM favorites WHERE eventid = :eventid AND userid = :userid";

    $query_run = $conn->prepare($query);

    $data = [
        ':eventid' => $eventid,
        ':userid' => $userid,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Removed Successfully";
        header('Location: add_favorite.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header('Location: add_favorite.php');
        exit(0);
    }
}
?>

