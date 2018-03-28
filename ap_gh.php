<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	
	if($_REQUEST['op']=='edit')
	{
		$id = $_REQUEST['id'];
		$result = $dbobject->getrecordset('daily_progress','id',$id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$project_id = $row['project_id'];
			$username = $row['username'];
			$target = $row['target'];
			$work_done = $row['work_done'];
			$work_status = $row['work_status'];
			$created = $row['created'];
			$hod_appraisal = $row['hod_appraisal'];
			$hod_appraisal_date = $row['hod_appraisal_date'];
			$ps_appraisal = $row['ps_appraisal'];
			$ps_appraisal_date = $row['ps_appraisal_date'];
			$pm_appraisal = $row['pm_appraisal'];
			$pm_appraisal_date = $row['pm_appraisal_date'];
			$gh_appraisal = $row['gh_appraisal'];
			$gh_appraisal_date = date("Y-m-d H:i:s");

		}
		
	}
?>
<style type="text/css">
.fdtddd input,textarea,select
{
	width:95% !important;
}
#heading_td
{
	background-color:#00A0B1;
	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
}
</style>

<form class="mws-form" action="" method="get" id="form1">
 <input type="hidden" name="operation" id="operation" value="edit"/>
  <input type="hidden" name="gh_appraisal_date-fd" id="gh_appraisal_date-fd" class="required-text form-control" title="" value="<?php echo $gh_appraisal_date; ?>" />
           
<input type="hidden" name="id-whr" id="id-whr" value="<?php echo $id; ?>" class="required-text form-control" readonly="true"/>   
 
                    <div class="span10">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>Appriasals</h1>
                        </div>
                        <div class="block-fluid">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5" id="list_table">
            <tr>
              <td width="721" colspan="4" id="">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" style="padding:0px !important;"><table width="100%" border="0" cellspacing="0" id="list_table" class="table" style="border-color:#CCC !important;">
                <tr>
                  <td width="97" align="right" nowrap="nowrap">Project ID :</td>
                  <td align="left" class="fdtddd">
                    <input type="text" name="project_id" id="project_id" value="<?php echo $project_id; ?>" class=" form-control" readonly="true"title="Project ID"/>
                  </td>
                  <td align="left" nowrap="nowrap">Staff Name :</td>
                  <td align="left" class="fdtddd"> <input type="text" name="username" id="username" value="<?php echo $username; ?>" class=" form-control" readonly="true"/></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap">Work Status : </td>
                  <td width="380" align="left" class="fdtddd"><input type="text" name="work_status" id="work_status" value="<?php echo $work_status; ?>" class=" form-control" readonly="true"/></td>
                  <td width="167" align="right" nowrap="nowrap">Date Created :</td>
                  <td width="380" align="left" class="fdtddd"><input type="text" name="created" id="created" value="<?php echo $created; ?>" class=" form-control" readonly="true"/></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap">Target :</td>
                  <td align="left" class="fdtddd"><textarea name="target" id="target" value="<?php echo $target; ?>" class=" form-control" readonly="true"><?php echo $target; ?></textarea></td>
                  <td align="right" nowrap="nowrap">Work Done :</td>
                  <td align="left" class="fdtddd"><textarea  name="work_done" id="work_done" value="<?php echo $work_done; ?>" class=" form-control" readonly="true"><?php echo $work_done; ?></textarea></td>
                </tr>
                
                <tr>
              <td colspan="4" align="left" id="" style="padding:0px !important;">
                                   <div class="widget teal"><header> <h4 class="title"><span class="icon icone-lock"></span></h4></header></div></td>
            </tr>
            <td colspan="4" style="padding:0px !important;"><table width="100%" border="0" cellspacing="0" cellpadding="5" id="list_table" class="table">
<tr>
                  <td align="right" nowrap="nowrap">PS Appraisal :</td>
                  <td width="311" align="left" class="fdtddd"> <textarea cols="1" rows="1" name="ps_appraisal" id="ps_appraisal" value="<?php echo $ps_appraisal; ?>" class=" form-control" readonly="true"><?php echo $ps_appraisal; ?></textarea></td>
                  <td width="167" align="right" nowrap="nowrap">PM Appraisal :</td>
                  <td  align="left" class="fdtddd"><textarea cols="1" rows="1" name="pm_appraisal" id="pm_appraisal" value="<?php echo $pm_appraisal; ?>" class=" form-control" readonly="true"><?php echo $pm_appraisal; ?></textarea>
                  </tr>
                <tr>
                  <td width="97" align="right" nowrap="nowrap">PS Appraisal Date :</td>
                  <td  align="left" class="fdtddd"><input type="text" name="ps_appraisal_date" id="ps_appraisal_date" value="<?php echo $ps_appraisal_date; ?>" class=" form-control" readonly="true"/></td>
                  <td width="97" align="right" nowrap="nowrap">PM Appraisal Date :</td>
                  <td  align="left" class="fdtddd"><input type="text" name="pm_appraisal_date" id="pm_appraisal_date" value="<?php echo $pm_appraisal_date; ?>" class=" form-control" readonly="true"/></td>
                </tr>
                <tr>
                  
                  <td  align="right" nowrap="nowrap">H.O.D Appraisal :</td>
                  <td width="311" align="left" class="fdtddd"><textarea cols="1" rows="1" name="hod_appraisal" id="hod_appraisal" value="<?php echo $hod_appraisal; ?>" class=" form-control" readonly="true"><?php echo $hod_appraisal; ?></textarea>
                  
                  <td width="167" align="right" nowrap="nowrap">GH Appraisal :</td>
                  <td  align="left" class="fdtddd"><textarea name="gh_appraisal-fd" id="gh_appraisal-fd" value="<?php echo $gh_appraisal; ?>" class="required-text form-control" title="Appraisal"><?php echo $gh_appraisal; ?></textarea></td>
                  </tr>
                <tr>
                  <td width="97" align="right" nowrap="nowrap">H.O.D Appraisal Date :</td>
                  <td  align="left" class="fdtddd"><input type="text" name="hod_appraisal_date" id="hod_appraisal_date" value="<?php echo $hod_appraisal_date; ?>" class=" form-control" readonly="true"/></td>
                  <td colspan="2">&nbsp;</td>
                </tr>
              </table></td>
            
                           
                <tr>
                  <td colspan="2">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><label>
                   <input type="button" name="subbtn" id="subbtn" value="Save" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('project_log.php','page')" class="btn btn-danger">
                  </label></td>
                </tr>
                
              </table></td>
              
            </tr>
            
          </table>
          
  <div id="alertmsg">
                          <strong id="hhdd"></strong> 
           <div id ="display_message" style="padding-left:10px;padding-right:10px;" ></div>
                    </div>
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
             callPageEdit('daily_progress','ap_gh.php','page');
  }
	
</script>
              