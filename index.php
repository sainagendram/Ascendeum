<style>
.red-7{
    color: #F00;
}
.center{
    margin: 0 auto;
    text-align: center;
    width: 500px;
    height: 45px;
}
.common_back{
    background: #000;
    width: 100px;
    height: 30px;
    border-radius: 5px;
}

</style>


<?php 

$user_balance = 100;
$bet_amount = 10;

session_start();

if(!isset($_SESSION['user_balance'])){
    $_SESSION['user_balance'] = 100;
}



echo "<h1 align='center'> Welcome to Lucky <span class='red-7'>7</span> Game </h1>";
echo "<h3 align='center'>Place Your bet (Rs <span class='red-7'> 10</span>)</h3>";

?>
<form name='game' method='post' action="test.php" >
<div class='center' >
    <input type='submit' class='below-7 common_back red-7' name='below-7' value='[Below 7]' />
    <input type='submit' name='lucky-7' class='below-7 common_back red-7' value="[Lucky 7]" />
    <input type='submit' class='above-7 red-7 common_back' name='above-7' value="[Above 7]" />
    <input type='submit' class='play red-7 common_back' name='play' value="[Play]" />

    <input type='submit' class='common_back red-7' name='reset' value='[Reset]' />
    <input type='submit' name='continue' class='common_back red-7' value="[Continue Playing]" />
</div>
</form>


<div class="center" >
<?php
$dice1 = $dice2 = $total = $winning_amount = $new_updated_balance = 0;
$message = '';
$bet_amount = 10;
if(isset($_POST['below-7']) ){

    $dice1 = rand(1,10);
    $dice2 = rand(1,10);
    $total = $dice1+$dice2;

    if($total<7){
       
        $message = "Congratulation You won the game!";
        $new_updated_balance = updateWinnings(20,'win',$_SESSION['user_balance']);
    }
    else{
        $new_updated_balance = updateWinnings(10,'lost',$_SESSION['user_balance']);
    }

} else if(isset($_POST['lucky-7']) ){

    $dice1 = rand(1,10);
    $dice2 = rand(1,10);
    $total = $dice1+$dice2;

    if($total==7){
        $message = "Congratulation You won Lucky 7 game!";
        $new_updated_balance = updateWinnings(30,'win',$_SESSION['user_balance']);
    }
    else{
        $new_updated_balance = updateWinnings(10,'lost',$_SESSION['user_balance']);
    }

} else if(isset($_POST['above-7']) ){
    
    $dice1 = rand(1,10);
    $dice2 = rand(1,10);
    $total = $dice1+$dice2;

    if($total>7){
        $message = "Congratulation You won Lucky 7 game!";
        $new_updated_balance = updateWinnings(20,'win',$_SESSION['user_balance']);
    }
    else{
        $new_updated_balance = updateWinnings(10,'lost',$_SESSION['user_balance']);
    }

} else if(isset($_POST['play']) ){
    $new_updated_balance = $_SESSION['user_balance'];
}
else if(isset($_POST['reset']) ){
    session_destroy();
    session_start();
    $_SESSION['user_balance'] = 100; //reset to start
    $message = 'Balance Has been updated';
    $dice1 = $dice2 = $total = 0;
    $new_updated_balance = 100;
}
else if(isset($_POST['continue']) ){
    $new_updated_balance = $_SESSION['user_balance'];
}

echo "<h4>Game Results</h4>";
echo "<h2>$message</h2>";
echo "<p>Dice 1 Number $dice1 </p>";
echo "<p>Dice 2 Number $dice2 </p>";
echo "<p>Total Amount $total </p>";
echo "<p>Available Balance in your account is : ".$new_updated_balance." </p> ";

function updateWinnings($winning,$condition,$sess_bal){
    $new_amount = 0;
   // echo  "Before Logic ".$sess_bal;
    if($condition == 'lost'){
        $new_balance =  $sess_bal - $winning;
        $new_amount = $new_balance;
        $_SESSION['user_balance'] = $new_amount;
    }
    else{
        $sess_bal = $sess_bal - 10; //remove the betting amount 
        $new_balance = $sess_bal + $winning;
        $new_amount = $new_balance;
        $_SESSION['user_balance'] = $new_amount;
    }

    //echo  "After Logic ".$_SESSION['user_balance'];
    return $new_amount;
}
?>
</div>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<div class='center' >
   
</div>
