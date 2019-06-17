<?php 

class Model_TimeTable extends CI_Model 
{	

	public function __construct()
	{
		parent::__construct();

		// classes 
		$this->load->model('model_classes');
		// section
		$this->load->model('model_section');
		// student
		$this->load->model('model_student');
		// subject
		$this->load->model('model_subject');
	}

	public function create($scheduleId = null, $studentId = null)
	{
		if($scheduleId && $studentId)
		{
			$sql = "insert into timetable (schedule_id, student_id)
	        values (?,?)";
			$status =$this->db->query($sql,array($scheduleId,$studentId));	
			return ($status === true ? true : false);
		}
		return false;
	} // /.create marksheet function


	public function remove($scheduleId = null, $studentId = null)
	{
		if($scheduleId && $studentId)
		{
			$sql = "delete from timetable where schedule_id=? AND student_id= ?";
			$status =$this->db->query($sql,array($scheduleId,$studentId));	
			return ($status === true ? true : false);
		}
		return false;
	} // /.create marksheet function



}