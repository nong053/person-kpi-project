<? session_start(); ob_start();?>
<?php

include 'config.php';
/*$empPicture =$_POST['empPicture'];*/
$empUser = $_POST['empUser'];
$emp_id = $_POST['emp_id'];
$empPass = $_POST['empPass'];
$empFullName = $_POST['empFullName'];
//$empPosition = $_POST['empPosition'];
$empAge = $_POST['empAge'];
$empTel = $_POST['empTel'];
$empEmail = $_POST['empEmail'];
$empOther = $_POST['empOther'];
$empId = $_POST['empId'];
$empCode = $_POST['empCode'];



$department_id=$_POST['department_id'];
$position_id=$_POST['position_id'];

$empDepartment=$_POST['empDepartment'];
$empPosition=$_POST['empPosition'];

/*
$department_search_id=$_POST['department_search_id'];
$empDepartment=$_POST['empDepartment'];

$position_search_id=$_POST['position_search_id'];
$position_id=$_POST['empPosition'];
*/

$role_id=$_POST['role_id'];
$admin_id=$_SESSION['admin_id'];

$empFirstName=$_POST['empFirstName'];
$empLastName=$_POST['empLastName'];
$empBrithDay=$_POST['empBrithDay'];
$empAgeWorking=$_POST['empAgeWorking'];
$empStatus=$_POST['empStatus'];
$empAddress=$_POST['empAddress'];
$empSubDistict=$_POST['empSubDistict'];
$empDistict=$_POST['empDistict'];
$empProvince=$_POST['empProvince'];
$empPostcode=$_POST['empPostcode'];
$empStatusWork=$_POST['empStatusWork'];
$status_work_search_id=$_POST['status_work_search_id'];





/*


emp_id
emp_user
emp_pass
emp_picture
emp_tel
emp_age
emp_name
emp_email
position_id
emp_other

empPicture
empUser
empPass
empConfirmPass
empFullName
empPosition
empAge
empTel
empEmail
empOther

*/
//CheckUsingKpiAssignAndKpiResult Start
if($_POST['action']=="checkUsingKpiAssignAndKpiResult"){
	
	$sqlSQL="select count(*) as countEmp from assign_kpi where emp_id='$emp_id'";
	$result=mysql_query($sqlSQL);
	$rs=mysql_fetch_array($result);
	
	echo "[\"$rs[countEmp]\"]";
}
//CheckUsingKpiAssignAndKpiResult End


//checkUserDuplicate
if($_POST['action']=="checkUserDuplicate"){
	$sqlSQL="select count(*) as countEmp from employee
	where emp_user = '$empUser'";
	$result=mysql_query($sqlSQL);
	$rs=mysql_fetch_array($result);
	
	echo "[\"$rs[countEmp]\"]";
}

#####  This function will proportionally resize image #####
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){

	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

	//do not resize if image is smaller than max size
	if($image_width <= $max_size && $image_height <= $max_size){
		if(save_image($source, $destination, $image_type, $quality)){
			return true;
		}
	}

	//Construct a proportional size of new image
	$image_scale	= min($max_size/$image_width, $max_size/$image_height);
	$new_width		= ceil($image_scale * $image_width);
	$new_height		= ceil($image_scale * $image_height);

	$new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image

	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
		save_image($new_canvas, $destination, $image_type, $quality); //save resized image
	}

	return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

if( $image_width > $image_height )
{
$y_offset = 0;
$x_offset = ($image_width - $image_height) / 2;
$s_size 	= $image_width - ($x_offset * 2);
}else{
$x_offset = 0;
$y_offset = ($image_height - $image_width) / 2;
$s_size = $image_height - ($y_offset * 2);
}
$new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image

//Copy and resize part of an image with resampling
if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
save_image($new_canvas, $destination, $image_type, $quality);
}

return true;
}

##### Saves image resource to file #####
function save_image($source, $destination, $image_type, $quality){
switch(strtolower($image_type)){//determine mime type
	case 'image/png':
	imagepng($source, $destination); return true; //save png file
	break;
	case 'image/gif':
	imagegif($source, $destination); return true; //save gif file
	break;
	case 'image/jpeg': case 'image/pjpeg':
	imagejpeg($source, $destination, $quality); return true; //save jpeg file
	break;
	default: return false;
	}
}

if($_POST['empAction']=="add"){
	
	
	$varible="";
	############ Configuration ##############
	$thumb_square_size 		= 200; //Thumbnails will be cropped to 200x200 pixels
	$max_image_size 		= 500; //Maximum image size (height and width)
	$thumb_prefix			= "thumb_"; //Normal thumb Prefix
	//$destination_folder		= 'G:/path/to/uploads/folder/'; //upload directory ends with / (slash)
	$destination_folder		= '../View/uploads/emp'; //upload directory ends with / (slash)
	$jpeg_quality 			= 90; //jpeg quality
	##########################################
	
	//continue only if $_POST is set and it is a Ajax request
	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
		// check $_FILES['ImageFile'] not empty
		if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
			//die('Image file is Missing!'); // output error when above checks fail.
			$varible="Image file is Missing!";
		}
	
		//uploaded file info we need to proceed
		$image_name = $_FILES['image_file']['name']; //file name
		$image_size = $_FILES['image_file']['size']; //file size
		$image_temp = $_FILES['image_file']['tmp_name']; //file temp
	
		$image_size_info 	= getimagesize($image_temp); //get image size
	
		if($image_size_info){
			$image_width 		= $image_size_info[0]; //image width
			$image_height 		= $image_size_info[1]; //image height
			$image_type 		= $image_size_info['mime']; //image type
		}else{
			//die("Make sure image file is valid!");
			$varible="Make sure image file is valid!";
		}
	
		//switch statement below checks allowed image type
		//as well as creates new image from given file
		switch($image_type){
			case 'image/png':
				$image_res =  imagecreatefrompng($image_temp); break;
			case 'image/gif':
				$image_res =  imagecreatefromgif($image_temp); break;
			case 'image/jpeg': case 'image/pjpeg':
				$image_res = imagecreatefromjpeg($image_temp); break;
			default:
				$image_res = false;
		}
	
		if($image_res){
			//Get file extension and name to construct new file name
			$image_info = pathinfo($image_name);
			$image_extension = strtolower($image_info["extension"]); //image extension
			$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
	
			//create a random name for new image (Eg: fileName_293749.jpg) ;
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
	
			//folder path to save resized images and thumbnails
			$thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name;
			$image_save_folder 	= $destination_folder . $new_file_name;
	
			//call normal_resize_image() function to proportionally resize image
			if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
			{
				//call crop_image_square() function to create square thumbnails
				if(!crop_image_square($image_res, $thumb_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
				{
					//die('Error Creating thumbnail');
					$varible="Error Creating thumbnail";
				}
					
				/* We have succesfully resized and created thumbnail image
				 We can now output image to user's browser or store information in the database*/
				/*
				echo '<div align="center">';
				echo '<img src="uploads/'.$thumb_prefix . $new_file_name.'" alt="Thumbnail">';
				echo '<br />';
				echo '<img src="uploads/'. $new_file_name.'" alt="Resized Image">';
				echo '</div>';
				*/
			}
	
			imagedestroy($image_res); //freeup memory
		}
	}
	
	
	
	
	
	if($varible=!"" && $varible=!"1"){
		
		echo"[\"".$varible."\"]";
		
	}else{
		
		$strSQL="INSERT INTO employee(emp_user,emp_pass,emp_tel,emp_mobile,emp_age,emp_name,emp_email,position_id,emp_other,emp_picture,emp_picture_thum,department_id,role_id,admin_id,
		emp_first_name,emp_last_name,emp_date_of_birth,emp_age_working,emp_status,emp_adress,emp_district,emp_sub_district,emp_province,emp_postcode,emp_status_work_id,emp_code)
		VALUES('$empUser','$empPass','$empTel','$empMobile','$empAge','$empFullName','$empEmail','$empPosition','$empOther','$image_save_folder','$thumb_save_folder','$empDepartment','$role_id','$admin_id',
		'$empFirstName','$empLastName','$empBrithDay','$empAgeWorking','$empStatus','$empAddress','$empDistict','$empSubDistict','$empProvince','$empPostcode','$empStatusWork','$empCode'
)";
		$rs=mysql_query($strSQL);
		if($rs){
			echo'success';
			//echo"<script>alert(บันทึกข้อมูลเรียบร้อย);</script>";
		}else{
			echo mysql_error();
		}
		mysql_close($conn);
		
	}
}

if($_POST['action']=="showData"){
	//echo "Show Data";
	
	$strSQL="select e.*,pe.position_name,r.role_name,d.department_name,es.emp_status_work from employee e 
INNER JOIN position_emp pe on e.position_id=pe.position_id
INNER JOIN role r on pe.role_id=r.role_id
INNER JOIN department d on e.department_id=d.department_id
LEFT JOIN  emp_status es on e.emp_status_work_id=es.id
where (e.department_id='$department_id' or '$department_id' ='All')
 and (e.position_id='$position_id' or '$position_id' ='All')
 and e.admin_id='$admin_id'
 and (e.emp_status_work_id='$status_work_search_id'  or '$status_work_search_id' ='All')
			";
	/*
	$strSQL="select e.*,pe.position_name from employee e 
INNER JOIN position_emp pe on e.position_id=pe.position_id
where (e.department_id='All' or 'All' ='All')

 and (e.position_id='All' or 'All' ='All')
	";
	*/
	$result=mysql_query($strSQL);
	$$tableHTML="";
	$i=1;
	$tableHTML.="<table id='Tableemployee' class='grid table-striped'>";
		$tableHTML.="<colgroup>";
			$tableHTML.="<col style='width:5%' />";
			$tableHTML.="<col  style='width:8%'/>";
			$tableHTML.="<col style='width:18%'/>";
			$tableHTML.="<col style='width:12%'/>";
			$tableHTML.="<col style='width:12%'/>";
			$tableHTML.="<col style='width:10%'/>";
			$tableHTML.="<col style='width:10%'/>";
			$tableHTML.="<col style='width:10%'/>";
		
		$tableHTML.="</colgroup>";
	$tableHTML.="<thead>";
		$tableHTML.="<tr>";
			$tableHTML.="<th><b> ID</b></th>";
			$tableHTML.="<th><b>Picture</b></th>";
			$tableHTML.="<th><b>Name</b></th>";
			$tableHTML.="<th><b>Department</b></th>";
			$tableHTML.="<th><b>Position</b></th>";
			//$tableHTML.="<th><b>Role</th>";
			$tableHTML.="<th><b>Age working</b></th>";
			$tableHTML.="<th><b>Age</b></th>";
			$tableHTML.="<th><b>Status</b></th>";
			$tableHTML.="<th><b>Manage</b></th>";
			
		$tableHTML.="</tr>";
	$tableHTML.="</thead>";
	
	while($rs=mysql_fetch_array($result)){
		
	
	$tableHTML.="<tbody class=\"contentemployee\">";
	$tableHTML.="<tr>";
	$tableHTML.="	<td>".$i."|".$rs[emp_code]."</td>";
	$tableHTML.="	<td><img class=\"img-circle\" src=".$rs['emp_picture_thum']." width=50></td>";
	$tableHTML.="	<td>".$rs['emp_first_name']." ".$rs['emp_last_name']."</td>";
	$tableHTML.="	<td>".$rs['department_name']."</td>";
	$tableHTML.="	<td>".$rs['position_name']."</td>";
	//$tableHTML.="	<td>".$rs['role_name']."</td>";
	$tableHTML.="	<td>".$rs['emp_age_working']."</td>";
	$tableHTML.="	<td>".$rs['emp_age']."</td>";
	$tableHTML.="	<td>".$rs['emp_status_work']."</td>";
	

	$tableHTML.="	<td>
			<button type='button' id='idEdit-".$rs['emp_id']."' class='actionEdit btn btn-primary btn-xs'><i class='glyphicon glyphicon-pencil'></i></button>
			<button type='button' id='idDel-".$rs['emp_id']."' class=' actionDel btn btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button>
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
	
	$strSQLDelPic="SELECT * FROM employee WHERE emp_id=$id";
	$resultDelPic=mysql_query($strSQLDelPic);
	
	$rsDelPic=mysql_fetch_array($resultDelPic);
	
	@unlink($rsDelPic['emp_picture']);
	@unlink($rsDelPic['emp_picture_thum']);
	
	
	
	
	$strSQL="DELETE FROM employee WHERE emp_id=$id";
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
	
	
	
	
	
	

	$strSQL="SELECT * FROM employee WHERE emp_id=$id";
	
	$result=mysql_query($strSQL);
	if($result){
		$rs=mysql_fetch_array($result);
		
		//echo "[{\"abc\":$rs[emp_id],\"def\":\"22\"}]";
		/*
		emp_id
		emp_user
		emp_pass
		emp_picture
		emp_tel
		emp_age
		emp_name
		emp_email
		position_id
		emp_other
		emp_code
		*/
		 echo "[{\"emp_id\":\"$rs[emp_id]\",\"emp_user\":\"$rs[emp_user]\",
		 		\"emp_pass\":\"$rs[emp_pass]\",\"emp_picture\":\"$rs[emp_picture]\",
	\"emp_tel\":\"$rs[emp_tel]\",\"emp_age\":\"$rs[emp_age]\",\"emp_name\":\"$rs[emp_name]\",
	\"emp_email\":\"$rs[emp_email]\",\"position_id\":\"$rs[position_id]\",\"emp_other\":\"$rs[emp_other]\",
	\"department_id\":\"$rs[department_id]\",\"role_id\":\"$rs[role_id]\",
	
	\"emp_first_name\":\"$rs[emp_first_name]\",\"emp_last_name\":\"$rs[emp_last_name]\",
	\"emp_date_of_birth\":\"$rs[emp_date_of_birth]\",\"emp_age_working\":\"$rs[emp_age_working]\",
	\"emp_status\":\"$rs[emp_status]\",\"emp_mobile\":\"$rs[emp_mobile]\",
	\"emp_adress\":\"$rs[emp_adress]\",\"emp_district\":\"$rs[emp_district]\",
	\"emp_sub_district\":\"$rs[emp_sub_district]\",\"emp_province\":\"$rs[emp_province]\",
	\"emp_postcode\":\"$rs[emp_postcode]\",\"emp_status_work_id\":\"$rs[emp_status_work_id]\",
	\"emp_code\":\"$rs[emp_code]\"
	
	}]";
		
	}else{
		echo'["error"]';
	}
	
	mysql_close($conn);
}
if($_POST['empAction']=="editAction"){



	/*
	employee
	############ View ##############
	empPicture
	empUser
	empPass
	empConfirmPass
	empConfirmPass
	empFullName
	empPosition
	empAge
	empTel
	empEmail
	empOther
	############ Database ##############
	emp_id
	emp_user
	emp_pass
	emp_picture
	emp_tel
	emp_age
	emp_name
	emp_email
	*/
	
	
	/*Edit Immage Start Here*/
	if($_FILES['image_file']!=""){
		
	
	$varible="";
	############ Configuration ##############
	$thumb_square_size 		= 200; //Thumbnails will be cropped to 200x200 pixels
	$max_image_size 		= 500; //Maximum image size (height and width)
	$thumb_prefix			= "thumb_"; //Normal thumb Prefix
	//$destination_folder		= 'G:/path/to/uploads/folder/'; //upload directory ends with / (slash)
	$destination_folder		= '../View/uploads/emp'; //upload directory ends with / (slash)
	$jpeg_quality 			= 90; //jpeg quality
	##########################################
	
	//continue only if $_POST is set and it is a Ajax request
	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
		// check $_FILES['ImageFile'] not empty
		if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
			//die('Image file is Missing!'); // output error when above checks fail.
			$varible="Image file is Missing!";
		}
	
		//uploaded file info we need to proceed
		$image_name = $_FILES['image_file']['name']; //file name
		$image_size = $_FILES['image_file']['size']; //file size
		$image_temp = $_FILES['image_file']['tmp_name']; //file temp
	
		$image_size_info 	= getimagesize($image_temp); //get image size
	
		if($image_size_info){
			$image_width 		= $image_size_info[0]; //image width
			$image_height 		= $image_size_info[1]; //image height
			$image_type 		= $image_size_info['mime']; //image type
		}else{
			//die("Make sure image file is valid!");
			$varible="Make sure image file is valid!";
		}
	
		//switch statement below checks allowed image type
		//as well as creates new image from given file
		switch($image_type){
			case 'image/png':
				$image_res =  imagecreatefrompng($image_temp); break;
			case 'image/gif':
				$image_res =  imagecreatefromgif($image_temp); break;
			case 'image/jpeg': case 'image/pjpeg':
				$image_res = imagecreatefromjpeg($image_temp); break;
			default:
				$image_res = false;
		}
	
		if($image_res){
			//Get file extension and name to construct new file name
			$image_info = pathinfo($image_name);
			$image_extension = strtolower($image_info["extension"]); //image extension
			$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
	
			//create a random name for new image (Eg: fileName_293749.jpg) ;
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
	
			//folder path to save resized images and thumbnails
			$thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name;
			$image_save_folder 	= $destination_folder . $new_file_name;
	
			//call normal_resize_image() function to proportionally resize image
			if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
			{
				//call crop_image_square() function to create square thumbnails
				if(!crop_image_square($image_res, $thumb_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
				{
					//die('Error Creating thumbnail');
					$varible="Error Creating thumbnail";
				}
					
				/* We have succesfully resized and created thumbnail image
				 We can now output image to user's browser or store information in the database*/
				/*
				 echo '<div align="center">';
				echo '<img src="uploads/'.$thumb_prefix . $new_file_name.'" alt="Thumbnail">';
				echo '<br />';
				echo '<img src="uploads/'. $new_file_name.'" alt="Resized Image">';
				echo '</div>';
				*/
			}
	
			imagedestroy($image_res); //freeup memory
		}
	}
	/*Edit Immage End Here*/
	
		$strSQLDelPic="SELECT * FROM employee WHERE emp_id=$empId";
		$resultDelPic=mysql_query($strSQLDelPic);
		
		$rsDelPic=mysql_fetch_array($resultDelPic);
		
		@unlink($rsDelPic['emp_picture']);
		@unlink($rsDelPic['emp_picture_thum']);

		$strSQL="UPDATE employee SET emp_user='$empUser',emp_pass='$empPass',
		emp_tel='$empTel',emp_age='$empAge',emp_name='$empFullName',emp_email='$empEmail',
		emp_other='$empOther',emp_picture='$image_save_folder',emp_picture_thum='$thumb_save_folder',position_id='$empPosition',
		department_id='$empDepartment',role_id='$role_id',
		
		emp_first_name='$empFirstName',emp_last_name='$empLastName',emp_date_of_birth='$empBrithDay',emp_age_working='$empAgeWorking',emp_status='$empStatus',
		emp_mobile='$empMobile',emp_adress='$empAddress',emp_district='$empDistict',emp_sub_district='$empSubDistict',emp_province='$empProvince',
		emp_postcode='$empPostcode',emp_status_work_id='$empStatusWork',emp_code='$empCode'
		
		WHERE emp_id='$empId'";
		
	}else{
		$strSQL="UPDATE employee SET emp_user='$empUser',emp_pass='$empPass',
		emp_tel='$empTel',emp_age='$empAge',emp_name='$empFullName',emp_email='$empEmail',
		emp_other='$empOther',position_id='$empPosition',department_id='$empDepartment',role_id='$role_id',
		
		emp_first_name='$empFirstName',emp_last_name='$empLastName',emp_date_of_birth='$empBrithDay',emp_age_working='$empAgeWorking',emp_status='$empStatus',
		emp_mobile='$empMobile',emp_adress='$empAddress',emp_district='$empDistict',emp_sub_district='$empSubDistict',emp_province='$empProvince',
		emp_postcode='$empPostcode',emp_status_work_id='$empStatusWork',emp_code='$empCode'
		
		WHERE emp_id='$empId'";
				
	}
	
	$result=mysql_query($strSQL);
	if($result){
		echo'editSuccess';
	}else{
		echo'["error"]'.mysql_error();
	}

	mysql_close($conn);
}


