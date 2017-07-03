<?php
//Here calling the functions' file...
$key=$_GET['key'];
$array = array();
$con=mysql_connect("localhost","root","");
$db=mysql_select_db("stock",$con);
$query=mysql_query("select * from produit where denomination LIKE '%{$key}%'");
while($row=mysql_fetch_assoc($query))
{
  $addLeftLinkTag = '<a href="../produit/details.php?idProduit=';
  $addLeftLinkTag .= $row['idproduit'];
  $idproduit = $row['idproduit'];
  $addLeftLinkTag .= '">';
  $addRightLinkTag = '</a>';
  $hint = "";
  $hint .= $addLeftLinkTag;
  $hint.=$row['denomination'];
  $hint .= $addRightLinkTag;
  $array[] = $hint.": ".$row['description'];
}

echo json_encode($array);

?>
