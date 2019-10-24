
<?php
/*
  --------------------------------------------------------------------------------
  HHIMS - Hospital Health Information Management System
  Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
  <http: www.icta.lk />
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
  Author: Mr. Jayanath Liyanage
  Consultant: Dr.Indika Jagoda
  URL: http: www.icta.lk
  ----------------------------------------------------------------------------------
 */

include_once("header.php"); ///loads the html HEAD section (JS,CSS)
?>
<?php //echo Modules::run('menu'); //runs the available menu option to that usergroup  ?>

<script language="javascript">
    $(window).load(function () {

        get_Patient_count(50000);
        get_xray_count(50000);
        get_Missing_Patient_count(3000000);
        get_Doctor_count(50000);
        get_Average_Treat_Time(50000);
        //get_Houly_Chart(3000000);
        //get_Daily_Count(3000000);
        get_Specific_Cause(3000000);
        get_Phamacy_count(50000);
        waiting_Chart_OPD(3000000);
        waiting_Chart_pharmacy(3000000); 
        encounter_Chart(3000000);

    });

    function get_Phamacy_count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Phamacy_count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                //obj = 20;
                //console.log(obj);
                $("#Phamacycount").text(obj);
                setTimeout(
                        get_Phamacy_count,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setTimeout(
                        get_Phamacy_count,
                        15000);
            }
        });
    }
    
    function get_Missing_Patient_count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_OPD_count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                //console.log(obj);
                //obj = 40;
                $("#OPDQue").text(obj);
                setTimeout(
                        get_Missing_Patient_count,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setTimeout(
                        get_Missing_Patient_count,
                        15000);
            }
        });
    }
    
    function get_Specific_Cause(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Specific_Cause/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {

                var obj = JSON.parse(data);
                var tot = 0;
                var dataa = new Array();
//console.log(obj);
                obj.forEach(function (entry) {
                    tot += parseInt(entry['sum']);
                });

                $("#Complain_Chart_OPD").empty();
                console.log(dataa);
                Morris.Donut({
                    element: 'Complain_Chart_OPD',
                    data: [
                        {value: ((parseInt(obj[0]['sum']) / tot)*100).toFixed(2), label: obj[0]['Complaint']},
                        {value: ((parseInt(obj[1]['sum']) / tot)*100).toFixed(2), label: obj[1]['Complaint']},
                        {value: ((parseInt(obj[2]['sum']) / tot)*100).toFixed(2), label: obj[2]['Complaint']},
                        {value: ((parseInt(obj[3]['sum']) / tot)*100).toFixed(2), label: obj[3]['Complaint']},
                        {value: ((parseInt(obj[4]['sum']) / tot)*100).toFixed(2), label: obj[4]['Complaint']},
                    ],
                    backgroundColor: '#ccc',
                    labelColor: [
                        'OLIVE',
                        'AQUA',
                        'LIME',
                        'SILVER',
                        'MAROON'
                    ],
                    colors: [
                        'OLIVE',
                        'AQUA',
                        'LIME',
                        'SILVER',
                        'MAROON'
                    ],
                    formatter: function (x) {
                        return x + "%"
                    }
                });

                setTimeout(
                        get_Specific_Cause,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        get_Specific_Cause,
                        15000);
            }
        });
    }

    function get_Daily_Count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Daily_Count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {

                var obj = JSON.parse(data);

                //console.log(obj[0][0]["t1"]);
                $("#dailycount").empty();

                var html = '<table class="table table-bordered table-hover table-striped"><thead>' +
                        '<tr><th>T L</th><th>Yest</th><th>Today</th><th>AVG</th></tr></thead>' +
                        '<tbody><tr><td style="background-color: red">1</td><td>' + obj[0][0]["t1"] + '</td><td>' + obj[1][0]["t1"] + '</td><td>0</td></tr>' +
                        '<tr><td style="background-color: orange">2</td><td>' + obj[0][0]["t2"] + '</td><td>' + obj[1][0]["t2"] + '</td><td>0</td></tr>' +
                        '<tr><td style="background-color: yellow">3</td><td>' + obj[0][0]["t3"] + '</td><td>' + obj[1][0]["t3"] + '</td><td>0</td></tr>' +
                        '<tr><td style="background-color: green">4</td><td>' + obj[0][0]["t4"] + '</td><td>' + obj[1][0]["t4"] + '</td><td>0</td></tr>' +
                        '<tr><td style="background-color: black">5</td><td>' + obj[0][0]["t5"] + '</td><td>' + obj[1][0]["t5"] + '</td><td>0</td></tr>' +
                        '<tr><td style="background-color: white">Tot</td><td>' + obj[0][0]["tot"] + '</td><td>' + obj[1][0]["tot"] + '</td><td>0</td></tr></tbody></table>';

                $("#dailycount").append(html);
                setTimeout(
                        get_Daily_Count,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        get_Daily_Count,
                        15000);
            }
        });
    }

    function get_Houly_Chart(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Houly_Chart/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                var day_data = obj;

//console.log(day_data);
                $("#graph-line").empty();
                Morris.Line({
                    element: 'graph-line',
                    data: day_data,
                    parseTime: false,
                    xkey: 'time',
                    ykeys: ['t1', 't2', 't3', 't4', 't5'],
                    lineColors: ['red', 'orange', 'yellow', 'green', 'black'],
                    labels: ['1=>red', '2=>orange', '3=>yellow', '4=>green', '5=>black'],
                    xLabelAngle: 60
                });




                setTimeout(
                        get_Houly_Chart,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        get_Houly_Chart,
                        15000);
            }
        });
    }
    
        function encounter_Chart(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/encounter_Chart/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                var day_data = obj;
                
                day_data = [{"date":"2016-08-01","tot":1},{"date":"2016-08-02","tot":1},{"date":"2016-08-03","tot":1},{"date":"2016-08-05","tot":2},{"date":"2016-08-05","tot":1}]


/*                $("#encounter_Chart").empty();
                Morris.Line({
                    element: 'encounter_Chart',
                    data: day_data,
                    parseTime: false,
                    xkey: 'date',
                    ykeys: ["tot"],
                    lineColors: ["red"],
                    labels: ["tot"],
                    xLabelAngle: 60 */
        
         $("#encounter_Chart").empty();
                Morris.Line({
                    element: 'encounter_Chart',
                    data: obj,
                    parseTime: false,
                    xkey: ["date"],
                    ykeys: ["count"],
                    lineColors: ["red"],
                    labels: ["count"],
                    xLabelAngle: 60 
                });




                setTimeout(
                        encounter_Chart,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        encounter_Chart,
                        15000);
            }
        });
    }    
    
        function waiting_Chart_OPD(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/waiting_Chart_OPD/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                var day_data = obj;

//console.log(day_data);
                $("#waiting_Chart_OPD").empty();
                Morris.Line({
                    element: 'waiting_Chart_OPD',
                    data: day_data,
                    parseTime: false,
                    xkey: 'time',
                    ykeys: ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
                    lineColors:  ['Aqua', 'Blue', 'Chartreuse', 'Coral', 'DarkGreen','DarkOrange',"Red"],
                    labels: ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
                    xLabelAngle: 60
                });




                setTimeout(
                        waiting_Chart_OPD,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        waiting_Chart_OPD,
                        15000);
            }
        });
    }
    
    
    function waiting_Chart_pharmacy(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/waiting_Chart_pharmacy/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                var day_data = obj;

//console.log(day_data);
                $("#waiting_Chart_pharmacy").empty();
                Morris.Line({
                    element: 'waiting_Chart_pharmacy',
                    data: day_data,
                    parseTime: false,
                    xkey: 'time',
                    ykeys: ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
                    lineColors:  ['Aqua', 'Blue', 'Chartreuse', 'Coral', 'DarkGreen','DarkOrange',"Red"],
                    labels: ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
                    xLabelAngle: 60
                });




                setTimeout(
                        waiting_Chart_pharmacy,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        waiting_Chart_pharmacy,
                        15000);
            }
        });
    }
    
    function get_xray_count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_xray_count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                //console.log(obj);
                $("#xraycount").text(obj);
                setTimeout(
                        get_xray_count,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setTimeout(
                        get_xray_count,
                        15000);
            }
        });
    }
    function get_Patient_count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Patient_count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {

                var obj = JSON.parse(data);
                //console.log(obj);
                $("#patientcount").text(obj);
                setTimeout(
                        get_Patient_count,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        get_Patient_count,
                        15000);
            }
        });
    }

    function get_Doctor_count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Doctor_count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {

                var obj = JSON.parse(data);
                //console.log(obj);
                $("#doctorcount").text(obj);
                setTimeout(
                        get_Doctor_count,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        get_Doctor_count,
                        15000);
            }
        });
    }


    function get_Average_Treat_Time(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Average_Treat_Time/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {

                var obj = JSON.parse(data);
                //console.log(obj);
                $("#averagetreattime").empty();
                $("#averagetreattime").text(obj);
                setTimeout(
                        get_Average_Treat_Time,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                setTimeout(
                        get_Average_Treat_Time,
                        15000);
            }
        });
    }
</script>

<html style="height: 95%;">
    <body style="height: 100%; margin: 5px 5px 5px 5px; ">
<table border="0" style="height: 100%; width: 100%; ">
<tr  style="height: 20%; width: 100%;">
    <td style="height: 20%;  width: 16.66%;">
                    
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-ambulance fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="patientcount" class="huge"></div>
                                <div>Patient Count</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <!-- <span class="pull-left">View Details</span> -->
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>     
        
    </td>
<td style="height: 20%;  width: 16.66%;">
                    <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-film fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="xraycount" class="huge">12</div>
                                <div>Xrays</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <!-- <span class="pull-left">View Details</span> -->
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
</td>
<td style="height: 20%;  width: 16.66%;">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-stethoscope fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="doctorcount" class="huge"></div>
                                <div >Doctors</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <!-- <span class="pull-left">View Details</span> -->
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>    
</td>
<td style="height: 20%;  width: 16.66%;">
                   <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-clock-o fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="averagetreattime" class="huge">0</div>
                                <div>Avg Treat Time</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <!-- <span class="pull-left">View Details</span> -->
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div> 
</td>
<td style="height: 20%;  width: 16.66%;">
                    <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-male fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="OPDQue" class="huge">0</div>
                                <div>OPD Que</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <!-- <span class="pull-left">View Details</span> -->
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
</td>
<td style="height: 20%;  width: 16.66%;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-medkit fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="Phamacycount" class="huge">0</div>
                                <div>Pharmacy Que</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <!-- <span class="pull-left">View Details</span> -->
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>    
</td>
</tr>
<tr style="height: 40%;  width: 100%;">
    <td colspan="3" style=" width: 50%;">
                        <div class="panel panel-primary" style="height: 95%;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Last 7 days OPD Patient Distribution on Hourly Basis</h3>
                    </div>
                    <div class="panel-body">
                        <div id="waiting_Chart_OPD"></div>
                        <script type='text/javascript' >

                        </script>
                        <div class="text-right">

                        </div>
                    </div>
                </div>
    </td>
    <td colspan="3" style=" width: 50%;">
                        <div class="panel panel-green" style="height: 95%;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Last 7 Days Dispensary Que Distribution on Hourly Basis</h3>
                    </div>
                    <div class="panel-body">
                        <div id="waiting_Chart_pharmacy"></div>
                        <script type='text/javascript' >

                        </script>
                        <div class="text-right">

                        </div>
                    </div>
                </div>
    </td>

</tr>
<tr  style="height: 40%; width: 100%; ">
<td colspan="3" style=" width: 50%;">
    <div class="panel panel-red" style="height: 95%;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Today Progressive Complain Chart</h3>
                    </div>
                    <div class="panel-body">
                        <div id="Complain_Chart_OPD"></div>
                        <script type='text/javascript' >

                        </script>
                        <div class="text-right">

                        </div>
                    </div>
                </div>
</td>
<td colspan="3" style=" width: 50%;">
                <div class="panel panel-yellow" style="height: 95%;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> No of Patient Served during last 7 Days</h3>
                    </div>
                    <div class="panel-body">
                        <div id="encounter_Chart"></div>
                        <script type='text/javascript' >

                        </script>
                        <div class="text-right">

                        </div>
                    </div>
                </div>
</td>
</tr>
</table>
</body>


