<? session_start(); ob_start();?>

<?php
include 'config.php';
$positionName =$_POST['positionName'];
$positionId = $_POST['positionId'];
$role_id = $_POST['role_id'];
$admin_id=$_SESSION['admin_id'];

//CheckUsingKpiAssignAndKpiResult Start
if($_POST['action']=="checkUsingKpiAssignAndKpiResult"){

	$sqlSQL="
		select count(*) as countPosition
		from assign_kpi 
		where position_id='$positionId'
	";

	$result=mysql_query($sqlSQL);
	$rs=mysql_fetch_array($result);
	
	echo "[\"$rs[countPosition]\"]";
	
	mysql_close($conn);
}
//CheckUsingKpiAssignAndKpiResult End


if($_POST['action']=="add"){
	
	
	
	$strSQL="INSERT INTO position_emp(position_name,admin_id,role_id)
	VALUES('$positionName','$admin_id','$role_id')";
	$rs=mysql_query($strSQL);
	if($rs){
		echo'["success"]';
	}else{
		echo mysql_error();
	}
	mysql_close($conn);
}

if($_POST['action']=="showData"){
	//echo "Show Data";
	$strSQL="SELECT pe.*,r.role_name FROM position_emp pe
LEFT JOIN role r on pe.role_id=r.role_id
 where admin_id='$admin_id'";
	$result=mysql_query($strSQL);
	$$tableHTML="";
	$i=1;
	$tableHTML.="<table id='Tableposition' class='grid table-striped'>";
		$tableHTML.="<colgroup>";
			$tableHTML.="<col style='width:5%' />";
			$tableHTML.="<col  style='width:40%' />";
			$tableHTML.="<col  style='width:40%' />";

			
		
		$tableHTML.="</colgroup>";
	$tableHTML.="<thead>";
		$tableHTML.="<tr>";
			$tableHTML.="<th><b> ID</b></th>";
			$tableHTML.="<th><b>Position Name</b></th>";
			$tableHTML.="<th><b>Role Name</b></th>";
			$tableHTML.="<th><b>Manage</b></th>";
			
		$tableHTML.="</tr>";
	$tableHTML.="</thead>";
	
	while($rs=mysql_fetch_array($result)){
		
	
	$tableHTML.="<tbody class=\"contentposition\">";
	$tableHTML.="<tr>";
	$tableHTML.="	<td>".$i."</td>";
	$tableHTML.="	<td>".$rs['position_name']."</td>";
	$tableHTML.="	<td>".$rs['role_name']."</td>";

	$tableHTML.="	<td>
			<button type='button' id='idEdit-".$rs['position_id']."' class='actionEdit btn btn-primary btn-xs'><i class='glyphicon glyphicon-pencil'></i></button>
			<button type='button' id='idDel-".$rs['position_id']."' class=' actionDel btn btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button>
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
	
	$strSQL="DELETE FROM position_emp WHERE position_id=$id";
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

	$strSQL="SELECT * FROM position_emp WHERE position_id=$id";
	$result=mysql_query($strSQL);
	if($result){
		$rs=mysql_fetch_array($result);
		
		//echo "[{\"abc\":$rs[position_id],\"def\":\"22\"}]";
		
		 echo "[{\"position_id\":\"$rs[position_id]\",\"position_name\":\"$rs[position_name]\",\"role_id\":\"$rs[role_id]\"}]";
		
	}else{
		echo'["error"]';
	}
	
	mysql_close($conn);
}
if($_POST['action']=="editAction"){
	$id=$_POST['positionId'];
	$positionName=$_POST['positionName'];
	


	
	
	
	$strSQL="UPDATE position_emp SET position_name='$positionName',role_id='$role_id' WHERE position_id='$id'";
	$result=mysql_query($strSQL);
	if($result){
		echo'["editSuccess"]';
	}else{
		echo'["error"]'.mysql_error();
	}

	mysql_close($conn);
}


