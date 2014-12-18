<html>
<head>
<title>Find the selected option</title>
<script type="text/javascript" language="javascript">
<!-- //
function CheckOption(){
    var Selected = document.TestForm.PrizeChosen.selectedIndex;
    var SelectedOption = document.TestForm.PrizeChosen.options[Selected].id;
    alert("The prize you have chosen is a " + SelectedOption);
}
// -->
</script>
</head>
<body>
<form name="TestForm" action="" onsubmit="CheckOption()">
<table>
<tr>
 <td width="15%" align="right">Your Name:</td>
 <td ><input type="text" name="Name"/></td>
</tr>
<tr>
 <td align="right">Your Gender:</td>
 <td><input type="text" name="Gender"/></td>
</tr>
<tr>
 <td width="15%">
 <select name="PrizeChosen">
  <option value="A">Choice A</option>
  <option value="B">Choice B</option>
  <option value="C">Choice C</option>
 </select>
 </td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td width="15%"><input type="submit" value="Submit the form"/></td>
 <td>&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>
