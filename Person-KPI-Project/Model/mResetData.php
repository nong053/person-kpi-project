<? session_start(); ob_start();?>

<?php
include 'config.php';
//assign_kpi
$copyForm=$_POST['vCoppyForm'];
$copyTo=$_POST['vCoppyTo'];


if($_POST['action']=='appraisal_period'){
  $strSQLDel="delete from appraisal_period where admin_id='$copyTo'";
  $resultDel= mysql_query($strSQLDel);
  if(!$resultDel){
  	echo '["notSuccess"]';
  }else{
		  	$strSQL="INSERT INTO appraisal_period (appraisal_period_year,
				appraisal_period_desc,appraisal_period_start,appraisal_period_end,
				appraisal_period_target_percentage,admin_id
			)
			SELECT appraisal_period_year,
					appraisal_period_desc,appraisal_period_start,appraisal_period_end
					appraisal_period_end,appraisal_period_target_percentage,".$copyTo." FROM appraisal_period
					WHERE admin_id='$copyForm'; ";
			$result= mysql_query($strSQL);
			if(!$result){
				echo '["notSuccess"]';
			}else{
				echo '["success"]';
			}
  }
  
  
}
if($_POST['action']=='assign_kpi'){
	$strSQLDel="delete from assign_kpi where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess"]';
	}else{
		$strSQL="INSERT INTO assign_kpi(
				assign_kpi_year,
				appraisal_period_id,
				kpi_id,
				department_id,
				position_id,
				emp_id,
				kpi_weight,
				kpi_type_actual,
				kpi_actual_query,
				kpi_actual_manual,
				target_data,
				target_score,
				total_kpi_actual_score,
				kpi_actual_score,
				performance,
				admin_id
				)
							SELECT 
				assign_kpi_year,
				appraisal_period_id,
				kpi_id,
				department_id,
				position_id,
				emp_id,
				kpi_weight,
				kpi_type_actual,
				kpi_actual_query,
				kpi_actual_manual,
				target_data,
				target_score,
				total_kpi_actual_score,
				kpi_actual_score,
				performance,
				".$copyTo." 
				FROM assign_kpi
					WHERE admin_id='$copyForm'; ";
		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess"]';
		}else{
			echo '["success"]';
		}
	}


}

if($_POST['action']=='assign_kpi_master'){
	$strSQLDel="delete from assign_kpi_master where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess"]';
	}else{
		$strSQL="INSERT INTO assign_kpi_master(
				assign_kpi_year,
				appraisal_period_id,
				kpi_id,
				department_id,
				position_id,
				kpi_weight,
				kpi_type_actual,
				kpi_actual_query,
				kpi_actual_manual,
				target_data,
				target_score,
				total_kpi_actual_score,
				kpi_actual_score,
				performance,
				confirm_flag,
				admin_id
				)
							SELECT
				assign_kpi_year,
				appraisal_period_id,
				kpi_id,
				department_id,
				position_id,
				kpi_weight,
				kpi_type_actual,
				kpi_actual_query,
				kpi_actual_manual,
				target_data,
				target_score,
				total_kpi_actual_score,
				kpi_actual_score,
				performance,
				confirm_flag,
				".$copyTo."
				FROM assign_kpi_master
				WHERE admin_id='$copyForm'; ";
		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess"]';
		}else{
			echo '["success"]';
		}
	}


}
if($_POST['action']=='department'){
	
	$strSQLDel="delete from department where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess1"]';
	}else{
		$strSQL="INSERT INTO department(
				department_name,
				department_detail,
				admin_id
				)
				SELECT
				department_name,
				department_detail,
				".$copyTo."
				FROM department
				WHERE admin_id='$copyForm'; ";
		
		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess2"]';
		}else{
			echo '["success"]';
		}
	}
	

}

if($_POST['action']=='employee'){

	$strSQLDel="delete from employee where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess1"]';
	}else{
		$strSQL="INSERT INTO employee(
				emp_user,
				emp_pass,
				emp_picture_thum,
				emp_picture,
				emp_tel,
				emp_age,
				emp_name,
				emp_email,
				emp_other,
				position_id,
				department_id,
				role_id,
				emp_date_of_birth,
				emp_age_working,
				emp_last_name,
				emp_first_name,
				emp_status,
				emp_mobile,
				emp_adress,
				emp_district,
				emp_sub_district,
				emp_province,
				emp_postcode,
				emp_status_work_id,
				emp_code,
				admin_id
				
				
				)
				SELECT
				emp_user,
				emp_pass,
				emp_picture_thum,
				emp_picture,
				emp_tel,
				emp_age,
				emp_name,
				emp_email,
				emp_other,
				position_id,
				department_id,
				role_id,
				emp_date_of_birth,
				emp_age_working,
				emp_last_name,
				emp_first_name,
				emp_status,
				emp_mobile,
				emp_adress,
				emp_district,
				emp_sub_district,
				emp_province,
				emp_postcode,
				emp_status_work_id,
				emp_code,
				".$copyTo."
				FROM employee
				WHERE admin_id='$copyForm'; ";

		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess2"]';
		}else{
			echo '["success"]';
		}
	}


}

if($_POST['action']=='kpi'){

	$strSQLDel="delete from kpi where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess1"]';
	}else{
		$strSQL="INSERT INTO kpi(
				kpi_name,
				kpi_detail,
				kpi_code,
				admin_id


				)
				SELECT
				kpi_name,
				kpi_detail,
				kpi_code,
				".$copyTo."
				FROM kpi
				WHERE admin_id='$copyForm'; ";

		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess2"]';
		}else{
			echo '["success"]';
		}
	}


}

if($_POST['action']=='kpi_result'){

	$strSQLDel="delete from kpi_result where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess1"]';
	}else{
		$strSQL="INSERT INTO kpi_result(
				kpi_year,
				appraisal_period_id,
				department_id,
				division_id,
				position_id,
				emp_id,
				adjust_percentage,
				adjust_reason,
				confirm_flag,
				approve_flag,
				score_sum_percentage,
				score_final_percentage,
				admin_id
				


				)
				SELECT
				kpi_year,
				appraisal_period_id,
				department_id,
				division_id,
				position_id,
				emp_id,
				adjust_percentage,
				adjust_reason,
				confirm_flag,
				approve_flag,
				score_sum_percentage,
				score_final_percentage,
				".$copyTo."
				FROM kpi_result
				WHERE admin_id='$copyForm'; ";

		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess2"]';
		}else{
			echo '["success"]';
		}
	}


}

if($_POST['action']=='position_emp'){

	$strSQLDel="delete from position_emp where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess1"]';
	}else{
		$strSQL="INSERT INTO position_emp(
				position_name,
				role_id,
				admin_id



				)
				SELECT
				position_name,
				role_id,
				".$copyTo."
				FROM position_emp
				WHERE admin_id='$copyForm'; ";

		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess2"]';
		}else{
			echo '["success"]';
		}
	}


}


if($_POST['action']=='threshold'){

	$strSQLDel="delete from threshold where admin_id='$copyTo'";
	$resultDel= mysql_query($strSQLDel);
	if(!$resultDel){
		echo '["notSuccess1"]';
	}else{
		$strSQL="INSERT INTO threshold(
				threshold_name,
				threshold_begin,
				threshold_end,
				threshold_color,
				admin_id
				



				)
				SELECT
				threshold_name,
				threshold_begin,
				threshold_end,
				threshold_color,
				".$copyTo."
				FROM threshold
				WHERE admin_id='$copyForm'; ";

		$result= mysql_query($strSQL);
		if(!$result){
			echo '["notSuccess2"]';
		}else{
			echo '["success"]';
		}
	}


}











?>