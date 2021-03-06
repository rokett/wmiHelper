<?php
class wmi {

	// WMI connection to specified host
	protected $connection;

	/**
	 * Create a new wmi instance.
	 *
	 * @param	string	$host		Host name or IP address to connect to
	 * @param	string	$username	Local host user with rights to query WMI; normally a local admin
	 * @param	string	$password	Password of local user account
	 * @return	void				New wmi object
	 */
	public function __construct($host = null, $username = null, $password = null) {
		$wmiLocator = new COM('WbemScripting.SWbemLocator');
		try {
			$this->connection = $wmiLocator->ConnectServer($host, 'root\CIMV2', $username, $password);
			$this->connection->Security_->impersonationLevel = 3;
		} catch (Exception $e) {
			// -2147352567 means that we're unable to connect to the local host with a username and password.
			// Attempt connection again passing null values for username and password.
			if ($e->getCode() == '-2147352567') {
				$this->connection = $wmiLocator->ConnectServer($host, 'root\CIMV2', null, null);
				$this->connection->Security_->impersonationLevel = 3;
			}
		}
	}

	/**
	 * Get all properties of a WMI class.
	 *
	 * @param	string	$win32_class	Win32 class to retrieve data from
	 * @return	object					WMI collection object
	 */
	public function getInfo($win32_class) {
		$WMIcollection = $this->connection->ExecQuery('SELECT * FROM ' . $win32_class);

		foreach ($WMIcollection as $WMIobj) {
			return $WMIobj;
		}
	}
}