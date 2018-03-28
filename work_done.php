<?php
include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	
	
	if($_REQUEST['op']=='edit')
	{
		$id = $_REQUEST['id'];
		$query = $dbobject->getrecordset('daily_progress','id',$id);
		
		$numrows = mysql_num_rows($query);
		
		if($numrows > 0)
		{
			$row = mysql_fetch_array($query);
			$id = $_REQUEST['id'];
			$project_id = $row['project_id'];
			$username = $row['username'];
			$work_status = $row['work_status'];
			$target = $row['target'];
			$work_done = $row['work_done'];
		}
	}
	
	$project_sel= $dbobject->getTableSelectArr('project',array('project_id','project_name'),array('1','project_id!'),array('1','501'),'project_id','ASC',$project_id,'Projects');
	$status_sel= $dbobject->getTableSelectArr('project_status',array('status_id','status_name'),array('1','status_id!'),array('1','501'),'status_id','ASC',$work_status,'Project Status');
?>

<div class="row-fluid">
 <form class="mws-form" action="" method="get" id="form1">
 <input type="hidden" name="operation" id="operation" value="edit" />
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>Work Done</h1>
                        </div>
                        <div class="block-fluid">                        
						<div class="row-form clearfix">
                               <div class="span3">Project ID :</div>
                                <div class="span5"><input type="text"  name="project_id" id="project_id" class="required-text form-control" title="project_id" value="<?php echo $project_id; ?>" readonly="true" /></div>
                            </div>
                            <input type="hidden" name="id-whr" id="id-whr" class="required-text form-control" title="id" value="<?php echo $id; ?>" />
                           
                           
                              <div class="row-form clearfix">
                            <div class="span3">Target :</div>
                                <div class="span5"><textarea cols="25" rows="2"  name="target" id="target" class="required-text form-control" title="target" readonly="true"><?php echo $target; ?></textarea> </div>
                               </div>
                               
                               <div class="row-form clearfix">                                
                               <div class="span3">Work Done :</div>
                                <div class="span5"><textarea cols="25" rows="2"  name="work_done-fd" id="work_done-fd" class="required-text form-control" title="Work Done" value="<?php echo $work_done; ?>" ><?php echo $work_done; ?></textarea> </div></div>
                                
                            <div class="row-form clearfix">
                                <div class="span3">Select Project Status :</div>
                                <div class="span5"><label>
                    <select name="work_status-fd" id="work_status-fd">
                      <?php echo $status_sel; ?>
                    </select>
                  </label></div>
                            </div>
                               
                    <div id="alertmsg" class="alert alert-success" style="display:none;">
                          <strong id="hhdd">Successful ! </strong>
                          <div id ="display_message" style="padding-left:10px;padding-right:10px;display:none;" ></div>
                    </div>
                                                
         
                            
                            
                            
                               
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save Work Done" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('project_log_staff.php','page')" class="btn btn-danger">
                    </div>
                    
                 </div>
             </div>
             
             </div>
             </div>
             </div>
             </div>
             </form>
             
  <script>
  function calldage()
  {           
             callPageEdit('daily_progress','work_done.php','page');
  }
	
</script>
              