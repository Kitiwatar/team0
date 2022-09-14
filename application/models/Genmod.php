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

}

?>
