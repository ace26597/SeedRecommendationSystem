
<?php 

error_reporting(0);

if(isset($_POST['submit'])){//to run PHP script on submit
  $email_id=$_POST['email'];
  $name=$_POST['name'];
  $state=$_POST['source'];
  $district=$_POST['status'];
  $selected_val = $_POST['area'];
  $landip = $_POST['land'];
  $K=$_POST['K'];
  $N=$_POST['N'];
  $P=$_POST['P'];
  $ph=(float)$_POST['ph'];
  $EC=$_POST['EC'];
  $CaCo3=$_POST['CaCo3'];
  $Fe=$_POST['Fe'];
  $Mg=$_POST['Mg'];
  $Zn=$_POST['Zn'];
  $Cu=$_POST['Cu'];
  $opyield = 0;
  $month = '';
  
  if($K == 0)
  {
	$K=300;  
  }
    if($N == 0)
  {
	$N=300;  
  }
    if($P == 0)
  {
	$P=300;  
  }
    if($ph == 0)
  {
	$ph=14;  
  }
    if($EC == 0)
  {
	$EC=300;  
  }
    if($CaCo3 == 0)
  {
	$CaCo3=300;  
  }
    if($Fe == 0)
  {
	$Fe=300;  
  }
    if($Mg == 0)
  {
	$Mg=300;  
  }
    if($Zn == 0)
  {
	$Zn=300;  
  }
    if($Cu == 0)
  {
	$Cu=300;  
  }
  
  $Cup = $Cu * 1.1;
  $Cum = $Cu * 0.9;
  
  $Kp = $K * 1.1;
  $Km = $K * 0.9;
  
  $Np = $N * 1.1;
  $Nm = $N * 0.9;
  
  $Pp = $P * 1.1;
  $Pm = $P * 0.9;
  
  $php = $ph * 1.1;
  $phm = $ph * 0.9;
  
  $ECp = $EC * 1.1;
  $ECm = $EC * 0.9;
  
  $CaCo3p = $CaCo3 * 1.1;
  $CaCo3m = $CaCo3 * 0.9;
  
  $Fep = $Fe * 1.1;
  $Fem = $Fe * 0.9;
  
  $Znp = $Zn * 1.1;
  $Znm = $Zn * 0.9;
  
  $Mgp = $Mg * 1.1;
  $Mgm = $Mg * 0.9;
  
  /*
  print_r($Cum);
  print_r($Cup);
  print_r($Nm);
  print_r($Np);
  print_r($Km);
  print_r($Kp);
  print_r($Pm);
  print_r($Pp);
  print_r($phm);
  print_r($php);
  print_r($ECm);
  print_r($ECp);
  print_r($CaCo3m);
  print_r($CaCo3p);
  print_r($Fem);
  print_r($Fep);
  print_r($Znm);
  print_r($Znp);
  print_r($Mgm);
  print_r($Mgp);
  */

$file = fopen("seed.csv","r");
$A=fgetcsv($file);
$output=array();
$output_temp=array();
$output_yield=array();
$rainfall=array();
while(! feof($file))
{   
    $A=fgetcsv($file);
	if($A[0] !=""){
	//print_r($A);
	
	if((float)$A[2]<= $php && (float)$A[3]<=$ECp && (float)$A[4]<=$Np && (float)$A[5]<=$Pp && (float)$A[6]<=$Kp && (float)$A[7]<=$CaCo3p && (float)$A[8]<=$Fep && (float)$A[9]<=$Mgp && (float)$A[10]<=$Znp && (float)$A[11]<=$Cup && (float)$A[2]>= $phm && (float)$A[3]>=$ECm && (float)$A[4]>=$Nm && (float)$A[5]>=$Pm && (float)$A[6]>=$Km && (float)$A[7]>=$CaCo3m && (float)$A[8]>=$Fem && (float)$A[9]>=$Mgm && (float)$A[10]>=$Znm && (float)$A[11]>=$Cum)
	{
	 $output[$A[1]]=$A[0];
	 $output_temp[$A[1]]=$A[12];
	 $output_yield[$A[1]]=$A[13];
	 $rainfall[$A[1]]=$A[14];
	}	
	}
	
}
//print_r($rainfall);
//print_r($output);

$file = fopen("rainfall.csv","r");
$A=fgetcsv($file);
$rain_month=array();
while(! feof($file))
{   
    $A=fgetcsv($file);
	if($A[0] ==$state && $A[1]==$district){
	$i=1;
	while($i!=13)
	{ 
		$rain_month[$i]=$A[1+$i];
		$i+=1;
	}
//print_r($rain_month);
	}
	
}

$file = fopen("Temperature.csv","r");
$A=fgetcsv($file);
$temp_month=array();
while(! feof($file))
{   
    $A=fgetcsv($file);
	if($A[0] ==$state && $A[1]==$district){
	//print_r($A);
	//print($ph);
	$i=1;
	while($i!=13)
	{ 
		$temp_month[$i]=$A[1+$i];
		$i+=1;
	}

	}
	
}
//print_r($temp_month);
//print_r($rain_month);
  
function mon($x)
{
	if($x==1){return "January";}
	if($x==2){return "February";}
	if($x==3){return "March";}
	if($x==4){return "April";}
	if($x==5){return "May";}
	if($x==6){return "June";}
	if($x==7){return "July";}
	if($x==8){return "August";}
	if($x==9){return "September";}
	if($x==10){return "October";}
	if($x==11){return "November";}
	if($x==12){return "December";}
}
//print_r($output);

$month_output=array();
foreach($output_temp as $x => $x_value) {
	$month=array();
	for($j=1;$j<=12;$j++)
	{
		if($temp_month[$j]>= ($x_value-2.0) && $temp_month[$j]<= ($x_value+2.0))
		{
			array_push($month,mon($j));
		}
	}
	$month_output[$x]=$month;	
}
//print_r($month_output);
//print_r($rainfall);
//print_r($rain_month);
$rain_output=array();
foreach($rainfall as $x => $x_value) {
	$monthrain=array();
	for($j=1;$j<=12;$j++)
	{
		if($rain_month[$j]<= ($x_value+50) && $rain_month[$j]>= ($x_value-50))
		{
			array_push($monthrain,mon($j));
		}
	}
	$rain_output[$x]=$monthrain;	
}

//print_r($rain_output);
$month_result = array();

$month_result=array_intersect($rain_output,$month_output);
//print_r($month_result);
function month_echo($a)
{  $str ="";
	foreach($a as $x => $x_value)
	{
		$str.=$x_value.",";
	}
	return $str;
}
}
?>

<html>
<head>

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
  font-size: 25px;
   background-image: url("https://ak1.picdn.net/shutterstock/videos/9632771/thumb/2.jpg");
   background-repeat: no-repeat;
background-position: right top;

margin: 150px;
background-attachment: fixed;
color: white;
background-size:cover
}

</style>

</head>
<body>
<b>Please Select Language:
  <div id="google_translate_element"></div>

<br/><br/>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
  </script>

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<b>Hello <?php echo $name; ?>,<br><br>
Report sent to <?php echo $email_id;?><br>
Thank you for connecting to us from <?php echo $district;?> , <?php echo $state;?>.<br><br><br>
You can Look into following seeds to maximise your Yield<br>
<table>
<tr>
<td>SEED &nbsp &nbsp &nbsp</td><td>TYPE &nbsp &nbsp &nbsp</td><td>MONTHS &nbsp &nbsp &nbsp</td><td>EXPECTED YIELD(Tonnes)</td>
</tr>
<?php
foreach($month_result as $x =>$x_value)
{   if (count($x_value)!=0){
      if($selected_val == "Acre")
  {
      $opyield = $output_yield[$x] * $landip * 4046.526/ 1000;
  }
  if($selected_val == "Hectare")
  {
     $opyield = $output_yield[$x] * $landip * 10000/ 1000; 
  }
  if($selected_val == "Guntha")
  {
      $opyield = $output_yield[$x] * $landip *101.17/ 1000;
  }
  $month = month_echo($x_value);
	echo "<tr>";
	echo "<td>".$output[$x]."</td> &nbsp &nbsp &nbsp "."<td>".$x."</td> &nbsp &nbsp &nbsp "."<td>".month_echo($x_value)."</td> &nbsp &nbsp &nbsp  "."<td>".$opyield."</td> ";
	echo "</tr>";
	if($output[$x] == "Garlic")
{
    echo '<a href="garlic.html">Click here for more information about Garlic</a>';
}
if($output[$x] == "Tomato")
{
    echo '<a href="tomato.html">Click here for more information about Tomato</a>';
}
if($output[$x] == "Corn")
{
    echo '<a href="corn.html">Click here for more information about Corn</a>';
}
if($output[$x] == "Onion")
{
    echo '<a href="onion.html">Click here for more information about Onion</a>';
}
if($output[$x] == "potato")
{
    echo '<a href="potato.html">Click here for more information about Potato</a>';
}
if($output[$x] == "brinjal")
{
    echo '<a href="brinjal.html">Click here for more information about Brinjal</a>';
}
if($output[$x] == "Capsicum")
{
    echo '<a href="capsicum.html">Click here for more information about Capsicum</a>';
}
if($output[$x] == "bhendi")
{
    echo '<a href="bhendi.html">Click here for more information about Ladyfinger</a>';
}
if($output[$x] == "banana")
{
    echo '<a href="banana.html">Click here for more information about Ladyfinger</a>';
}
if($output[$x] == "cabbage")
{
    echo '<a href="cabbage.html">Click here for more information about Ladyfinger</a>';
}
if($output[$x] == "cardamom")
{
    echo '<a href="cardimum.html">Click here for more information about Ladyfinger</a>';
}

if($output[$x] == "carrot")
{
    echo '<a href="carrot.html">Click here for more information about Ladyfinger</a>';
}
if($output[$x] == "wheat")
{
    echo '<a href="wheat.html">Click here for more information about Ladyfinger</a>';
}
}
}
$to_email = $email_id;
$subject = 'Soil Report';
$message = "Hello '$name';
			Report sent to  '$email_id'
			Thank you for connecting to us from '$district', '$state'
			You can Look into following seeds to maximise your Yield
			
        	SEED 					'$output[$x]'
			TYPE 					'$x'
			MONTHS					'$month'
			EXPECTED YIELD(Tonnes)	'$opyield'
			";


$headers = 'From:noreply@rseedr.com';	
mail($to_email,$subject,$message,$headers);

?>
</table>
</body>
</html>