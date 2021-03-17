<html>
    <body>
<form action="index.php" method="post">
<label >Please insert your Identification Number "CNP":</label>
<input type="text" target="_self"  name="cnp"  autofocus>


<input type="submit">



</form>
<!-- we can use HTML to force input field to be a number and to limit character to 13 but I will use php to accomplish that <input type="number" maxlength="13" min="1000101010011" max="9991231529999" required autofocus> -->


<?php
echo "<br>Your insert was:".$_POST["cnp"];

//we have to clean the insert for security reasons (suplimentary can be used trim() and stripslashes() ) but for the moment I will use only htmlspecialchars()

//$cnp = htmlspecialchars($_POST["cnp"]);

$cnp = $_POST["cnp"];

if(empty($cnp))
echo "<br>Please insert 13 numeric characters - your insert is empty";
elseif(!is_numeric($cnp))
echo "<br>Please insert a numeric value - your insert contains a string character or is not a integer";
elseif(strlen($cnp)!=13)
echo "<br>lease insert 13 numeric characters. You inserted ".strlen($cnp)." characters";
else
{
    // test CNP number
    $ControlNumber=279146358279;
    
    for($a=0;$a<=11;$a++)
    {
      $prod=substr($cnp,$a,1)*substr($ControlNumber,$a,1);
      echo "<br>".substr($cnp,$a,1)." * ".substr($ControlNumber,$a,1)." = ".$prod;
      $TotalSum=$TotalSum+$prod;
    }
    
    //keep last character from inserted number
    $last_char=substr($cnp,12,1);
    
    //Calculate Modulo=$a % $b (Remainder of $a divided by $b)
    $Modulo=$TotalSum%11;
    
    echo "<br><br> TotalSum=".$TotalSum;
    echo "<br>Modulo=".$Modulo;
    echo "<br>CNPLastChar=".$last_char;
    
    
    if($Modulo==10)
    $Modulo=1;
    
    if($Modulo==$last_char)
    echo "<br><b>CNP is VALID";
    else
    echo "<br><b>CNP is INVALID";
    
    
}



?>

</body>
</html>
