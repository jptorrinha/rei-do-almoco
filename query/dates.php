<?php
	//dates and times
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('Y-m-d');

  $horaStart = strtotime("08:00:00");
  $horaEnd = strtotime("12:01:00");
  $horaShow = strtotime("12:02:00");
  $time = strtotime('now');
  //end dates and times