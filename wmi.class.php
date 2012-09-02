<?php
class wmi {

	// WMI connection to specified host
	protected $connection;

	/**
	 * Create a new wmi instance.
	 *
	 * @param  string  $host
	 * @return void
	 */
	public function __construct($host = null, $username = null, $password = null) {
		$wmiLocator = new COM('WbemScripting.SWbemLocator');
		$this->connection = $wmiLocator->ConnectServer($host, 'root\CIMV2', $username, $password);
		$this->connection->Security_->impersonationLevel = 3;
	}

	/**
	 * Get all properties of a WMI class.
	 *
	 * @param string   $win32_class
	 * @return object
	 */
	public function getInfo($win32_class) {
		$WMIcollection = $this->connection->ExecQuery('SELECT * FROM ' . $win32_class);

		foreach ($WMIcollection as $WMIobj) {
			return $WMIobj;
		}
	}
}