<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	$op=$_REQUEST['op'];
	if($op =='edit')
	{
		$project_id = $_REQUEST['project_id'];
		$result = $dbobject->getrecordset('project','project_id',$project_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$project_name = $row['project_name'];
			$project_desc = $row['project_desc'];
			$timeline = $row['timeline'];
			$client = $row['client_id'];
			$project_status = $row['project_status'];
			$prioritization_id = $row['prioritization_id'];
			$date_started = $row['date_started'];
			$date_closed = $row['date_closed'];
			$posted_user = $row['posted_user'];
			$created = $row['created'];
		}
		
	}else
	{
		 $project_id="Project".$dbobject->paddZeros($dbobject->getnextid('project'),2);
		 $created = date("Y-m-d H:i:s");
	}
	$prioritization_sel= $dbobject->getTableSelectArr('prioritization',array('prioritization_id','prioritization_name'),array('1','prioritization_id!'),array('1','501'),'prioritization_id','ASC',$prioritization_id,'Prioritization');
	$status_sel= $dbobject->getTableSelectArr('project_status',array('status_id','status_name'),array('1','status_id!'),array('1','501'),'status_id','ASC',$project_status,'Project Status');
	
	$client_sel= $dbobject->getTableSelectArr('client',array('client_id','client_name'),array('1','client_id!'),array('1','501'),'client_id','ASC',$client,'Client');
	
?>
<input type="hidden" name="operation" id="operation" value="<?php echo ($op=='edit')?'edit':"new"; ?>" />
<div class="row-fluid">
 <form class="mws-form" action="" method="post" id="form1">
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>Project Setup</h1>
                        </div>
                        <div class="block-fluid">                        
						<div class="row-form clearfix">
                                <div class="span3">Project ID : </div>
                                <div class="span5">
                                <input type="text" name="project_id-whr" id="project_id-whr" value="<?php echo $project_id; ?>" class="required-text form-control" readonly="true"/>
                                </div>
                            </div> 

                            <div class="row-form clearfix">
                                <div class="span3">Project Name :</div>
                                <div class="span5"><input type="text" name="project_name-fd" id="project_name-fd" class="required-text form-control" title="Project Name" value="<?php echo $project_name; ?>" /></div>
                            </div>
                           
                           <div class="row-form clearfix">
                                <div class="span3">Project Description :</div>
                                <div class="span5"><textarea cols="1" rows="1" name="project_desc-fd" id="project_desc-fd" value="<?php echo $project_desc; ?>" class="required-text form-control" title="Project Desc"><?php echo $project_desc; ?></textarea></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Project Timeline :</div>
                                <div class="span5">
                                 <?php if($op =='edit' && $timeline == " " ){ ?>
                                 
<input type="number" name="timeline1" id="timeline1" class="required-number form-control" title="Timeline" value="<?php echo $timeline; ?>" />
                                <select name="timeline2" id="timeline2" class="required-text form-control">
                            <option value ='Weeks'>Weeks</option>
                              <option value ='Days'>Days</option>
                               <option value ='Months'>Months</option>
                                <option value ='Years'>Years</option>   
                                 </select>
                                 <input type="hidden" name="timeline-fd" id="timeline-fd" class="" title="Timeline" value="<?php echo $timeline; ?>"/>

                                 
                                <?php }else if($op =='edit'){ ?>
                                <input type="text" name="timeline-fd" id="timeline-fd" class="required-text form-control" title="Timeline" value="<?php echo $timeline; ?>" />
<?php }else { ?>


<input type="number" name="timeline1" id="timeline1" class="required-number form-control" title="Timeline" value="<?php echo $timeline; ?>" />
                                <select name="timeline2" id="timeline2" class="required-text form-control">
                            <option value ='Weeks'>Weeks</option>
                              <option value ='Days'>Days</option>
                               <option value ='Months'>Months</option>
                                <option value ='Years'>Years</option>   
                                 </select>
                                 <input type="hidden" name="timeline-fd" id="timeline-fd" class="" title="Timeline" value="<?php echo $timeline; ?>"/>

<?php } ?></div>
                            </div>
                             <div class="row-form clearfix">
                                <div class="span3">Select Client :</div>
                                <div class="span5"><label>
                    <select name="client_id-fd" id="client_id-fd" class="required-text form-control" title="Client"><?php echo $client_sel; ?></select>
                  </label></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Select Project Status :</div>
                                <div class="span5"><label>
                    <select name="project_status-fd" id="project_status-fd" class="required-number form-control" title="Project Status"><?php echo $status_sel; ?></select>
                  </label></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Select Prioritization :</div>
                                <div class="span5"><label>
                    <select name="prioritization_id-fd" id="prioritization_id-fd" class="required-number form-control" title="Prioritization"><?php echo $prioritization_sel; ?></select>
                  </label></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Date Started :</div>
                                <div class="span5">
                                
                                 <?php   if($op =='edit'){  ?>
                                
                                <input type="text" name="date_started-fd" id="date_started-fd" class="required-text form-control" title="Date Started" value="<?php echo $date_started; ?>"  disabled="disabled" />
                                
                             <?php   }else{  ?>
                                
                               <input type="Date" name="date_started-fd" id="date_started-fd" class="required-text form-control" title="Date Started" value="<?php echo $date_started; ?>" />
                                
                              <?php  } ?>
                                
                                </div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">Proposed Delivery Date :</div>
                                <div class="span5">
                             <?php   if($op =='edit' && $date_closed =='0000-00-00 00:00:00'){  ?>
                                
                               <input type="Date" name="date_closed-fd" id="date_closed-fd" class="" title="Date Closed" value="<?php echo $date_closed; ?>" /> 
                                
                             <?php   }else if($op =='edit'){  ?>
                             
                                <input type="text" name="date_closed-fd" id="date_closed-fd" class="" title="Date Closed" value="<?php echo $date_closed; ?>"/>
                                <?php  }else{ ?>
                                <input type="Date" name="date_closed-fd" id="date_closed-fd" class="" title="Date Closed" value="<?php echo $date_closed; ?>" /> 
                              <?php  } ?>
                                
                                </div>
                            </div>
                            
                           
                        
                                    
                    <div id="alertmsg">
                          <strong id="hhdd"></strong> 
           <div id ="display_message" style="padding-left:10px;padding-right:10px;" ></div>
                    </div>
                    
                                                
         <div class="span5"><input type="hidden" name="created-fd" id="created-fd" class="required-text form-control" title="created" value="<?php echo $created; ?>" /></div>
                            
                            
                            
                                <div class="span5"><input type="hidden" name="posted_user-fd" id="posted_user-fd" class="required-text form-control" title="posted_user" value="<?php echo $_SESSION['username_sess']?>" /></div>
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save Project" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('project_list.php','page')" class="btn btn-danger">
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
	  var f = document.getElementById('timeline-fd');
	  var e = document.getElementById('operation');
	 // alert (e.value);
	      if(e.value == "new" || f.value == ""){    
  var a = document.getElementById('timeline1');
  var b = document.getElementById('timeline2');
  if(a.value == "" || b.value == ""){
	
		$('#alertmsg').removeClass('alert-error');
				$('#alertmsg').removeClass('alert-success');
				$('#alertmsg').addClass('alert-error');
				$("#hhdd").html('Error !');
				$("#display_message").html('Timeline value cannot be empty');
			 	$("#display_message").show('fast');
			 	$("#alertmsg").show('fast');
				$("#opt").hide('fast');
				$("#addopt").show('fast');
		return false;
	  }
  var c = a.value + " " + b.value ;
  var d = document.getElementById('timeline-fd');
  d.value = c ;
		  }
	 	callPageEdit('project','project.php','page');
	
  }
	
</script>
              