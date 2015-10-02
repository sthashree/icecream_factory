<?php
/**
 * @backupGlobals disabled
 */

class GetExtUrlTest extends PHPUnit_Framework_TestCase {
	
	protected $data;

	public function setUp() {
		$this->data = $this->getdata();
	}
	public function test_getExtUrl() {
		foreach($this->data['input'] as $key => $inputData)
		{
			$preparer = new \rep\GetExtUrl($inputData['company_key'], $inputData['url']);
			$this->assertEquals($preparer->getExtUrl(), $this->data['output'][$key]['ext_url']);
		}

	}

	public function test_getisSB() {
		foreach($this->data['input'] as $key => $inputData)
		{
			$preparer = new \rep\GetExtUrl($inputData['company_key'], $inputData['url']);
			$this->assertEquals($preparer->getisSB(), $this->data['output'][$key]['isSB']);
		}
	}


	protected function getData() {
		return array(
			'input' => array(
				array(	'company_key'=>'omp', 
						'url'=>'http://192.168.100.60/omp_2009/htdocs'
					),
				array(	'company_key'=>'janssen', 
						'url'=>'http://192.168.100.60/omp_2009/htdocs'
					),
				array(	'company_key'=>'tibotec', 
						'url'=>'http://192.168.100.60/omp_2009/htdocs'
					),
				array(	'company_key'=>'allergan', 
						'url'=>'http://192.168.100.60/allergan_2009/htdocs'
					),
				array(	'company_key'=>'eisai', 
						'url'=>'http://192.168.100.60/eisai_2009/htdocs'
					),
				array(	'company_key'=>'medicis', 
						'url'=>'http://192.168.100.60/medicis_2009/htdocs'
					),
				array(	'company_key'=>'medicis_p2p', 
						'url'=>'http://192.168.100.60/medicis_2009/htdocs'
					),
				array(	'company_key'=>'caris', 
						'url'=>'http://192.168.100.60/caris_2010/htdocs'
					),
				array(	'company_key'=>'savient', 
						'url'=>'http://192.168.100.60/savient_2011/htdocs'
					),
				array(	'company_key'=>'lifescan', 
						'url'=>'http://192.168.100.60/lifescan_2010/htdocs'
					),
				array(	'company_key'=>'galderma_p2p', 
						'url'=>'http://192.168.100.60/galderma_p2p_2014/htdocs'
					),
				array(	'company_key'=>'galderma', 
						'url'=>'http://192.168.100.60/galderma_2014/htdocs'
					),
				array(	'company_key'=>'genentech', 
						'url'=>'http://192.168.100.60/genentech_2014/htdocs'
					),
				array(	'company_key'=>'nonExistence', 							// For non-existence company
						'url'=>'http://192.168.100.60/non_existence_2014/htdocs'
					),
				array(	'company_key'=>'', 										// For Blank company
						'url'=>'http://192.168.100.60/nodata_2014/htdocs'
					),
				array(	'company_key'=>'genentech', 							// For Blank url
						'url'=>''
					)
				),
			'output' => 
				array(
						array('isSB'=>'1',
						  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>'1',
							  'ext_url'=>'http://192.168.100.60/speaker_bureau_2009/htdocs'),
						array('isSB'=>null,
							  'ext_url'=>'http://192.168.100.60/non_existence_2014/htdocs'),
						array('isSB'=>null,
							  'ext_url'=>'http://192.168.100.60/nodata_2014/htdocs'),
						array('isSB'=>1,
							  'ext_url'=>''),
					)
			);
	}
}

?>