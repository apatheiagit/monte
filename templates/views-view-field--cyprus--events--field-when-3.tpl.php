<?php 
global $language;
$monthAr = array(
    1 => 'Январь',
    2 => 'Февраль',
    3 => 'Март',
    4 => 'Апрель',
    5 => 'Май', 
    6 => 'Июнь',
    7 => 'Июль',
    8 => 'Август',
    9 => 'Сентябрь', 
    10=> 'Октябрь', 
    11=> 'Ноябрь', 
    12=> 'Декабрь'
  );
if ($language->language == 'ru') {
  print $monthAr[date('n', strtotime($row->field_field_when[0]['raw']['value']))];
}
else {
  print date('F', strtotime($row->field_field_when[0]['raw']['value']));
}
?>
