<?php

require_once 'PHPUnit/Framework.php';
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
require_once sfConfig::get('sf_test_dir') . '/util/TestDataService.php';

class CustomerDaoTest extends PHPUnit_Framework_TestCase {
	
	private $customerDao;
	protected $fixture;

	/**
	 * Set up method
	 */
	protected function setUp() {

		$this->customerDao = new CustomerDao();
		$this->fixture = sfConfig::get('sf_plugins_dir') . '/orangehrmAdminPlugin/test/fixtures/ProjectDao.yml';
		TestDataService::populate($this->fixture);
	}

	public function testGetCustomerListWithActiveOnly(){
		$result = $this->customerDao->getCustomerList();
		$this->assertEquals(count($result), 2);
	}
	
	public function testGetCustomerList(){
		$result = $this->customerDao->getCustomerList("","","","",false);
		$this->assertEquals(count($result), 3);
	}
	
	public function testGetCustomerCountWithActiveOnly(){
		$result = $this->customerDao->getCustomerCount();
		$this->assertEquals($result, 2);
	}
	
	public function testGetCustomerCount(){
		$result = $this->customerDao->getCustomerCount(false);
		$this->assertEquals($result, 3);
	}
	
	public function testGetCustomerById(){
		$result = $this->customerDao->getCustomerById(1);
		$this->assertEquals($result->getName(), 'customer 1');
	}
	
	public function testDeleteCustomer(){
		$this->customerDao->deleteCustomer(1);
		$result = $this->customerDao->getCustomerById(1);
		$this->assertEquals($result->getDeleted(), 1);
	}
	
	public function testGetAllCustomersWithActiveOnly(){
		$result = $this->customerDao->getAllCustomers();
		$this->assertEquals(count($result), 2);
		$this->assertTrue($result[0] instanceof Customer);
	}
	
	public function testGetAllCustomers(){
		$result = $this->customerDao->getAllCustomers(false);
		$this->assertEquals(count($result), 3);
		$this->assertTrue($result[0] instanceof Customer);
	}
	
	public function testHasCustomerGotTimesheetItems(){
		$result = $this->customerDao->hasCustomerGotTimesheetItems(1);
		$this->assertTrue($result);
	}
	
	
}

?>