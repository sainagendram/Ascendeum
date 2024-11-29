

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >

Please Input the Grid Number <input type="text" name="number_of_grids" required />

<input type="submit" name='submit'>
</form>

<?php
include_once('board.php');
include_once('game.php');
include_once('players.php');

$size = 0;

if(isset($_POST['submit'])){

    if(isset($_POST['number_of_grids'])){

        $table = $tr = $td = '';
        $total_grid = $size = $_POST['number_of_grids'];
        // echo $table .= "<table border=1>";
        // echo $table2 = "<table border=1><tr> <th>Player No</th> <th>Dice Roll History</th> <th>Position History</th> <th>Player No</th></tr>";

        // for ($i=0; $i <$total_grid ; $i++) { 
            
        //    echo $tr ="<tr>";

        //    for ($j=0; $j <$total_grid  ; $j++) { 
        //         echo $td ='<td style="width: 50px; height: 50px">';
        //         echo $td ='</td>';
        //    }
           
        //    echo $tr ="</tr>";

        // }

        // for ($i=0; $i <$total_grid ; $i++) { 
            
        //     echo $tr ="<tr>";
 
        //     for ($j=0; $j <$total_grid  ; $j++) { 
        //          echo $td ='<td>';
        //          echo $td ='</td>';
        //     }
            
        //     echo $tr ="</tr>";
 
        //  }

        // echo $table2_close = "</table>";
        // echo $table_close = "</table>";

    }
}

$snakeLadders = [1=>3,4=>2,5=>2,6=>8,3=>6];
$size = $size * $size;
$board = new Board($size,$snakeLadders);
$players = ['Player 1','Player 2','Player 3'];

$game = new Game($board,$players);
$results = $game->Play();
$new_array = [];

if(!empty($results)){
    
    echo "<table border=1><tr> <th>Player</th> <th>Dice Roll History</th> <th>Position History</th> <th>Winner Status</th></tr>";

        $winner = [];
        $player1_dice = $p1_pos = $p2_pos = $p3_pos = $player2_dice = $player3_dice = '';
        foreach ($results as $key1 => $value1) {
           
            foreach ($value1 as $key2 => $value2) {

                if($value1['player']  == 'Player 1' && $key2 == 'dice'){
                    $player1_dice .=$value2.",";
                }
                if($value1['player'] == 'Player 2' && $key2 == 'dice'){
                    $player2_dice .=$value2.",";
                }
                if($value1['player'] == 'Player 3' && $key2 == 'dice'){
                    $player3_dice .=$value2.",";
                }

                if($value1['player']  == 'Player 1' && $key2 == 'position_history'){
                    $p1_pos .=$value2.",";
                }
                if($value1['player']  == 'Player 2' && $key2 == 'position_history'){
                    $p2_pos .=$value2.",";
                }
                if($value1['player'] == 'Player 3' && $key2 == 'position_history'){
                    $p3_pos .=$value2.",";
                }

                if($key2 == 'winner' && $value2 ){
                    $winner = $value1;
                }
            }        
        }

       $player1_dice = trim($player1_dice,',');
       $p1_pos = trim($p1_pos,',');
       $player2_dice = trim($player2_dice,',');
       $player3_dice = trim($player3_dice,',');
       $p3_pos = trim($p3_pos,',');
       $p2_pos = trim($p2_pos,',');
         
        foreach ($players as $key => $value) {

            echo "<tr>";
            echo "<td> $value </td>";

            if($value == 'Player 1'){
                echo "<td> $player1_dice </td>";
                echo "<td> $p1_pos </td>";
                
                if(!empty($winner) && $winner['player'] == 'Player 1'){
                    echo "<td> Winner  </td>";
                }
                else{
                    echo "<td>   </td>";
                }
               
               
            }
            if($value == 'Player 2' ){
                echo "<td> $player2_dice </td>";
                echo "<td> $p2_pos </td>";

                if(!empty($winner) && $winner['player'] == 'Player 2'){
                    echo "<td> Winner  </td>";
                }
                else{
                    echo "<td>   </td>";
                }
            }
            if($value == 'Player 3' ){
                echo "<td> $player3_dice </td>";
                echo "<td> $p3_pos </td>";

                if(!empty($winner) && $winner['player'] == 'Player 3'){
                    echo "<td> Winner  </td>";
                }
                else{
                    echo "<td>   </td>";
                }
            }
            
            
            echo  "</tr>";
            
        }

       
  
    echo "</table>";
}


?>


