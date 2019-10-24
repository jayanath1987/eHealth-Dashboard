<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
Author: Mr. Jayanath Liyanage
Consultant: Dr.Indika Jagoda
URL: http: www.icta.lk
----------------------------------------------------------------------------------
*/
class Dashboard extends MX_Controller {
    

    public $date;

            function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->load->library('session');
                global $date;
                $date = date("Y-m-d");
                //$date = "2017-01-31";
	 }

	public function index()
	{

	}
        public function dashboard_home()
	{
            $this->load->view('dashboard_home');
	}
	 public function get_current_bht($cbht=null){
		$this->load->model('mpersistent');
        $data1["hospital_info"] = $this->mpersistent->open_id($this->session->userdata("HID"), "hospital", "HID");
		if ($cbht) {
			$hbht =$cbht;
		}
		else{
			$hbht =$data1["hospital_info"]["Current_BHT"];
		}
		//print_r($data1["hospital_info"]["Current_BHT"]);
		$data = explode('/',$hbht);
		if (count($data) != 3) $bht = "Error";
		$year = date('Y');
		$day = date('d');
		$y = $data[0];
		$y_count = $data[1];
		$m_count = $data[2];
		if ( $day == 1) $m_count = 1;
		if ($y == $year-1) { $y_count = 0;  $m_count = 0; };
		$bht = $year."/".++$y_count."/".++$m_count;
		//echo $bht;
		return $bht;
	}
        
        public function dashboard_opd()
	{			
		if (!Modules::run('security/check_view_access','drug_stock','can_view')){
			$data["error"] =" User group '".$this->session->userdata('UserGroup')."' have no rights to view this data";
			$this->load->vars($data);
			$this->load->view('drug_stock_error');
			exit;
		}	
		
		
		//$this->load->vars($data);
		$this->load->view('dashboard_opd');		
	}
        public function dashboard_triage()
	{			
		if (!Modules::run('security/check_view_access','drug_stock','can_view')){
			$data["error"] =" User group '".$this->session->userdata('UserGroup')."' have no rights to view this data";
			$this->load->vars($data);
			$this->load->view('drug_stock_error');
			exit;
		}	
		
		
		//$this->load->vars($data);
		$this->load->view('dashboard_triage');		
	}
        
                public function dsview($drug_stock_id=NULL)
	{			
		if (!Modules::run('security/check_view_access','drug_stock','can_view')){
			$data["error"] =" User group '".$this->session->userdata('UserGroup')."' have no rights to view this data";
			$this->load->vars($data);
			$this->load->view('drug_stock_error');
			exit;
		}	
		
		
		//$this->load->vars($data);
		$this->load->view('ds_view');		
	}
        
        public function get_xray_count(){
		$this->load->model('mdashboard');
                global $date;
		$data = $this->mdashboard->get_xray_count($date);
                $json = json_encode($data);
		echo $json ;
	}
        
        public function get_Patient_count(){
		$this->load->model('mdashboard');
                global $date;
		$data = $this->mdashboard->get_Patient_count($date);
                $json = json_encode($data);
		echo $json ;
	}
        
        
        public function get_Phamacy_count(){
		$this->load->model('mdashboard');
                global $date;
		$data = $this->mdashboard->get_Phamacy_count($date);
                $json = json_encode($data);
		echo $json ;
	}
        public function get_Missing_Patient_count(){
		$this->load->model('mdashboard');
                global $date;
		$data = $this->mdashboard->get_Missing_Patient_count($date);
                $json = json_encode($data);
		echo $json ;
	}
        public function get_OPD_count(){
		$this->load->model('mdashboard');
                global $date;
		$data = $this->mdashboard->get_OPD_count($date);
                $json = json_encode($data);
		echo $json ;
	}        
        
        public function get_Doctor_count(){
		$this->load->model('mdashboard');
                global $date;
		$data["Total"] = $this->mdashboard->get_Doctor_count($date);
		$json = json_encode($data["Total"]);
		echo $json ;
	}
        
        public function get_Houly_Chart(){
		$this->load->model('mdashboard');
                global $date;
                $data = array();
		$data = $this->mdashboard->get_Houly_Chart($date);
		echo json_encode($data);
		
	}
        
        public function waiting_Chart_OPD(){
		$this->load->model('mdashboard');
                global $date;
                $data = array();
		$data = $this->mdashboard->waiting_Chart_OPD($date);
		echo json_encode($data);
		
	}
        
        public function encounter_Chart(){
		$this->load->model('mdashboard');
                global $date;
                $data = array();
		$data = $this->mdashboard->encounter_Chart($date);
		echo json_encode($data);
		
	}
        
        public function waiting_Chart_pharmacy(){
		$this->load->model('mdashboard');
                global $date;
                $data = array();
		$data = $this->mdashboard->waiting_Chart_pharmacy($date);
		echo json_encode($data);
		
	}
        public function get_Specific_Cause(){
		$this->load->model('mdashboard');
                global $date;
                $data = array();
		$data = $this->mdashboard->get_Specific_Cause($date);
		echo json_encode($data);
		
	}
        
        public function get_Daily_Count(){
		$this->load->model('mdashboard');
                global $date;
                $data = array();
                $yest = date('Y-m-d',strtotime("-1 days"));
		$data["0"] = $this->mdashboard->get_Daily_Count($yest);
                $data["1"] = $this->mdashboard->get_Daily_Count($date);
                //die(print_r($data));
		echo json_encode($data);
		
	}
        
        public function get_Average_Treat_Time(){
		$this->load->model('mdashboard');
		global $date;
                $data = $this->mdashboard->get_Average_Treat_Time($date);
                $total = 0;
                $average = 0;
                if(isset($data) && count($data)){
                        $j=0;
			for($i=0; $i < count($data); ++$i){
					
				if ($data[$i]['c'] >= 1){
                                        
                                        $total = $total + $data[$i]['t'];
                                        ++$j;
				}
			}
                        if($j > 0){
                        $average = $total/$j;
                        }  else {
                            $average = 0;
                            
                        }
		}
                $time=round($average);
                
                $hour = $time / 3600 % 24;    // to get hours
                $minute = $time / 60 % 60;    // to get minutes
                $second = $time % 60;         // to get seconds

                
		$json = json_encode($hour.":".$minute.":".$second);
		echo $json ;
	}
} 


//////////////////////////////////////////

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */