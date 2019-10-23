<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" href="style_valid.css">
	<title>Валидатор</title>
</head>
<body>
	<?php
		function validate($mas){
			$invalid = 'bad';
			$valid = 'gut';
			$c = strlen($mas);
			$stack = array();
			for($i = 0; $i < $c; $i++){
				if(($mas[$i] == '{') || ($mas[$i] == '(') || ($mas[$i] == '[') || ($mas[$i] == '<')){
				array_push($stack, $mas[$i]);
				}
				switch ($mas[$i]){
					case '}':
						$x = array_pop($stack);
						if($x !== '{')
						return $invalid;
						else continue;
					case ')':
						$x = array_pop($stack);
						if($x !== '(')
						return $invalid;
						else continue;
					case ']':
						$x = array_pop($stack);
						if($x !== '[')
						return $invalid;
						else continue;
					case '>':
						$x = array_pop($stack);
						if($x !== '<')
						return $invalid;
						else continue;		
				}
			}
			if($stack != NULL) return $invalid;
			else return $valid;
		}
		
		function check($exp, $res){
			if(validate($exp) == $res) echo '<td style = "background-color: #7FFF00;">'.$exp.' '.$res;
			else{
				echo '<td style = "background-color: #A52A2A;">'.$exp.' '.$res;
			}
		}
	?>
	<hr>
	<table>
		<tr>
			<?php check('{}', 'gut');
				  check('()', 'gut');
				  check('[]', 'gut');
				  check('<>', 'gut');
				  check('{{}', 'bad');
			?>
		</tr>
		<tr>
			<?php check('(()', 'bad');
				  check('[[]', 'bad');
				  check('<<>', 'bad');
				  check('{}}', 'bad');
				  check('())', 'bad');
			?>
		</tr>
		<tr>
			<?php check('[]]', 'bad');
				  check('<>>', 'bad');
				  check('}{', 'bad');
				  check(')(', 'bad');
				  check('][', 'bad');
			?>
		</tr>
		<tr>
			<?php check('><', 'bad');
				  check('(}', 'bad');
				  check('(]', 'bad');
				  check('(>', 'bad');
				  check('{)', 'bad');
			?>
		</tr>
		<tr>
			<?php check('{]', 'bad');
				  check('{>', 'bad');
				  check('[)', 'bad');
				  check('[}', 'bad');
				  check('[>', 'bad');
			?>
		</tr>
		<tr>
			<?php check('<)', 'bad');
				  check('<}', 'bad');
				  check('<]', 'bad');
				  check('({[<>]})', 'gut');
				  check('<>{}()[]', 'gut');
			?>
		</tr>
		<tr>
			<?php check('(<>{}()[])', 'gut');
				  check('', 'gut');
			?>
		</tr>
	</table>
	<hr>	
</body>
</html>