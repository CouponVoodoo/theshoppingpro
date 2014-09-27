<?php

        $DB->select_db('coupon_finder');
        $results = $DB->query('SHOW TABLE STATUS WHERE Data_free > 0');
        if ($results->num_rows > 0)
        {echo 'num of rows '.num_rows;
            while ($row = $results->fetch_assoc())
            {  echo 'start '.$row['Name'];
			$DB->query('repair table ' . $row['Name']);
			 echo 'repair '.$row['Name'];
                $DB->query('optimize table ' . $row['Name']);
				 echo 'optimize '.$row['Name'];
            }
        }
        $results->close();

$DB->close();
}