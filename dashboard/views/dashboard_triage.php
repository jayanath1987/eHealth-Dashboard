
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
        get_Houly_Chart(3000000);
        get_Daily_Count(3000000);
        get_Specific_Cause(3000000);

    });

    function get_Missing_Patient_count(timeout) {

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>index.php/dashboard/get_Missing_Patient_count/",
            async: true,
            cache: false,
            timeout: timeout,
            success: function (data) {
                var obj = JSON.parse(data);
                //console.log(obj);
                $("#missingpatientcount").text(obj);
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

                $("#graph-donut").empty();
                console.log(dataa);
                Morris.Donut({
                    element: 'graph-donut',
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
<div id="" style="text-align: center; font-weight: bold;  font-size: 24px; color: #ffffff" >Accident Service - National Hospital of Sri Lanka Performance Dash Board</div>
</br>
<div id="page-wrapper">




    <div class="container-fluid">



        <div class="row">
            <div class="col-lg-2 col-md-6">
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
            </div>
            <div class="col-lg-2 col-md-6">
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
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-medkit fa-5x"></i>
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
            </div>
            <div class="col-lg-2 col-md-8">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-clock-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="averagetreattime" class="huge">13</div>
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
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-male fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="missingpatientcount" class="huge">0</div>
                                <div>D.N.W.T</div>
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
            </div>
        </div>
        <!-- /.row -->

        <!--   <div class="row">
               <div class="col-lg-12">
                   <div class="panel panel-default">
                       <div class="panel-heading">
                           <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Treat Chart</h3>
                       </div>
                       <div class="panel-body">
                           <div id="morris-area-chart"> </div>
                       </div>
                   </div>
               </div>
           </div> -->

        <div class="row"> 
            <div class="col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Hourly Triage Summary</h3>
                    </div>
                    <div class="panel-body">
                        <div id="graph-line"></div>
                        <script type='text/javascript' >

                        </script>
                        <div class="text-right">

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-2">
                <div class="panel panel-success">    
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Treatment Average</h3>
                    </div>    
                    <div class="panel-body">
                        <div class="table-responsive" id="dailycount">

                        </div>
                        <div class="text-right">
                          <!--  <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                </div> 
            </div>   

            <div class="col-lg-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Specific Cause</h3>
                    </div>
                    <div class="panel-body">
                        <div id="graph-donut"></div>

                        <script type='text/javascript' >
                            /*
                             Morris.Donut({
                             element: 'graph-donut',
                             data: [
                             {value: 70, label: 'Sharp Object'},
                             {value: 15, label: 'Blunt Object'},
                             {value: 10, label: 'Firearm'},
                             {value: 10, label: 'Explosion'},
                             {value: 5, label: 'Push/Kick/Fist'},
                             {value: 10, label: 'Burn'},
                             {value: 5, label: 'Choking/Strangulation'},
                             {value: 5, label: 'Unknown'}   
                                    
                                    
                             ],
                             backgroundColor: '#ccc',
                             labelColor: [
                             'red',
                             'orange',
                             'yellow',
                             'green',
                             'black'
                             ],
                             colors: [
                             '#1424b8',
                             '#0aa623',
                             '#940f3f',
                             '#148585',
                             '#098215',
                             '#b86c14',
                             '#586c14',
                             '#e83214'
                             ],
                             formatter: function (x) { return x + "%"}
                             }); */

                        </script>
                        <div class="text-right">

                        </div>
                    </div>
                </div>
            </div>                    



            <!-- /.row -->                   
        </div>


    </div>
</div>
</div>
<!--                </div> -->
<!-- /.row -->


<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>