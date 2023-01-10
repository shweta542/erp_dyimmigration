<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DefaultModel extends CI_Model
{
    public function userverify($id)
	{
		$data = array('USER_VERIFY'=>'1');
		$this->db->where('USER_ID',$id)->update('USER_TBL',$data);
		redirect('welcome');
	}
	public function getsubcategory($id)
	{
		return $this->db->select('c.*,s.*')
        ->join('CATEGORY_TBL c','c.CATEGORY_ID=s.CATEGORY_ID')
        ->where('s.CATEGORY_ID',$id)
        ->get('SUB_CATEGORY_TBL s')->row();
	}
	public function getsubcategorybyslug($slug)
	{
		return $this->db->select('c.*,s.*')
        ->join('CATEGORY_TBL c','c.CATEGORY_ID=s.CATEGORY_ID')
        ->where('s.SLUG',$slug)
        ->get('SUB_CATEGORY_TBL s')->row();
	}
	public function getproduct($id)
	{
		return $this->db->select(',s.*,p.*')
        ->join('CATEGORY_TBL c','c.CATEGORY_ID=p.CATEGORY_ID')
        ->join('SUB_CATEGORY_TBL s','s.SUB_CATEGORY_ID=p.SUB_CATEGORY_ID')
        ->where('p.SUB_CATEGORY_ID',$id)
        ->get('PRODUCT_TBL p')->result();
	}
}