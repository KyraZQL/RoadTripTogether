<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk" />
    <title>New A Post</title>

    <link rel="stylesheet" href="materialize.css"/>
    <script src="js/libs/jquery.min.js" type="text/javascript"></script>
    <script src="materialize.js" type="text/javascript"></script>



</head>

<body>

    <div class="container">

    <form action="#" method="post">
        <div class="row">
            <div class="input-field col s6">
                    <label for="depature" class="label">Depature:</label>
                    <input id="depature" name="depature" type="text" class="input-field" method="get"/>
                    <!-- <input type="text" name="user_name" id="user_name" class="input-field"> -->
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" type="submit" name="ok_depature">OK</button>
            </div>
        </div>
    </form>
 
<?php
session_start();

include_once 'conn.php';
if (!isset($_SESSION['u_id'])) {
?>
    <script>
        alert('Please log in first!');
        window.location.href = "index.php";
    </script>
<?php
}

if (isset($_POST['ok_depature'])) {
    $got_place_input = $_POST['depature'];
    // echo $_POST['depature'];
    $sql_place = "SELECT * FROM places WHERE name LIKE '%$got_place_input%'";
    $result = mysqli_query($conn, $sql_place);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        // exit();
    }

    $placeResult = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // echo count($placeResult);
    $depature_placeid = '';
 
    echo '<form method="post">';
    $x = 0;

    // while ($arrayResult = mysql_fetch_array($place_result)) {
    foreach ($placeResult as $value) {
     
        echo $x;
        echo "alter_depature" . $x;
        echo '<button onclick="myFunction()" name="alter_depature' . $x .
        '" value="alter_depature' . $x .
        '">'  . $value['name'] . $value['address'] .' </button>';
        //<button onclick="myFunction()">Copy Text</button>
        echo '<p><label><input type="checkbox" name="alter_depature' . $x .
            '" value="alter_depature' . $x .
            '"/>   <span>' . $value['name'] . $value['address'] . '</span></label></p>';

        $x++;
    }
    echo ' <button class="btn waves-effect waves-light" type="submit" name="ok_depature_final">OK</button>';

    echo "</form>";
    // for ($i = 0; $i < $x; $i++) {
    // if (isset($_POST['ok_depature_final'])) {

        // if (isset($_POST['alter_depature0'])) {
            //         ob_end_clean();
            // ob_start();

            // echo "<h1>You choose ".$_POST['alter_depature0']."as your depature.</h1>";
        // }
    // }

}

?>
    <script>
        function myFunction() {
            alert('myFunction works!');

        }
    
    </script>

    <form action="" method="post">
        <div class="row">
            <div class="input-field col s6">
                <label for="destination" class="label">Destination:</label>
                <input id="destination" name="destination" type="text" class="input" method="get"/>
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" type="submit" name="ok_destination">OK</button>
            </div>
        </div>
    </form>


<?php
if (isset($_POST['ok_destination'])) {
    $got_place_input = $_POST['destination'];

    echo $_POST['destination'];
    // $sql_place = "SELECT * FROM places WHERE name LIKE *"+$_GET['destination']+"*";
    // $place_result = mysqli_query($sql_place, $conn);
    // $arrayResult = mysqli_fetch_array($place_result);

    // $destination_placeid = '';

    // while ($arrayResult = mysql_fetch_array($place_result)) {
    //     echo '<a action=chooseDestination">';
    //     echo $arrayResult['name'];
    //     echo '</a>';
    //     if ($_GET['action'] == "chooseDestination") {
    //         $destination_placeid = $arrayResult['id'];
    //         exit;
    //     }
    // }
}

?>



    <form action="" method="post">
        <!-- Depature Date: -->
        <div class="row">
            <div class="col s12">
                <label for="depature_date">Depature Date</label>
                <!-- </div> -->
                    <!-- <div class="input-field col s6"> -->
                <input id="depature_date" name="depature_date" type="date" class="input">

            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <label for="proposed_price" class="label">Price:</label>
                <input id="proposed_price" name="proposed_price" type="text" class="input"/>
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" type="submit" name="ok_price">OK</button>
            </div>
            <!-- </div> -->
        </div>
    </form>


<?php
if (isset($_POST['ok_price'])) {

    $depature_date = $_POST['depature_date'];
    $proposed_price = $_POST['proposed_price'];
}
?>


    <form method="post">
        <p>
            <label>
                <input type="checkbox" name="post_type" value="passenger"/>
                <span>I am a passenger.</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" name="post_type" value="driver"/>
                <span>I am a driver.</span>
            </label>
        </p>
        <!-- <input  class="filled-in" type="checkbox" name="post_type" value="passenger"> I am a passenger.<br>
        <input  class="filled-in" type="checkbox" name="post_type" value="driver"> I am a driver.<br> -->
        <button class="btn waves-effect waves-light" type="submit" name="ok_post_type">OK</button>
    </form>




<?php
$post_type = '';
if (isset($_POST['ok_post_type'])) {
    $post_type = $_POST['post_type'];
    if (!empty($_POST['post_type'])) {
        // Counting number of checked checkboxes.
        // $checked_count = count($_POST['check_list']);
        echo "You have selected following option: <br/>";
        // Loop to store and display values of individual checked checkbox.
        // foreach ($_POST['check_list'] as $selected) {
        //     echo "<p>" . $selected . "</p>";
        // }
        echo $post_type;
    } else {
        echo "<b>Please Select Atleast One Option.</b>";
    }
}
// echo "your post_type is";
// echo $post_type;
$get_valid_id = false;
$post_id = '';
while (!$get_valid_id) {
    $post_id = uniqid('post_'); //generate a random post id
    $sql_check_ppost_id = "SELECT * FROM passengerposts WHERE postID = '$post_id'";
    // $sql_check_dpost_id = "SELECT * FROM driverposts WHERE postID = '$post_id'";
    
    $same_id_p = mysqli_query($conn, $sql_check_ppost_id);
    // $same_id_d = mysqli_query($conn, $sql_check_dpost_id);

    if (!$same_id_p) {
        printf("Error: %s\n", mysqli_error($conn));
        // exit();
    }
    // if (!$same_id_d) {
    //     printf("Error: %s\n", mysqli_error($conn));
    //     // exit();
    // }
    $num_same_id = mysqli_num_rows($same_id_p) ;
    // +  mysqli_num_rows($same_id_d);
    if ($num_same_id == 0) {
        $get_valid_id = true;
    }
}
echo '<br/>';
echo "this post id is:";
echo $post_id;
$user_id = $_SESSION['u_id'];
if ($post_type == 'passenger') {
?>

    <form method="post">
        Number of passengers:
        <input type="number" name="passenger_num" min="1" max="100" step="1" value="1">
        Number of luggages:
        <input type="number" name="luggage_num" min="0" max="100" step="1" value="0">
        <button class="btn waves-effect waves-light" type="submit" name="ok_passenger_info">OK</button>
	</form>


<?php
if (isset($_POST['ok_passenger_info'])) {
        $passenger_num = $_POST['passenger_num'];
        $luggage_num = $_POST['luggage_num'];
        // $sql_insert_post = "INSERT INTO PassengerPosts
        // (postID, date, proposedPrice, availability, startPlaceID, endPlaceID, userID, luggageNum, passengerNum)
        // VALUES ($post_id, $depature_date, $proposed_price, TRUE, $depature_placeid, $destination_placeid, $user_id, $passenger_num, $luggage_num)";
    }
} else { //this is a driver post.
?>

	<form method="post">
        <div class="row">
            <div class="input-field col s6">
                <label for="car_type" class="label">Your car type:</label>
                <input id="car_type" name="car_type" type="text" class="input" />
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" type="submit" name="ok_car_type">OK</button>
            </div>
        </div>

    </form>



<?php
    if (isset($_POST['ok_car_type'])) {
        $car_type = $_POST['car_type'];

        // $sql_insert_post = "INSERT INTO DriverPosts
        // (postID, date, proposedPrice, availability, startPlaceID, endPlaceID, userID, carType)
        // VALUES ($post_id, $depature_date, $proposed_price, TRUE, $depature_placeid, $destination_placeid, $user_id, $car_type)";
    }
}
?>

	<p>
		<input class="btn waves-effect waves-light" type="submit" name="submit_post" value="submit_post"/>
	</p>

<?php
// if ($_POST['submit_post']) {
//     mysql_query( $sql_insert_post, $conn);
// }
echo "Your post has been submitted!";
?>

    </div>
</body>

<!-- <script type="text/javascript" src="materialize.js"></script>
<script language=JavaScript>
        console.log("reach javascript.");
        var limit = 1;
        $('input.single-checkbox').on('change', function(evt) {
            if($(this).siblings(':checked').length >= limit) {
                this.checked = false;
            }
        });
    </script>

    <script language=JavaScript>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function(){
            $('select').formSelect();
        });
    </script> -->


</html>
