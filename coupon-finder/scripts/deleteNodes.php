<?php
$DB = new mysqli ('localhost', 'predictor', '123theshoppingpro098');
        $DB->select_db('coupon_finder');
        $results = $DB->query('SHOW TABLE STATUS WHERE Data_free > 0');
        if ($results->num_rows > 0)
        {echo 'num of rows '.$results->num_rows;
            while ($row = $results->fetch_assoc())
            {  echo 'start '.$row['Name'];
			
                $DB->query("ALTER TABLE " . $row['Name']. " ENGINE='InnoDB'");
				 echo 'optimize ';
				 echo '--------------------------------------------';
            }
        }
        $results->close();

$DB->close();
/*SELECT TABLE_SCHEMA, TABLE_NAME, CONCAT(ROUND(data_length / ( 1024 * 1024 ), 2), 'MB') DATA, CONCAT(ROUND(data_free  / ( 1024 * 1024 ), 2), 'MB')FREE from information_schema.TABLES where TABLE_SCHEMA NOT IN ('information_schema','mysql') and Data_free >0;*/