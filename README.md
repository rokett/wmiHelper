wmiHelper
=========

Helper class to retrieve data from WMI on Windows machines.

Connect to remote machine
-----
First create a connection to a remote machine.

    $wmi = new wmi($host, $username, $password);

The name of the machine should be passed in by $host.  The $username should be a local admin account on the target machine; $password is pretty obvious.

Connect to local machine
-----
Create a connection to a local machine by not passing in any parameters.

    $wmi = new wmi();

Retrieve information
-----
Once you have a new connection, you can retrieve an object containing information from a given win32 class.

    $results = $wmi->getInfo('Win32_ComputerSystemProduct');

    echo $results->IdentifyingNumber;
    echo $results->Name;

or

    $results = $wmi->getInfo('Win32_ComputerSystem');

    echo $results->Domain;
    echo $results->Name;

Win32 Classes
-----
Microsoft list all of the available classes [here](http://msdn.microsoft.com/en-us/library/windows/desktop/aa394084.aspx).