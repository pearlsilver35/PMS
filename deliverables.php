<?php

	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	$op=$_REQUEST['op'];
	if($op =='edit')
	{
		
		$deliverable_id = $_REQUEST['deliverable_id'];
		$result = $dbobject->getrecordset('deliverables','deliverable_id',$deliverable_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$project_id = $row['project_id'];
			$deliverable = $row['deliverable'];
			$created = $row['created'];
			$officer = $row['officer'];
			$status_id = $row['status_id'];
			
			
		}
		
	}else if($op =='new')
	{
		
		$project_id = $_REQUEST['project_id'];
		$result = $dbobject->getrecordset('project','project_id',$project_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$project_id = $row['project_id'];
			$deliverable_id="DLV".$dbobject->paddZeros($dbobject->getnextid('deliverables'),4);
		    $created = date("Y-m-d H:i:s");
		}
	}else
	{
		
		$project_id = $_REQUEST["project_id"];
		//var_dump($project_id);
		$result = $dbobject->getrecordset('project','project_id',$project_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$project_id = $row['project_id'];
			$deliverable_id="DLV".$dbobject->paddZeros($dbobject->getnextid('deliverables'),4);
		    $created = date("Y-m-d H:i:s");
		}
	}
	
 	$status_sel= $dbobject->getTableSelectArr('project_status',array('status_id','status_name'),array('1','status_id!'),array('1','501'),'status_id','ASC',$status_id,'Status');