<?php $dateObj   = DateTime::createFromFormat('!m', date("m"));
				$monthName = $dateObj->format('F'); // March
        echo date("d")."-".$monthName;
        ?>