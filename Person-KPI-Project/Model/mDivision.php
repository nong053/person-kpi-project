<?php
include 'config.php';
$divisionName =$_POST['divisionName'];
$divisionDetail = $_POST['divisionDetail'];
$divisionId = $_POST['divisionId'];
$departmentId = $_POST['departmentId'];




if($_POST['action']=="add"){
	$strSQL="INSERT INTO division(division_name,division_detail,department_id)
	VALUES('$divisionName','$divisionDetail','$departmentId')";
	$rs=mysql_query($strSQL);
	if($rs){
		echo'["success"]';
	}else{
		echo'["error"]';
	}
	mysql_close($conn);
}

if($_POST['action']=="showData"){
	//echo "Show Data";
	$strSQL="SELECT * FROM division
left   JOIN department dep
ON dep.department_id=division.department_id";
	$result=mysql_query($strSQL);
	$$tableHTML="";
	$i=1;
	$tableHTML.="<table id='Tabledivision' class='grid'>";
		$tableHTML.="<colgroup>";
			$tableHTML.="<col style='width:50px' />";
			$tableHTML.="<col  />";
			$tableHTML.="<col  />";
			$tableHTML.="<col />";
			$tableHTML.="<col />";
		
		$tableHTML.="</colgroup>";
	$tableHTML.="<thead>";
		$tableHTML.="<tr>";
			$tableHTML.="<th><b> ID</b></th>";
			$tableHTML.="<th><b>Department Name</b></th>";
			$tableHTML.="<th><b>Division Name</b></th>";
			$tableHTML.="<th><b>Division Detail</b></th>";
			$tableHTML.="<th><b>Manage</b></th>";
			
		$tableHTML.="</tr>";
	$tableHTML.="</thead>";
	
	while($rs=mysql_fetch_array($result)){
		
	
	$tableHTML.="<tbody class=\"contentdivision\">";
	$tableHTML.="<tr>";
	$tableHTML.="	<td>".$i."</td>";
	$tableHTML.="	<td>".$rs['department_name']."</td>";
	$tableHTML.="	<td>".$rs['division_name']."</td>";
	$tableHTML.="	<td>".$rs['division_detail']."</td>";

	$tableHTML.="	<td>
			<button type='button' id='idEdit-".$rs['division_id']."' class='actionEdit btn btn-primary btn-xs'><i class='glyphicon glyphicon-pencil'></i></button>
			<button type='button' id='idDel-".$rs['division_id']."' class=' actionDel btn btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button>
			</td>";
	$tableHTML.="</tr>";

	
	$i++;
	}
	$tableHTML.="</tbody>";
	$tableHTML.="</table>";
	echo $tableHTML;
	mysql_close($conn);
}
if($_POST['action']=="del"){
	$id=$_POST['id'];
	
	$strSQL="DELETE FROM division WHERE division_id=$id";
	$result=mysql_query($strSQL);
	if($result){
		echo'["success"]';
	}else{
		echo'["error"]';
	}
	mysql_close($conn);
	
}
if($_POST['action']=="edit"){
	$id=$_POST['id'];

	$strSQL="SELECT * FROM division WHERE division_id=$id";
	$result=mysql_query($strSQL);
	if($result){
		$rs=mysql_fetch_array($result);
		
		//echo "[{\"abc\":$rs[division_id],\"def\":\"22\"}]";
		
		 echo "[{\"division_id\":\"$rs[division_id]\",\"division_name\":\"$rs[division_name]\",\"department_id\":\"$rs[department_id]\",
		 		\"division_detail\":\"$rs[division_detail]\"}]";
		
	}else{
		echo'["error"]';
	}
	
	mysql_close($conn);
}
if($_POST['action']=="editAction"){



	
	
	
	$strSQL="UPDATE division SET division_name='$divisionName',department_id='$departmentId',division_detail='$divisionDetail' WHERE division_id='$divisionId'";
	$result=mysql_query($strSQL);
	if($result){
		echo'["editSuccess"]';
	}else{
		echo'["error"]'.mysql_error();
	}

	mysql_close($conn);
}


