 <?php
 
$url = 'http://www.cs.washington.edu/research/xmldatasets/data/courses/reed.xml';
$str = file_get_contents($url);
$xml = simplexml_load_string($str);

$subjs = array();
foreach( $xml->xpath('course/subj') as $e ) {
	//$e['attrname']
	$subjs[] = (string)$e;
}
sort($subjs);
$subjs = array_unique( $subjs );

foreach( $xml->xpath('course/subj[text()]') as $e ) {
	$subjs[$e] = 1;
}
$subjs = array_keys( $subjs );
sort($subjs);
?>
<html>
<body>
<table>
	<?php foreach( $subjs as $s ) { echo '<a href="?subj='.$s.'">'.$s.'</a> | '; } ?>
<tr>
  <th>Numer</th><th>Nazwa</th><th>Czas</th>
</tr>
<tr>
  <th colspan="3">Opis</th>
</tr>
<?php foreach( $xml->course as $course ) { ?>
	<?php if( !empty($_GET['subj']) && $_GET['subj'] != $course->subj ) { continue; } ?>
<tr>
  <td><?php echo $course->reg_num; ?></td>
  <td><?php echo $course->subj; ?></td>
  <td><?php echo $course->time->start_time; ?> - <?php echo $course->time->end_time; ?></td>
</tr>
<tr>
  <td colspan="3"><?php echo $course->title; ?></td>
</tr>
<?php } ?>

</body>
</html>