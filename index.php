<?php
$file = fopen("Temperature.csv","r");
$A=fgetcsv($file);
$state_name=array();
while(! feof($file))
{
  $A=fgetcsv($file);
  if(strcmp($A[0],"")!=0)
  {
      if (!(in_array($A[0], $state_name))){
      array_push($state_name,$A[0]);
    }
  }
}

fclose($file);
?>



<html>
<head>
<style>
body {
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
  font-size: 25px;
   background-image: url("https://ak1.picdn.net/shutterstock/videos/9632771/thumb/2.jpg");
   background-repeat: no-repeat;
background-position: right top;

margin: 400px;
background-attachment: fixed;
color: white;
background-size:cover
}

</style>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript">
function dynamicdropdown(listindex)
{
    switch (listindex)
    {
    <?php
           foreach ($state_name as $value)
           { $count1=0;

             echo "\ncase \"".$value."\" :";
             echo "\ndocument.getElementById(\"status\").options[0]=new Option(\"District\",\"\");";
             $file = fopen("Temperature.csv","r");
             $A=fgetcsv($file);
             while(! feof($file))
             {

               $A=fgetcsv($file);
               if(strcmp($A[0],"")!=0)
               {
                 if(strcmp($A[0],$value)==0){
                   $count1+=1;
                 echo "\ndocument.getElementById(\"status\").options[".$count1."]=new Option(\"".$A[1]."\",\"".$A[1]."\");";
               }
               }
             }
            echo "\nbreak;";
            fclose($file);

           }
    ?>

    }
    return true;
}
</script>
</head>
<title>State select:</title>
<body>
    <b>Please Select Language:</br>
  <div id="google_translate_element"></div>

<br/><br/>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
  </script>

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <form action = "select1.php" method = "post" >
  <table>
<tr><td><b>Name  </td><td></b><input type="text" name = "name"/required></td></tr>
<tr><td><b>Email ID  </td><td></b><input type="text" name = "email"/required></td></tr>
<tr><td><b>Total Land  </td><td></b>
<select name="area"required>
  <option value="Acre">Acre</option> 		<!--4046.526-->
  <option value="Hectare">Hectare</option>	<!--10000-->			
  <option value="Guntha">Guntha</option>	<!--101.17-->
</select>
<input type="text" name = "land"/required></td></tr>
<br/>
<tr><td><b>State and District:</b></td>
    <td><select id="source" name="source" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);"required>
    <option value="">State</option>
    <?php
      foreach ($state_name as $value)
      {
        echo "\n<option value=\"".$value."\">".$value."</option>";
      }
    ?>

    </select><script type="text/javascript" language="JavaScript">
    document.write('<select name="status" id="status"><option value="">District</option></select>')
    </script></td>
  </tr>
    <br><br></table>
	<br>
	<br>
	<table>
  <b>Please enter the values of your soil report :</b><br>
    <tr><td><b>ph  </td><td></b><input type="number" name = "ph" step="0.1" min="0" max="14"value="0"><br/></td></tr>
    <tr><td><b>Electrical Conductivity  </td><td></b><input type="number" name = "EC" step="0.01" min="0" max="3"value="0"><br/></td></tr>
    <tr><td><b>Nitrogen  </td><td></b><input type="number" name = "N" step="0.1" min="0" max="800" value="0"><br/></td></tr>
    <tr><td><b>Phosphorus  </td><td></b><input type="number" name = "P" step="0.01" min="0" max="800"value="0"><br/></td></tr>
	<tr><td><b>Potassium  </td><td></b><input type="number" name = "K" step="0.01" min="0" max="800"value="0"><br/></td></tr>
	<tr><td><b>CaCo3  </td><td></b><input type="number" name = "CaCo3" step="0.01" min="0" max="800"value="0"/><br/></td></tr>
	<tr><td><b>Iron  </td><td></b><input type="number" name = "Fe" step="0.01" min="0" max="5"value="0"/><br/></td></tr>
	<tr><td><b>Magnesium  </td><td></b><input type="number" name = "Mg" step="0.01" min="0" max="300"value="0"/><br/></td></tr>
	<tr><td><b>Zinc  </td><td></b><input type="number" name = "Zn" step="0.001" min="0" max="100"value="0"/><br/></td></tr>
	<tr><td><b>Copper  </td><td></b><input type="number" name = "Cu" step="0.001" min="0" max="1"value="0"/><br/></td></tr>
	
</table>
<button type="submit" name="submit" value="Submit">Submit</button>
</form>
</body>
</html>
