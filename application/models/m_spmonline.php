<?php
class M_spmonline extends MY_Model {
    // variabel nama tabel
    protected $_table_name 		= 't_spmonline';
    protected $_primary_key 	= 'id';
	protected $_order_by 		= 'id';
    public $rules				= array(
					'url'	=> array(
						'field'	=> 'url',
						'label'	=> 'Url SPM Online',
						'rules'	=> 'trim|required|max_length[255]|xss_clean'
					)
	);
    public function __construct()
	{
		parent::__construct();
        $this->load->dbforge();
        $this->create_table();
		
	}
    public function index() {
        $this->create_table();
        
    }
    // digunakan untuk create table 
    private function create_table() {
        $fields = array(
                        'id' => array(
                                'type' => 'INT',
                              'constraint' => '100',
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'url' => array(
                                'type' => 'VARCHAR',
                              'constraint' => '100'
                        )
                );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('t_spmonline',TRUE);

    }
    	public function get_new()
	{
		// define and instantiate
		$spmonline = new stdClass();
		
		$spmonline->id	= '';
		$spmonline->url		= '';
		
		return $spmonline;
	}
    // di gunakan untuk select * from 
    public function getAll() {
        $rows= $this->db->get('t_spmonline');
        return $rows->result();
        
        
    }

}
?>