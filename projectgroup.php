<form action="" method="get" id="form1">
<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$parent_id = "";
		
	if($_REQUEST['op']=='edit'){
		$project_id = $_REQUEST['project_id'];
		$result = $dbobject->getrecordset('project','project_id',$project_id);
		$numrows = mysql_num_rows($result);
	
			if($numrows > 0){
				$row = mysql_fetch_array($result);
				$project_name = $row['project_name'];
				
			}
	
	}
	$project_id = $dbobject->getproject($project_id);
	
?>
 
 

		<div class="row-fluid">
  				<div class="span6">
					<div class="head clearfix">
                            <div class="isw-ok"></div>
                            <h1>Project Group</h1>
                        </div>
                       
                        <div class="block-fluid">                        
                          
                          <div class="row-form clearfix">
                            <div class="span3">Project Menu:</div>
                            <div class="span4">
                            <select name="project_id" id="project_id" onChange='javascript: loaduser();'>
                            <?php echo $project_id; ?>
                            </select>
                            </div>
                         </div>
		                
                        <div class="row-form clearfix">
                        <table align="center" width="400" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3">&nbsp;</td>
        <td width="283">&nbsp;</td>
      </tr>
      <tr>
        <td width="234" align="center"><label>
          <select name="non_exist_user" size="5" multiple id="non_exist_user">
          </select>
        </label></td>
        <td width="79"><table align="center" width="79" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><img src="images/right.png" alt="Move Forward" width="26" height="28" onClick="javascript: adduser();"></td>
            </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><img src="images/left.png" alt="Move Backward" width="26" height="28" onClick="javascript: removeuser();"></td>
            </tr>
          
        </table></td>
        <td width="4">&nbsp;</td>
        <td align="center"><select name="exist_user" size="5" multiple id="exist_user">
                                                </select></td>

      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
                        </div>
                        
                        
                        <div id ="display_message" style="padding-left:10px;padding-right:10px;display:none;"></div>
                            <div class="footer tar">
                              <input type="button" name="subbtn" id="subbtn" value="Save" onclick="javascript: selectalldataa(); callpage('save_projectgroup');" class="btn" />
                            
                              <input type="button" value="Cancel" id="cancelbtn" onclick="window.location='home.php';" class="btn btn-danger" />
                            </div>                            

                        
                        </div>
       			</div>
            </div>             
                </form>