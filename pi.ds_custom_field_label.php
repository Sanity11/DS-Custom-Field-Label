<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
  'pi_name' => 'DS Custom Field Label',
  'pi_version' =>'0.1',
  'pi_author' =>'Dion Snoeijen',
  'pi_author_url' => 'http://www.diovisuals.com/',
  'pi_description' => 'Fetching the custom field label.',
  'pi_usage' => Ds_custom_field_label::usage()
  );

class Ds_custom_field_label {
	
	public  $return_data = '';
	
	/** 
	 * Constructor
	 *
	 * @access public
	 * @return data
	 */
	public function __construct() 
	{
		$this->EE =& get_instance();
		
		$data = '';
		$field_name = $this->EE->TMPL->fetch_param('field_name', false);
		
		if($field_name) 
		{
			$this->EE->db->select('field_label');
			$this->EE->db->where('field_name', $field_name); 
			$query = $this->EE->db->get('channel_fields');
			$query_result = $query->result();
			$data = $query_result[0]->field_label;
			if(!$data) {
				$data = 'Incorrect field name.';
			}
		}
		else
		{
			$data = 'Please set the field name.';
		}
		
		// return
		$this->return_data = $data;
	}

	// usage instructions
	public function usage() 
	{
  		ob_start();
?>
-------------------
HOW TO USE
-------------------
{exp:custom_field_label field_name="custom_field_name"}

	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}	
}

/* End of file pi.ifelse.php */ 
/* Location: ./system/expressionengine/third_party/ifelse/pi.custom_field_label.php */