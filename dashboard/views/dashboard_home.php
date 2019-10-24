
<?php
/*
--------------------------------------------------------------------------------
HHIMS - Hospital Health Information Management System
Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
<http: www.hhims.org/>
----------------------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify it under the
terms of the GNU Affero General Public License as published by the Free Software 
Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along 
with this program. If not, see <http://www.gnu.org/licenses/> 




---------------------------------------------------------------------------------- 
Date : July 2017
Author: Mr. Jayanath Liyanage   jayanathl@icta.lk
Consultant: Dr.Indika Jagoda
Programme Manager: Shriyananda Rathnayake
URL: http://www.govforge.icta.lk/gf/project/hhims/
----------------------------------------------------------------------------------
*/

include_once("header.php");	///loads the html HEAD section (JS,CSS)

?>
<?php echo Modules::run('menu'); //runs the available menu option to that usergroup ?>

	<div class="container" style="width:95%;">
		<div class="row" style="margin-top:55px;">
		  <div class="col-md-2 ">
			<?php //echo Modules::run('leftmenu/questionnaire'); //runs the available left menu for preferance ?>
			<?php 
					echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance 
			?>
		  </div>
                    
		  <div class="col-md-10 ">
		  		<?php 
					if (isset($error)){
						echo '<div class="alert alert-danger"><b>ERROR:</b>'.$error.'</div>';
						exit;
					}
					
				?>		  
				<div class="panel panel-default"  >
					<div class="panel-heading"><b>Dashboard Management </b>
					</div>
					<div class="well well-sm">
                                          <table style="width:100%;" >
                                            <tr>
                                                <th>

                                                    
                                                </th>

                                            </tr>
                                            <tr>
                                                <td>
                                                <!-- OPD Dashboard-->    
                                                    <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-tachometer fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div id="patientcount" class="huge"></div>
                                                                <div><font size="6"><b>OPD Dashboard</b></font></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <a href="<?php echo site_url("dashboard/dashboard_opd"); ?>" target="_blank">
                                                        <div class="panel-footer">
                                                             <span class="pull-left">View Details</span> 
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                                 <!-- End OPD Dashboard-->    
                                                </td>
                                                <td>
                                                    <!-- Triage Dashboard-->    
                                                    <div class="panel panel-red">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-tachometer fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div id="patientcount" class="huge"></div>
                                                                <div><font size="6"><b>Triage Dashboard</b></font></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo site_url("dashboard/dashboard_triage"); ?>" target="_blank">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span> 
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                                 <!-- End Triage Dashboard-->                                                       
                                                    
                                                </td> 
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                   <!--Clinic Dashboard-->    
                                                    <div class="panel panel-green">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-tachometer fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div id="patientcount" class="huge"></div>
                                                                <div><font size="6"><b>Clinic Dashboard</b></font></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                                 <!-- End Clinic Dashboard-->  
                                                    
                                                    
                                                </td>
                                                <td>
                                                    <!--End Ward Dashboard-->    
                                                    <div class="panel panel-yellow">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-tachometer fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div id="patientcount" class="huge"></div>
                                                                <div><font size="6"><b>Ward Dashboard</b></font></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                                 <!-- End Ward Dashboard--> 
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                              <td></td>
                                              <td></td> 
                                            </tr>
                                          </table>  
                                                                

						
					</div>
				</div>
                  </div>
                </div>
        </div>
                      
	