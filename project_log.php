<?php 
session_start();
if (!isset($_SESSION['username_sess']))
{
	include('logout.php');
	}
//require("lib/dbcnx.inc"); 
include("lib/dbfunctions.php");
$dbobject = new dbobject();
?>

<?php
	
	
	$query = "SELECT * FROM userdata WHERE username='".$_SESSION['username_sess']."' "; 
			$result3 = mysql_query($query);
			$numrows = mysql_num_rows($result3);
			if($numrows > 0){
				$row = mysql_fetch_array($result3);
				$role_id = $row['role_id'];
			}
			
	?>
<form name="form1" id="form1" method="post" action="">
<?php
			$count = 0;
			$limit = !isset($_REQUEST['limit'])?"200":$_REQUEST['limit'];
			$pageNo = !isset($_REQUEST['fpage'])?"1":$_REQUEST['fpage'];
			$searchby = !isset($_REQUEST['searchby'])?"id":$_REQUEST['searchby'];
			$keyword = !isset($_REQUEST['keyword'])?"":$_REQUEST['keyword'];
			$orderby = !isset($_REQUEST['orderby'])?"id":$_REQUEST['orderby'];
			$orderflag = !isset($_REQUEST['orderflag'])?"asc":$_REQUEST['orderflag'];
			$lower = !isset($_REQUEST['lower'])?"":$_REQUEST['lower'];
			$upper = !isset($_REQUEST['upper'])?"":$_REQUEST['upper'];
			$start_date = !isset($_REQUEST['start_date'])?"":$_REQUEST['start_date'];
			$end_date = !isset($_REQUEST['end_date'])?"":$_REQUEST['end_date'];
			
			$searchdate ="";
			if($start_date!='' && $end_date!=''){
			$searchdate = " and (created between '$start_date 00:00'  and '$end_date 23:59') ";
			}else{
				$datestr = date('Y-m-d');
				$searchdate = "";
			}
			
			
			$filter = "";
			if($keyword!=''){$filter=" AND $searchby like '%$keyword%' ";}
			$order = " order by ".$orderby." ".$orderflag;
		  $sql = "select count(id) counter from daily_progress where 1=1 and id not in(select parameter_value from parameter where parameter_name='501' )".$filter.$searchdate;	// Filter admin
			//echo $sql;
			$result = mysql_query($sql);
			if($result){
			$row = mysql_fetch_array($result);
			$count = $row['counter'];
			}
			
			$skip = 0;
			$maxPage = $limit;
			//echo $count;
			$npages = (int)($count/$maxPage);
			//echo $npages;
			if ($npages!=0){
				if(($npages * $maxPage) != $count){	
					$npages = $npages+1;
					//echo $npages;
				}
			}else{
				$npages = 1;
				//echo "Here";
			}
			
			$sel = !isset($_REQUEST['op'])?"":$_REQUEST['op'];
			if ($sel=="del"){
				$delvalues = !isset($_REQUEST['id'])?"":$_REQUEST['id'];
				$delsql = "delete from daily_progress where id = '$delvalues'";
				$dresult = mysql_query($delsql);
				
				$delvalues = !isset($_REQUEST['var1'])?"":$_REQUEST['var1'];
				if($delvalues!=''){
					$delvalues = substr($delvalues,0,strlen($delvalues)-2);
					$delvalues = str_replace("-","'",$delvalues);
					$delsql = "delete from daily_progress where id in ($delvalues)";	
					//echo $delsql;
					$dresult = mysql_query($delsql);
				}
				echo "<font class='header2white'>No of Deleted Records: ".mysql_affected_rows()." </font>";
			}
	$pg = $pageNo -1;
	$limRange = $pg * $limit;
	$limit_filter = " LIMIT ".$limRange.",".$limit;	

	//mysql_select_db($database_courier);
	
		$query = "SELECT * from daily_progress where 1=1".$filter.$searchdate.$order.$limit_filter;
	
	//echo $query;
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);
	
	//echo 'D page:  '.$pageNo;
	
	$status_sel= $dbobject->getTableSelectArr('project_status',array('status_id','status_name'),array('1','status_id!'),array('1','501'),'status_id','ASC',$status_id,'Project Status');
	?>
   
   
<input type = 'hidden' name = 'sql' id='sql' value="<?php echo $download_query;?>" />
<input type = 'hidden' name = 'filename' id='filename' value="userdata" />
<input type = 'hidden' name = 'pageNo' id="pageNo" value = "<?php echo $pageNo; ?>">		
<input type = 'hidden' name = 'rowCount' value = "<?php echo $count; ?>">
<input type = 'hidden' name = 'skipper' value = "<?php echo $skip; ?>">
<input type = 'hidden' name = 'pageEnd' value = "<?php echo $npages; ?>">
<input type = 'hidden' name = 'sel' /> 
<script type="text/javascript">
$(".mws-datepicker").datepicker({
				dateFormat: 'yy-mm-dd',
				changeYear: true,
			    showOtherMonths: true
            });

</script>
<div class="row-fluid">

                    <div class="span12">                    
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>Project Log</h1>
                            
                                              
                        </div>
                        
                       
                        
                        <div class="block-fluid clearfix">
                       
                       
                       
                        <div id="filter_div" align="center">
<table width="99%" style="">
<tbody>
<tr>
<td width="177" height="14"><table border="0" cellpadding="0" cellspacing="0">
                  <tbody><tr>
                    <td width="80" align="right" nowrap="nowrap">Start Date: </td>
                    <td>
                    <input type="text" name="start_date" id="start_date" class="mws-datepicker" value="<?php echo $start_date; ?>" >
                    </td>
                  </tr>
    </tbody></table></td>
	<td width="1116" rowspan="2" align="left"><table width="507">
	  <tbody><tr>
	    <td width="11%" align="right">Search:</td>
	    <td width="25%"><select name="searchby" class="table_text1"  id="searchby">
	      <option value="username" <?php echo ($searchby=='username')?"selected":""; ?>>Staff</option>
          <?php /*?><option value="id" <?php echo ($searchby=='project_id')?"selected":""; ?>>Project Id</option>
<option value="work_status" <?php echo ($searchby=='work_status')?"selected":""; ?>>Work  Status</option><?php */?>
	      </select></td>
	    <td width="17%" align="right"> <span>Keyword:</span></td>
	    <td width="33%">
	      <input name="keyword" type="text" class="table_text1" id="keyword" value=""></td>  <td width="14%"><span class="submit">
	        <input name="search2" type="button" class="btn" id="search2" onclick="javascript:doSearch('project_log.php')" value="Search"></span>
	        </td></tr>
	  <tr>
	    <td align="right">Order:</td>
	    <td colspan="4">
        <select name="orderby" class="table_text1"  id="orderby">
                  <option value="id" <?php echo ($orderby=='project_id')?"selected":""; ?>>Project Id</option>
                  <option value="work_status" <?php echo ($orderby=='work_status')?"selected":""; ?>>Work  Status</option>
                  </select>
	      <select name="orderflag" class="table_text1" id="orderflag">
	        <option value="asc" selected="">Ascending</option>
	        <option value="desc">Descending</option>
	        </select>				  </td>
	    </tr></tbody></table>  </td>
</tr>
<tr>
  <td height="24"><table border="0" cellpadding="0" cellspacing="0">
                  <tbody><tr>
                    <td width="80" align="right" nowrap="nowrap">End Date: </td>
                    <td><input type="text" name="end_date" id="end_date"  class="mws-datepicker" value="<?php echo $end_date; ?>" /></td>
                  </tr>
    </tbody></table> </td>
</tr>
</tbody></table>
</div>



<div id="inner_div">
<table width="100%">

<tr>
  <td align="right" nowrap="nowrap" width="200"><font class='table_text1'>
    <label> </label>    No of Records : <?php echo $count; ?></td>
  <td align="right" nowrap="nowrap"> Limit :
    <select name="limit"   id="limit" onchange="javascript:doSearch('project_log.php');" style="width:100px;">
      <option value="1" <?php echo ($limit=="1"?"selected":""); ?>>1</option>
      <option value="10" <?php echo ($limit=="10"?"selected":""); ?>>10</option>
      <option value="20" <?php echo ($limit=="20"?"selected":""); ?>>20</option>
      <option value="50" <?php echo ($limit=="50"?"selected":""); ?>>50</option>
      <option value="100" <?php echo ($limit=="100"?"selected":""); ?>>100</option>
      <option value="200" <?php echo ($limit=="200"?"selected":""); ?>>200</option>
      <option value="500" <?php echo ($limit=="500"?"selected":""); ?>>500</option>
      <option value="700" <?php echo ($limit=="700"?"selected":""); ?>>700</option>
      <option value="1000" <?php echo ($limit=="1000"?"selected":""); ?>>1000</option>
      </select>
    Page
    <input name="fpage" type="text" class="table_text1" id="fpage" value="<?php echo $pageNo; ?>" style="width:40px;" size="3"/>
    of
    <input name="tpages" type="text" class="table_text1" id="tpages" value="<?php echo $npages; ?>" style="width:40px" size="3"/>
    &nbsp; </td>
  <td width="271" align="left"><input name="search22" type="button" class="btn" id="search22" onclick="javascript:doSearch('project_log.php');" value="Go" /></td>
  <td width="49" colspan="-2" align="right"><span>&nbsp;</span></td>
  <td width="186" align="left">&nbsp;</td>
  <td width="34" colspan="-2"><span class="table_text1"><a href="#" onclick="javascript: goFirst('project_log.php');"><img src="images/first.png" alt="First" width="24" height="24" border="0" /></a></span></td>
  <td width="32" colspan="-2"><span class="table_text1"><a href="#" onclick="javascript: goPrevious('project_log.php');"><img src="images/prev.png" alt="Previous" width="24" height="24" border="0" /></a></span></td>
  <td width="32" colspan="-2"><span class="table_text1"><a href="#" onclick="javascript: goNext('project_log.php');"><img src="images/next.png" alt="Next" width="24" height="24" border="0"/></a></span></td>
  <td width="63" colspan="-2"><span class="table_text1"><a href="#" onclick="javascript: goLast('project_log.php');"><img src="images/last.png" alt="Last" width="24" height="24" border="0"/></a></span></td>
</tr>
</table>

<div id="testdiv" style="display:none">
    <div>TEST</div>
    <div id="hidediv">TEST2</div>
</div>

<table width="100%">
  <tr>
  <input name="print" type="button" class="btn" id="search" onclick="printDiv('print_div');" value="Print">
  
  &nbsp;&nbsp;<input name="print" type="button" class="btn" id="PDF" onclick="javascript:genPDF();" value="PDF">
  </tr>
</table>
</div>
                       
<div style="overflow-x:scroll" id="print_div">
   <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />  
    <!--[if lt IE 8]>
        <link href="css/ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->            
    <link rel='stylesheet' type='text/css' href='css/fullcalendar.print.css' media='print' />
    <table class="table"  width="100%">
      <thead>
        <tr class="ewTableHeader">
           <th nowrap="nowrap" class="Odd">S/N</th>
           <th nowrap="nowrap" class="Odd">Staff</th>
          <th nowrap="nowrap" class="Odd">Project Name</th>
          <th nowrap="nowrap" class="Odd">Target</th>
          <th nowrap="nowrap" class="Odd">Work Done</th>
          <th nowrap="nowrap" class="Odd">Project Status</th>
           <th nowrap="nowrap" class="Odd">Created Date</th>
          <th nowrap="nowrap">hod Appraisal</th>
          <th nowrap="nowrap">Appraisal Date</th>
          <th nowrap="nowrap">ps Appraisal</th>
          <th nowrap="nowrap">Appraisal Date</th>
          <th nowrap="nowrap">pm Appraisal</th>
          <th nowrap="nowrap">Appraisal Date</th>
          <th nowrap="nowrap">Gh Appraisal</th>
          <th nowrap="nowrap">Appraisal Date</th>
          <th nowrap="nowrap">&nbsp;</th>
        </tr>
      </thead>
 
      <?php 
		  $skip = $maxPage * ($pageNo-1);
			$k = 0;
		  
 		 for($i=0; $i<$skip; $i++){
				$row = mysql_fetch_array($result);
				//echo 'count '.$i.'   '.$skip;
			} 
  
  			while($k<$maxPage && $numrows>($k+$skip)) {
			$k++;
			//for($i=0; $i<$numrows; $i++){
				$row = mysql_fetch_array($result);
				//while($i < $skip) continue;
				//echo 'count '.$i.'   '.$skip;
				$project_id=$row["project_id"];	
			$project_name=$dbobject->getitemlabel('project','project_id',$project_id,'project_name');
			$status_id=$row["work_status"];	
			$status_name=$dbobject->getitemlabel('project_status','status_id',$status_id,'status_name');
			?>
      <tr <?php echo ($k%2==0)?"class='treven'":"class='trodd'"; ?> >
        <td nowrap="nowrap" align="center"><?php echo $k+$skip;?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["username"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $project_name;?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["target"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["work_done"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $status_name;?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["created"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["hod_appraisal"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo ( $row["hod_appraisal_date"] == '0000-00-00 00:00:00')? '-' : $row["hod_appraisal_date"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["ps_appraisal"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo ( $row["ps_appraisal_date"] == '0000-00-00 00:00:00')? '-' : $row["ps_appraisal_date"];?></td>
          <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["pm_appraisal"];?></td> 
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo ( $row["pm_appraisal_date"] == '0000-00-00 00:00:00')? '-' : $row["pm_appraisal_date"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo $row["gh_appraisal"];?></td>
        <td nowrap="nowrap" style="border-right:0px; border-left:0px"><?php echo ( $row["gh_appraisal_date"] == '0000-00-00 00:00:00')? '-' : $row["gh_appraisal_date"];?></td>  <td nowrap="nowrap">	
                            <?php   if($role_id == 002){   ?>
							 
								 <a href="javascript:getpage('ap_gh.php?op=edit&amp;id=<?php echo $row["id"];?>','page')"><font color="#33CC00">Appraise</font></a>
								 
								<?php  }else   if($role_id == 004){ ?>
							   
								 <a href="javascript:getpage('ap_ps.php?op=edit&amp;id=<?php echo $row["id"];?>','page')"><font color="#33CC00">Appraise</font></a>
								 
							<?php	  }else  if($role_id == 005){  ?>
							 
								 <a href="javascript:getpage('ap_hod.php?op=edit&amp;id=<?php echo $row["id"];?>','page')"><font color="#33CC00">Appraise</font></a>
								 
								<?php  }else if($role_id == 006) {   ?>
							 
								 <a href="javascript:getpage('ap_pm.php?op=edit&amp;id=<?php echo $row["id"];?>','page')"><font color="#33CC00">Appraise</font></a>
								 
								<?php  }else{  ?>
      
      <?php   } ?>
        
        </td>
      </tr>
      <?php 
				} //End If Result Test	
		  ?>
    </table>
    <?php
	
                        if(mysql_num_rows($result)==0)
							  {
								  echo "<div align='center'>No Records Found</div>";
								  }

						?>
</div>
                       
                            
                        </div>
                    </div>                                

                </div>
<script type="text/javascript">
  $(document).ready(function() {
  $('#dw').click(function(){
  var sql = $('#sql').val();
  var type= $('#types').val();
  var sql_json = JSON.stringify(sql);
  window.location = "autovin_settle_dw.php?sql="+sql_json+"&type="+type;
  }); 
  });

</script>