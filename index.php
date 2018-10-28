<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		input[type=number]{
			width: 3em;
			height: 3em;
			text-align: center
		}
		td{
			text-align: center;
		}
	</style>
</head>
<body>
	<?
	session_start();
	if(isset($_SESSION['numeros'])){
		$nums = $_SESSION['numeros'];
	}else{
		$nums = [];
		for($i=0;$i<11;$i++){
			$control = false;
			while($control == false){

				$fila = rand(0,8);
				$col = rand(0,8);
				$val = rand(1,9);
			
				if(checkRow($fila, $val) && checkCol($col,$val)){
					$num = array("fila" => $fila, "col" => $col, "value" => $val);
					$nums[] = $num;
					$control = true;				
				}
			}
		}
		$_SESSION['numeros'] = $nums;
	}

	$positions = [];


	?><h1>El Sudoku</h1>
	<form>
	<table cellpadding="0" cellspacing="0"><?
	$c = 1;
	for($i=0;$i<=8;$i++){
		?><tr><?
			for($e=0;$e<=8;$e++){
				?><td style="border: 1px solid black"><?
					$value = comprobar($i,$e);
					if($value){
						echo $value;
						$positions[] = $value;
					}
					else{
						?><input type="number" name="<?=$c?>" class="vertical"><?
						$positions[] = null;
					}

				?></td><?
			}
		?></tr><?
	}

	//Función para comprobar si fila y columna coinciden en algún lugar del array y si coincide devuelva el valor correspondiente
	function comprobar($x,$y){
		global $nums;
		foreach($nums as $number){
			if($number['fila'] == $x && $number['col'] == $y){
				return $number['value'];
			}
		}
		return false;
	}

	//Fórmula que controla que no haya números repetidos en una misma columna
	function checkRow($row, $val){
		global $nums;
		if(!(empty($nums))){
			for($i=0;$i<count($nums);$i++){
				if($nums[$i]['fila'] == $row && $nums[$i]['value'] == $val){
					return false;						
				}
			}
			return true;
		}else{
			return true;
		}
	}

	function checkCol($col, $val){
		global $nums;
		if(!(empty($nums))){
			for($i=0;$i<count($nums);$i++){
				if($nums[$i]['col'] == $col && $nums[$i]['value'] == $val){
					return false;						
				}
			}
			return true;
		}else{
			return true;
		}
	}

	?>
	</table>
	</form>
	<br>
	<a href="logout.php"><button>Reiniciar sudoku</button></a>
</body>
</html>