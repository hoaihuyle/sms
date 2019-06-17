<?php 

class Model_Schedule extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	/*
	*----------------------------------------------
	* create the attendance 
	* for student and teacher
	*----------------------------------------------
	*/
	public function createSchedule()
	{	
	
		// student
		for($x = 1; $x <= count($this->input->post('subjectId')); $x++) {						

			$this->db->delete('schedule', array(
				'schedule_date' => $this->input->post('schedule_date'), 
				// 'schedule_type' => $this->input->post('classId'), 
				'section_id' => $this->input->post('sectionId'), 
				'subject_id' => $this->input->post('subjectId')[$x]
			));

			$insert_data = array(				
				'schedule_type' 	=> $this->input->post('schedule_status')[$x],
				'subject_id'		=> $this->input->post('subjectId')[$x],						
				// 'class_id'			=> $this->input->post('classId'),
				'section_id'        => $this->input->post('sectionId'),
				'schedule_date'	=> $this->input->post('schedule_date'),		
			);

			$status = $this->db->insert('schedule', $insert_data);						
		} // /for

		return ($status == true ? true : false);
	
			
	}

	/*
	*----------------------------------------------
	* create the attendance 
	* for student and teacher
	*----------------------------------------------
	*/
	public function fetchSchedule($subjectId = null, $sectionId = null, $date = null)
	{		
		// student
		if($subjectId && $sectionId && $date) {
			$sql = "SELECT * FROM schedule WHERE  subject_id = ? AND section_id = ? AND schedule_date = ? ";
			$query = $this->db->query($sql, array($subjectId, $sectionId, $date));
			return $query->row_array();
		}

	}


	public function getAttendance($day = null, $reportDate = null, $subjectId = null,  $sectionId = null) {				
		
		$year = substr($reportDate, 0, 4);
		$month = substr($reportDate, 5, 7);					

		if($day < 10) {
			$day = "0".$day;
		} else {
			$day = $day;
		}
			
		$sql = "SELECT * FROM schedule WHERE 
			date_format(schedule_date, '%Y-%m-%d') = '{$year}-{$month}-{$day}'		
			AND section_id = {$sectionId}
			AND subject_id = {$subjectId}						
		";
		$query = $this->db->query($sql);
		return $query->result_array();
		
		
			
	}

	public function fetchScheduleData($subId = null)
	{
		if($subId) {
			$sql = "SELECT sh.*, s.*, t.id FROM schedule as sh INNER JOIN subject as s ON sh.subject_id = s.subject_id LEFT JOIN timetable as t ON t.schedule_id = sh.schedule_id WHERE sh.subject_id = ? AND schedule_date > NOW()";
			$query = $this->db->query($sql, array($subId));
			return $query->result_array();
		} // /if
	}
	

}