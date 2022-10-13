<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author seksan <panseksan@gmail.com>
 */
class Genmod extends CI_Model{

  public function __construct() {
      parent::__construct();
  }

  public function getTableCol($tableName, $selColName, $whereColName, $colValue) {
      $q = "SELECT $selColName FROM $tableName WHERE $whereColName = ?";

      $run_q = $this->db->query($q, [$colValue]);

      if($run_q->num_rows() > 0){
          foreach($run_q->result() as $get){
              return $get->$selColName;
          }
      }
      else{
          return FALSE;
      }
  }

  // array table is array('table'=>'condition')
  public function getAll($tableName, $colName = '*', $arrayWhere = '', $order = '', $arrayJoin = '', $group = '') {
    if($colName){
      $this->db->select($colName);
    }
    if($arrayWhere){
      $this->db->where($arrayWhere);
    }
    if($order){
      $this->db->order_by($order);
    }
    if($group){
      $this->db->group_by($group);
    }
    if($arrayJoin){
      foreach ($arrayJoin as $key => $value) {
        $this->db->join($key, $value, 'LEFT');
      }
    }

    $run_q = $this->db->get($tableName);
    if($run_q->num_rows() > 0){
      return $run_q->result();
    }else{
      return FALSE;
    }
  }

  public function getOne($tableName, $colName = '*', $arrayWhere = '', $order = '', $arrayJoin = '', $group = '') {
    if($colName) {
      $this->db->select($colName);
    }
    if($arrayWhere) {
      $this->db->where($arrayWhere);
    }
    if($order) {
      $this->db->order_by($order);
    }
    if($arrayJoin) {
      foreach ($arrayJoin as $key => $value) {
        $this->db->join($key, $value, 'LEFT');
      }
    }
    if($group) {
      $this->db->group_by($group);
    }
    $run_q = $this->db->get($tableName);

    if($run_q->num_rows() > 0) {
      return $run_q->row(0);
    }else {
      return FALSE;
    }
  }

  public function add($tableName, $arrayData) {
    $this->db->insert($tableName, $arrayData);
    if($this->db->affected_rows() > 0) {
      $insert_id = $this->db->insert_id();
      $this->addlog('add', $tableName, $arrayData);
      return $insert_id;
    }else {
      return FALSE;
    }
  }

  public function update($tableName, $arrayData, $arrayWhere = '') {
    if($arrayWhere) {
      $this->db->where($arrayWhere);
    }
    $this->db->update($tableName, $arrayData);
    $this->addlog('update', $tableName, $arrayData);
    return TRUE;
  }

  public function countAll($table, $arrayWhere = '', $arrayJoin = '') {
    if ($arrayWhere)
      $this->db->where($arrayWhere);
    if($arrayJoin) {
      foreach ($arrayJoin as $key => $value) {
        $this->db->join($key, $value, 'LEFT');
      }
    }
    $count = $this->db->count_all_results($table);
    return $count;
  }

  public function sumAll($tableName, $colName, $arrayWhere= '') {
    if ($arrayWhere)
      $this->db->where($arrayWhere);
    $this->db->select_sum($colName,'sum');
    $run_q =  $this->db->get($tableName);
    if($run_q->num_rows() > 0) {
      return $run_q->row(0)->sum;
    }else {
      return FALSE;
    }
  }

  function addlog($action, $table, $jsonData) {
    $this->db->insert('pms_log',array('l_action'=>$action,'l_table'=>$table,'l_data'=>json_encode($jsonData,JSON_UNESCAPED_UNICODE), 'l_command'=>$this->db->last_query(), 'l_u_id'=>$_SESSION['u_id'] ));
  }
  public function getLastTask($id){  
    $sql = "SELECT tl_name FROM `pms_task` LEFT JOIN `pms_tasklist` ON pms_task.t_tl_id = pms_tasklist.tl_id WHERE t_p_id = ? ORDER BY pms_task.t_createdate DESC LIMIT 1"; 
    return $this->db->query($sql, array($id))->row();            
  }
  public function addTask($tableName, $arrayData) {
    $this->db->insert($tableName, $arrayData);
    if($this->db->affected_rows() > 0) {
      $insert_id = $this->db->insert_id();
      $this->addlog('add', $tableName, $arrayData);
      return $insert_id;
    }else {
      return FALSE;
    }
  }
  public function getLastProject(){  
    $sql = "SELECT MAX(p_id) AS p_id FROM `pms_project`"; 
    return $this->db->query($sql, '')->row();            
  }
  public function getMaxTask($p_id){  
    $sql = "SELECT MAX(t_id) AS t_id FROM `pms_task` WHERE t_p_id = ?"; 
    return $this->db->query($sql, array($p_id))->row();       
  }
}

?>
