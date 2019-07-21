<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Schedules extends BD_Model{

	function __construct()
    {
        parent::__construct();
        $this->tableName = 'schedule';
	}

	function getAllSchedules(){
        // $query = $this->db->query("SELECT `scheduleTime_sciId` ,DATE_FORMAT(`scheduletime_sci`.`start_date`, '%Y-%m-%d') AS `start_date`, DATE_FORMAT(`scheduletime_sci`.`end_date`, '%Y-%m-%d') AS `end_date` FROM `scheduletime_sci`");
        $query = $this->db->query("SELECT `schedule_id`, date_format(start_date, '%d/%m/%Y') as start_date, date_format(end_date, '%d/%m/%Y') as end_date FROM `schedule`");
        return json_encode($query->result());
    }

    // function getScheduleByYear($search){
    //   $query = $this->db->query("SELECT year, schedule, start_date, end_date, CONCAT( DATE_FORMAT( start_date , '%d' ), '-', DATE_FORMAT( start_date , '%m' ) , '-', DATE_FORMAT( start_date , '%Y' )+543 ) AS start_date_th, CONCAT( DATE_FORMAT( end_date , '%d' ), '-', DATE_FORMAT( end_date , '%m' ) , '-', DATE_FORMAT( end_date , '%Y' )+543 ) AS end_date_th FROM `schedule` WHERE year like '%".$search."%'");
    //   return $query->result_array();
    //   // return json_encode($query->result());
    // }

    function createAllSchedule($data){
      // $this->db->where('start_date', '0000-00-00');
      // $this->db->delete('schedule');
      return $this->db->insert_batch('schedule', $data); 
    }

    function clearNull(){
      $where = "start_date = '0000-00-00' OR end_date = '0000-00-00'";
      $this->db->where($where);
      $this->db->delete('schedule');
    }

    

    function deleteSchedule($schedule, $year){
      return $this->db->delete('schedule', array('schedule' => $schedule, 'year' => $year));
      // $this->db->where('schedule_id', $schedule_id);
      // $this->db->delete('schedule');
    }

    // function getScheduleById($schedule){
    //   return $this->db->query("SELECT * FROM `schedule` WHERE `schedule_id` = '$scheduleId' AND `year` = ``");
    // }

    function updateAllSchedule($data){
      return $this->db->replace('schedule', $data); 
    }

    function deleteByYear($thisYear){
      return $this->db->query("delete FROM `schedule` WHERE year = '$thisYear'");
      // return $query->result_array();
    }
}