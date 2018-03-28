<table width="100%" border="0" cellspacing="0" cellpadding="5" id="list_table">
            <tr>
              <td width="721" colspan="4" id="">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" style="padding:0px !important;"><table width="100%" border="0" cellspacing="0" id="list_table" class="table" style="border-color:#CCC !important;">
                <tr>
                  <td width="97" align="right" nowrap="nowrap">Project ID :</td>
                  <td align="left" class="fdtddd">
                    <input type="text" name="project_id" id="project_id" value="<?php echo $project_id; ?>" class="required-text form-control" readonly="true"title="Project ID"/>
                  </td>
                  <td align="left" nowrap="nowrap">Staff Name :</td>
                  <td align="left" class="fdtddd"> <input type="text" name="username" id="username" value="<?php echo $username; ?>" class="required-text form-control" readonly="true"/></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap">Work Status : </td>
                  <td width="380" align="left" class="fdtddd"><input type="text" name="work_status" id="work_status" value="<?php echo $work_status; ?>" class="required-text form-control" readonly="true"/></td>
                  <td width="167" align="right" nowrap="nowrap">Date Created :</td>
                  <td width="380" align="left" class="fdtddd"><input type="text" name="created" id="created" value="<?php echo $created; ?>" class="required-text form-control" readonly="true"/></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap">Target :</td>
                  <td align="left" class="fdtddd"><textarea name="target" id="target" value="<?php echo $target; ?>" class="required-text form-control" readonly="true"><?php echo $target; ?></textarea></td>
                  <td align="right" nowrap="nowrap">Work Done :</td>
                  <td align="left" class="fdtddd"><textarea cols="1" rows="1" name="work_done" id="work_done" value="<?php echo $work_done; ?>" class="required-text form-control" readonly="true"><?php echo $work_done; ?></textarea></td>
                </tr>
                
                <tr>
              <td colspan="4" align="left" id="" style="padding:0px !important;">
                                   <div class="widget teal"><header> <h4 class="title"><span class="icon icone-lock"></span>Appriasals</h4></header></div></td>
            </tr>
            <td colspan="4" style="padding:0px !important;"><table width="100%" border="0" cellspacing="0" cellpadding="5" id="list_table" class="table">
<tr>
                  <td align="right" colspan="2" nowrap="nowrap">PS Appraisal :</td>
                  <td align="left" colspan="2" class="fdtddd"> <textarea cols="1" rows="1" name="ps_appraisal" id="ps_appraisal" value="<?php echo $ps_appraisal; ?>" class="required-text form-control" readonly="true"><?php echo $ps_appraisal; ?></textarea></td>
                  <td align="right" colspan="2" nowrap="nowrap">PM Appraisal :</td>
                  <td align="left" colspan="2" class="fdtddd"><textarea cols="1" rows="1" name="pm_appraisal" id="pm_appraisal" value="<?php echo $pm_appraisal; ?>" class="required-text form-control" readonly="true"><?php echo $pm_appraisal; ?></textarea>
                  <td width="167" align="right" nowrap="nowrap">PS Appraisal Date :</td>
                  <td width="380" align="left" class="fdtddd"><input type="text" name="ps_appraisal_date" id="ps_appraisal_date" value="<?php echo $ps_appraisal_date; ?>" class="required-text form-control" readonly="true"/></td>
                  <td width="167" align="right" nowrap="nowrap">PM Appraisal Date :</td>
                  <td width="380" align="left" class="fdtddd"><input type="text" name="pm_appraisal_date" id="pm_appraisal_date" value="<?php echo $pm_appraisal_date; ?>" class="required-text form-control" readonly="true"/></td>
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