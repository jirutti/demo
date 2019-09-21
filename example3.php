<?php Function example3($number){ //000488
	$two_number = substr($number,4,2); // 88
	$number_winner = array(‘000088’,’000188’,’000288’,’000388’,’000488’,’000588’);
	Foreach($number_winner as $twonumber_win){
		If($twonumber_win == $two_number){
			retune ‘winning;
			break;
		}
	}
}
 ?>
