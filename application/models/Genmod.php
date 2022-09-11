<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author seksan <panseksan@gmail.com>
 */
class Genmod extends CI_Model{

  public function __construct() {
      parent::__construct();
  }

  public function getTableCol($tableName, $selColName, $whereColName, $colValue){
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
  public function getAll($tableName, $getColName = '*', $arrayWhere = '', $order = '', $arrayJoinTable = '', $groupby = ''){
    if($getColName){
      $this->db->select($getColName);
    }
    if($arrayWhere){
      $this->db->where($arrayWhere);
    }
    if($order){
      $this->db->order_by($order);
    }
    if($groupby){
      $this->db->group_by($groupby);
    }
    if($arrayJoinTable){
      foreach ($arrayJoinTable as $key => $value) {
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

  public function getOne($tableName, $getColName = '*', $arrayWhere = '', $order = '', $arrayJoinTable = '', $groupby = ''){
    if($getColName){
      $this->db->select($getColName);
    }
    if($arrayWhere){
      $this->db->where($arrayWhere);
    }
    if($order){
      $this->db->order_by($order);
    }
    if($arrayJoinTable){
      foreach ($arrayJoinTable as $key => $value) {
        $this->db->join($key, $value, 'LEFT');
      }
    }
    if($groupby){
      $this->db->group_by($groupby);
    }
    $run_q = $this->db->get($tableName);

    if($run_q->num_rows() > 0){
      return $run_q->row(0);
    }else{
      return FALSE;
    }
  }

  public function add($table, $arrayData){
    $this->db->insert($table,$arrayData);
    if($this->db->affected_rows() > 0){
      $insert_id = $this->db->insert_id();
      $this->addlog('add', $table, $arrayData);
      return $insert_id;
    }else{
      return FALSE;
    }
  }

  public function update($table,$arrayData,$arrayWhere = ''){
    if($arrayWhere){
      $this->db->where($arrayWhere);
    }
    $this->db->update($table, $arrayData);
    $this->addlog('update', $table, $arrayData);
    return TRUE;
  }

  public function countAll($table, $arrayWhere = '', $arrayJoinTable = ''){
    if ($arrayWhere)
      $this->db->where($arrayWhere);
    if($arrayJoinTable){
      foreach ($arrayJoinTable as $key => $value) {
        $this->db->join($key, $value, 'LEFT');
      }
    }
    $count = $this->db->count_all_results($table);
    return $count;
  }

  public function sumAll($tableName, $column, $arrayWhere= ''){
    if ($arrayWhere)
      $this->db->where($arrayWhere);
    $this->db->select_sum($column,'sum');
    $run_q =  $this->db->get($tableName);
    if($run_q->num_rows() > 0){
      return $run_q->row(0)->sum;
    }else{
      return FALSE;
    }
  }

  function addlog($action, $table, $jsonData){
    $this->db->insert('pms_log',array('l_action'=>$action,'l_table'=>$table,'l_data'=>json_encode($jsonData,JSON_UNESCAPED_UNICODE), 'l_command'=>$this->db->last_query(), 'l_u_id'=>$_SESSION['u_id'] ));
  }

  function getCategoryOptions($arrayWhere=''){
    $this->db->select('pc_id as value, pc_title as text');
    if ($arrayWhere)
      $this->db->where($arrayWhere);
    $this->db->where_in('inv_status', array('print','pay'));
    $this->db->join('invoice_list','invl_inv_id = inv_id');
    $this->db->join('products', 'p_id = invl_p_id');
    $this->db->join('product_category', 'pc_id = p_category');
    $this->db->group_by(array('pc_id', 'pc_title'));
    $run_q = $this->db->get('invoice');
    if($run_q->num_rows() > 0){
      return $run_q->result();
    }else{
      return FALSE;
    }
  }

}

 ?>
