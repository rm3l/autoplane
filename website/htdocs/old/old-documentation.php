<?php
	$page = 'documentation';
	include './templates/header.php';
?>
<header id="page-header" class="center">
	<h1><span>The documentation and <em class="colored">design plan</em></span><small>Failing to prepare, is preparing to fail.</small></h1>
</header><!--- #page-header -->
<div id="page-content">
<div class="has-divider">
	<div>
<h2><a href="#contents" name="contents">Contents</a></h2>
<ul>
	<li><a href="#contents">Contents</a></li>
	<li><a href="#introduction">Introduction</a></li>
	<li><a href="#goals">Goals</a><ul>
	<li><a href="#goal1">Goal 1 - Learning to Fly</a><ul>
		<li>Buy a plane</li>
		<li>Take some lessons</li>
		<li>Return notes and knowledge</li>
	</ul></li>
	<li><a href="#goal2">Goal 2 - Installing Hardware</a><ul>
		<li>Buy required items</li>
		<li>RPI</li>
		<li>Gyroscope sensor</li>
		<li>GPS Module</li>
		<li>Camera</li>
		<li>Proximity sensor</li>
		<li>P2P Wireless</li>
		<li>Trim excess wires and remove unwanted weight</li>
		<li>Add the devices to the plane</li>
		<li>Get each sensor into our program we can read and control</li>
		<li>Write the information to file</li>
		<li>Check the information for bugs</li>
	</ul></li>
	<li><a href="#goal3">Goal 3 - Processing Data</a><ul>
		<li>Gyroscope</li>
		<li>GPS Module</li>
		<li>Proximity sensor</li>
		<li>Camera</li>
		<li>P2P</li>
		<li>RPI</li>
	</ul></li>
	<li>Goal 4 - The First Flight<ul>
		<li>Take off</li>
		<li>Take over</li>
		<li>Flight</li>
		<li>Landing</li>
		<li>Landed</li>
		<li>Finish</li>
	</ul></li>
	<li>Goal 5 - The Second Flight<ul>
		<li>Teaching to take off</li>
		<li>Teaching to land</li>
		<li>Teaching to turn</li>
	</ul></li>
	<li>Goal 6 - Tweaking/Improving</li>
	<li>Goal 7 - Downgrading/Improving</li>
	<li>Goal 8 - The End</li>
	<li>Goal 9 - Going one step further<ul>
		<li>Using the RPI</li>
		<li>Without the RPI</li>
	</ul></li></ul>
	<li>Technical Jargon</li>
	<li>Files &amp; Programs<ul>
		<li>Locations</li>
		<li>File-types<ul>
			<li>.CAP</li>
			<li>.KML</li>
			<li>.LOG</li>
		</ul></li>
		<li>Programs<ul>
			<li>autoplane-ailerons</li>
			<li>autoplane-buggeroff</li>
			<li>autoplane-camera</li>
			<li>autoplane-errors</li>
			<li>autoplane-gps</li>
			<li>autoplane-gyroscope</li>
			<li>autoplane-manager</li>
			<li>autoplane-proximity</li>
			<li>autoplane-tracking</li>
		</ul></li>
	</ul></li>
	<li>Constants<ul>
		<li>SpeedMin</li>
		<li>SpeedMax</li>
		<li>RotationMax</li>
		<li>RotationIncrementNormal</li>
		<li>RotationIncrementMax</li>
		<li>FlightTimeMax</li>
		<li>CommandTimeout</li>
		<li>Creator</li>
		<li>Version</li>
		<li>ChecksumSalt</li>
		<li>ProxPollRate</li>
		<li>GryoPollRate</li>
		<li>GPSPollRate</li>
		<li>LandingDistance</li>
	</ul></li>
	<li>Error Management</li>
	<li>Parts</li>
	<li>Credits<ul>
		<li>HappyPaul55</li>
		<li><a href="#RPI">Raspberry Pi Foundation</a></li>
		<li>Linorics</li>
		<li>st599</li>
		<li>flipdewaf</li>
		<li>Fred Nightingale</li>
		<li>You?</li>
	</ul></li>
	<li>Questions &amp; Answers<ul>
		<li>Why lots of programs?</li>
		<li>What happens if there was a full system crash?</li>
		<li>It’s not legal!</li>
		<li>Is it a Fly-over-wire (Fly-by-wire) based?</li>
		<li>Is the Gyroscope capable of keeping the plane level?</li>
		<li>Now it’s my turn, What programming language do you think would be best for this project and why?</li>
	</ul></li>
	<li>Development &amp; Programming<ul>
		<li>Call for developers</li>
		<li>Functions that need to be created</li>
	</ul></li>
</ul>

<h2>Introduction</h2>

<p>The aim is create a fully autonomous plane capable of flying from point to point including waypoints in between. The plane should be capable for flying for half an hour on its own power supply and house enough space to hold additional modules which are unrelated to the flight of the plane.</p>

<h2><a href="#goals" name="goals">Goals</a></h2>
<p>The build should be goal driven and be built in sections with tests along the way.</p>

<h3><a href="#goal1" name="goal1">Goal 1 - Learning to Fly</a></h3>
<p>The first goal is to learn how to fly a plane. This will give us the knowledge and steps required to fly a plane. We should be able to take off, turn and land the plane without any accidents.</p>

<h4>Buy a plane</h4>
<p>First we need to buy a plane. The plane should be electric, lightweight and house enough room inside for our hardware and additional modules.</p>

<h4>Take some lessons</h4>
<p>We then need to learn how to fly a plane so that we can correctly teach the computer to safely control the vehicle.<br />
Return notes and knowledge<br />
We should return notes on how to fly the plane in normal conditions and windy conditions. If possible knowledge on the plane reacts when wet we would be desirable</p>

<h3><a href="#goal2" name="goal2">Goal 2 - Installing Hardware</a></h3>

<p>The second goal is to install all the required hardware and get the raw data to the RPI in a format our program can understand.</p>

<h4>Buy required items</h4>
<h5>RPI</h5>
<h6>Model B</h6>
<p>For testing and debugging</p>
<h6>Model A</h6>
<p>After completion, uses less power, longer flights</p>
<h6>SD Card</h6>
<p>8GB, 16GB or 32GB so we can log everything to file</p>
<h6>Gyroscope sensor</h6>
<p>To keep plane level<br />
Controlled in flight corning and rolling<br />
Speed</p>
<h6>GPS Module</h6>
<p>Location tracking and targeting<br />
Speed</p>
<h6>Camera</h6>
<p>Record flight<br />
Possible usage for collision detection</p>
<h6>Proximity sensor</h6>
<p>Long Range: Prevent crashing into objects in front<br />
Short range: Prevent crash landing</p>
<h6>P2P Wireless</h6>
<p>Receive update commands<br />
Report failures, warning and completions<br />
Trim excess wires and remove unwanted weight, Lighter the better and Longer the flights</p>

<h6>Add the devices to the plane</h6>
<p>Try to keep the centre of gravity throughout the plane set to the Aerodynamic center. (26% according to an anonymous commenter)</p>
Get each sensor into our program we can read and control

Nothing has to done with the data. It just has to be able to updated regularly
Write the information to file

<p>Each sensor will have its own file. Dates and times will also included in the filename. For example,
/var/autoplane/logs/2012-03-13.GPS.log<br />
Now we should check the information for any bugs. If there are any errors go back to step 4</p>
<h3><a href="#goal3" name="goal3">Goal 3 - Processing Data</a></h3>

<p>This goal will get the data from Goal 2 and create useful information from it using our software.</p>
<h4>Gyroscope</h4>
<p>Using the Gyroscope information we need to figure out how much we have to alter the aileron to reach our target rotation.<br />
For this goal the target rotation will always be level and should be able to keep the plane flying in a straight line.[b]<br />
This should be tested by rolling the plane on whilst still on the ground.<br />Results should be visible</p>
<h4>GPS Module</h4>
<p>For this goal we should be able to tell it a way point and the program should be able to work out the distance, and rotation need to fly to the point.<br />
This should be tested by taking the plane to different places and keeping the waypoint the same.<br />
Another test will be keeping the plane in the same spot and telling it different waypoints.</p>
<h4>Proximity sensor</h4>
<p>To prevent a crash landing the proximity sensor should fire a warning when the ground is less than LandingDistance away.<br />
To test this the plane should be picked up avoiding the sensor and moved slowly to the floor. This test should be repeated on different materials and grounds. Including; Wood, Concrete, grass and soil.</p>
<h4>Camera</h4>
<p>The camera should be set on a timer and be able to take key snapshots every X seconds.<br />
If the picture is 90% or more black it should fire off a warning.<br />
Test should be completed by slowly moving black paper in front of the camera 5 cm away from the lens.</p>
<h4>P2P</h4>
<p>The plane should be able to receive commands from a command center.
Commands should include;
<ul><li>Kill Switch</li>
<li>Remote control</li>
<li>Update waypoints</li>
<li>Power-off</li>
<li>Poll</li>
</ul>
Commands should be set with a checksum to prevent against any attack</p>
RPI
All programs and tests above should all run at the same time. If the CPU reaches anything above 80%, optimization must be done before the next Goal starts.
The RPI must be fully protected from all possible damage, including;
Water
Light
Shock
Temperature
Power surge
<h3><a href="#goal4" name="goal4">Goal 4 - The First Flight</a></h3>
<p> This is the part where the plane gets to have its first semi-autonomous flight from point to point.</p>
<h5>Take off</h5>
<p>First we have to get the plane up in the air</p>
<h5>Take over</h5>
<p>This is where the RPI gets control over the plane. This has to be done in a clear, windless day over open land. The kill switch and takeover commands must be ready in-case of an error
Flight. The plane should be able to fly itself to the landing point which should be a straight line.</p>
<h5>Landing</h5>
<p>The plane should be take back over control by the command center. The command center should land the plane.</h5>
<h5>Landed</h5>
<p>Everything should be written to file and the kill command should be sent. Pictures should be take for anything that is possibly broken.</p>
<h5>Finish</h5>
<p>Everything should be checked and all the files should be looked at for any possible fault. If there is any fault it should be fixed. When fixed the test should run again until no bugs or faults are spotted. Also if weight balance needs to be changed it should be moved to the nose of the plane to increase handling which may slow down the plane a little, but this isn’t a bad thing.[c]</p>
<h3><a href="#goal5" name="goal5">Goal 5 - The Second Flight</a></h3>
<p>This is where the plane learns to take off, land and turn.</p>
<h4>Teaching to take off</h4>
<p>In Goal 3, Stage 1 we set the target to level. Extra lines should be added to support climbing and descending. The target rotation should never be allowed to increase unless speed is great then SpeedMin.[d] Equally the plane should never be allowed to land if speed is more then SpeedMax. Unless battery flight time is less than 10%. When the plane receives its first way point it’s allowed to start the propeller.</p>
<h4>Teaching to land</h4>
<p>The plane should automatically get ready land when it’s heading towards its last way point. The plane should decrease its speed to SpeedMin + SpeedMin / 3. When the proximity sensor reaches LandingDistance meters speed should drop to SpeedMin. When proximity sensor reaches less than ~1/2 wingspan; power should be cut and the nose should rise as it stalls (Thanks to Fred Nightingale). When speed reaches less than 5 mph power to the propellers should turn off.</p>
<h4>Teaching to turn</h4>
<p>In Goal 5, Stage 1a we added more lines to support climbing and descending. This time we add support for rolling. To calculate roll it should be: target rotation + target rotation / 3. The rotation should not be aggressive. IE Jumping target from 0° to 33° except when recovering from excessive roll. Roll should never be more than RotationMax or less than -RotationMax. Same applies to pitch. Roll should never take place when the proximity to the floor is less than 1 metre.</p>
<h3><a href="#goal6" name="goal6">Goal 6 - Tweaking/Improving</a></h3>
<p>Everything should be in place now. It just needs testing and tweaking. First we shall go through Goal 4 again just to be on the safe side. If everything goes well continue otherwise fix whatever is wrong. Now we let the plane take off and land on its own. As before, get ready to take over in case something goes wrong</p>
<h3><a href="#goal7" name="goal7">Goal 7 - Downgrading/Improving</a></h3>
<p>Now that everything is working on a Model B we need to replace it with the Model A and get everything working again. When the plane is capable of flying on its own again the FlightTimeMax can be increased because there will be less power consummation. This will also make the product more affordable to other who follow in our footsteps.</p>
<h3><a href="#goal8" name="goal8">Goal 8 - The End</a></h3>
<p>When the project is fully completed the source code to all programs should be released to the public under a share-and-share-alike licence. Pictures should also be put up along with any diagrams. The final thing to do would be to inform RPI and the local news.</p>
<h3><a href="#goal9" name="goal9">Goal 9 - Going one step further</a></h3>
<p>Now that the plane is stable and out in the public we need to do something extra. Using the spare Model B we should build something to add to the plane which has nothing to do with the flight of the plane.</p>
<h4>Using the RPI</h4>
<p>To make more use of the data we collect the two RPIs should be put in sync. A program should be created to merge the two KML files created to make it easy to read later on.</p>
<h5>Weather logger</h5>
<p>A USB stick that monitors humidity, temperature and dew point<br />
Link: http://goo.gl/zPhfu</p>
<h5>Time Lapse</h5>
<p>Using a camera you can create a long lapse video.</p>
<h5>Heat sensor (Spy Camera)</h5>
<p>Using an infrared camera you could monitor the temperature below</p>
<h4>Without the RPI</h4>
<h4>Fly a Flag</h4>
<p>You could fly a flag at the end of the plane for sponsorship, fun or because you can</p>
<h4>Transportation</h4>
<p>Okay, it’s not big enough to carry a person but if you forget your phone, letter or other small item. You could send the plane to collect the objects using the spare space.</p>
<h2>Technical Jargon</h2>
<p>Aileron: The control panels at the ends of the wings which create a lift differential to Roll the aircraft<br />
Command Center: Person or Persons’ in charge of the plane<br />
GPS: Global Positional System<br />
Gyroscope Sensor: The rotation sensor<br />
Kill Switch: Turns everything off<br />
RPI: Raspberry Pi<br />
P2P: Peer to Peer connection<br />
Proximity: A sensor which detects objects in the immediate view<br />
<a href="http://www.php.net/">PHP</a>, C++: Programming Languages<br />
Waypoints: Geo Locations</p>
<h2>Files &amp; Programs</h2>
<h3>Locations</h3>
<p>To make things easy for new developers to latch on. Files and programs should be saved in an easy to follow and understand methodology.
All folders should have the prefix autoplane except when already in a folder that contains autoplane in its name. Files that control hardware should be under autoplane_build be named the friendly version of the hardware type. For example; autoplane_build/GPS.file-type Old versions of the file should be in a subfolder of the hardware friendly name. For example; autoplane_main/GPS/version_number.file-type</p>
<h3>File-types</h3>
<h4>.CAP</h4>
<p>Cap files record wireless networks that are in range. These can be used as to find an access points for command center if the primary method fails.</p>
<h4>.KML</h4>
<p>This is the primary method of giving way points. It will also the primary output of autoplane-tracking.</p>
<h4>.LOG</h4>
<p>These files host the result of every function our program runs. These can be useful for error correcting or improve code efficiency. Each process should have its own log file. IE; GPS.log, Camera.log, etc...</p><p>
There are also 3 special logs. These are in the same folder and contain less information but are more important. These files are; warning.log, error.log and fatal.log. They may not always exist if there hasn’t been any errors of that type.</p>
<h3>Programs</h3>
<p>To prevent an all out crash each hardware device should have its own program. For example; to control the ailerons there should be a file called autoplane-ailerons. This allows for much better control over the hardware and also allows for much better error recovery. For example; If the GPS fails and gets hooked which prevents the rest of the program from running, the plane could crash because it wouldn’t be able to inform the command center or revert to another source of information.</p>
<p>All the programs listed below have a set job to perform. They all  (except autoplane-manager) also check to see if the autoplane-manager is process is running and if it isn’t the programs will try and start it. An error will also be logged every time one of the programs notice that autoplane-manager has crashed.</p>
<h4>autoplane-ailerons</h4>
<p>This program will read from the GPS, Gyroscope and Proximity results and react by changing the ailerons if needed.</p>
<h4>autoplane-buggeroff</h4>
<p>An Easter egg like program that will get the plane to fly in a random direction within one mile of its starting place. It creates a random KML file with random points and gets the plane to use it as if the user gave the instructions. Good for testing.</p>
<h4>autoplane-camera</h4>
<p>This program will take snap shots as and when requested. It will also fire off warnings and errors if required.</p>
<h4>autoplane-errors</h4>
<p>This program is responsible for handling of all errors. This program main use is to prevent re-writing of code in the other programs. This reduces overheads and lets the programs focus on their main job.</p>
<h4>autoplane-gps</h4>
<p>This program will poll the GPS every GPSPollRate for a location and fire off warnings and errors if and when required.</p>
<h4>autoplane-gyroscope</h4>
<p>This program will poll the gyroscope every GryoPollRate. If there is a magnetic compass on-board the plane will also work the relative results. This program will also fire off warning and errors if results bypass limitations.</p>
<h4>autoplane-manager</h4>
<p>This program is the kill of all the other programs in this package. It monitors the other programs and checks that they haven’t crashed. It also monitors free space, available RAM and individual statistics for all processes. It listens for commands from the control center and takes action if any commands are sent.</p>
<h4>autoplane-proximity</h4>
<p>This program will poll the proximity sensor every ProxPollRate and fire off warnings and errors if required.</p>
<h4>autoplane-tracking</h4>
<p>This program uses data from all the other programs including autoplane-manager saves the information into a KML file. The KML file can then be used to see what was happening at any given point in the flight, mainly to be used in Google Earth.</p>
<h2>Constants</h2>

<p>A few constants to prevent abnormal flights<p>
<h3>SpeedMin</h3>
<p>This is used to calculate when to start moving the ailerons during take off. It’s also used to calculate how fast to go when landing.</p>
<h3>SpeedMax</h3>
<p>This is Maximum the plane can fly at. Also used to calculate cruising speed.</p>
<h3>RotationMax</h3>
<p>Value: 50.This is the plus and minus degrees of allowed roll.</p>
<h3>RotationIncrementNormal</h3>
<p>Value: 2. When rolling we slowly increment the degrees by this much. Unless we have go past max rotation</p>
<h3>RotationIncrementMax</h3>
<p>Value: 10. This is the maximum degrees of difference when rolling.</p>
<h3>FlightTimeMax</h3>
<p>Value: 3600. In seconds this sets the maximum time the plane is allowed in the air. This can be used a double safe for battery limitations.</p>
<h3>CommandTimeout</h3>
<p>Value: 360. If we haven’t heard from the command center is this amount of time a warning shall be set off.</p>
<h3>Creator</h3>
<p>Value: <Changes>. A semi-colon delimited list of names and/or companies.</p>
<h3>Version</h3>
<p>Value: <Changes>. The format is; Major, Minor, Release, Build. Separated by a decimal.</p>
<h3>ChecksumSalt</h3>
<p>Value: <Changes>. This is used to prevent hijacking of the plane. It should change with each release. Every minor should contain a big difference and every Major the checksum should be totally random from all previous releases.</p>
<h3>ProxPollRate</h3>
<p>Value: 0.3. How often in seconds should the device be polled for data. Used to check during landing.</p>
<h3>GryoPollRate</h3>
<p>Value: 0.2. How often in seconds should the device be polled for data. Used to keep the plane balanced.</p>
<h3>GPSPollRate</h3>
<p>Value: 5. How often in seconds should the device be polled for data. Used for tracking location and direction.</p>
<h3>LandingDistance</h3>
<p>Value: 0.5. When the distance in metres is less than this value the final part of the landing sequence will take effect.</p>
<h2>Error Management</h2>
<p>If something goes a bit awry we need to know. All information should be logged but errors are more important and thus have an extra log and also invoke functions to either, compensate, fix or report the error further. For example if an Fatal error occurs a text message to the user would be nice. Or if the engine fails, deploying a parachute would be a great money saver. The error table has being removed because useful text message based errors will allow quicker debugging and error checking. If you wish to use error code you’ll have to create your own folk.</p>
<h2>Parts</h2>

<p>Comming soon</p>

<h2>Credits</h2>
<p>This project will/would never be completed without certain individuals and companies. Below is a list people I’d like to thank.</p>
<h3>HappyPaul55</h3>
<p>C’mon. I’ve got to give myself some credit. I wrote this detailed document for a plan of action, ordered the parts and that’s it so far.</p>
<h3><a href="http://www.raspberrypi.org" name="RPI">Raspberry Pi Foundation</a></h3>
<p>The wonderful people at the charity company gave me the idea with their cheap £22 boards. The forums were thought provoking which gave me some great ideas for me to add, change and remove parts of the program and hardware.</p>
<h4>Linorics</h4>
<p>Provided WiFi solutions for short range testing. Centralized and amplified router in the center of the testing area or repeaters around the perimeter.</p>
<h4>st599</h34>
<p>Brought the Kalman filter and PID controller idea to the board. Also brought up the issue of a complete system crash.</p>
<h4>flipdewaf</h4>
<p>Provided great in-depth information on how to use the data provided by the sensors.</p>
<h4>Fred Nightingale</h4>
<p>Created lots of useful comments on this document. Provided quite a few insights as well. Overall helpful information.</p>
<h4>You?</h4>
<p>Okay, that was cheesy but the message is there. You can help build this program by programming additional features, correcting bugs or by building and testing your own planes and providing feedback. You can contact me by emailing PaulHappyHutchinson@gmail.com.</p>
<h2>Questions &amp; Answers</h2>
<h3>Why lots of programs?</h3>
<p>Well, this is a good question that I know has some debate behide it. The reason is to keep as many programs running at once each with their own little task. This way if any coding issue pops up (like a divide by zero), it will only crash that one program and only one piece of hardware will stop working. Furthermore the other programs can notice a crash and try and restore or compensate.</p>
<h3>What happens if there was a full system crash?</h3>
<p>Good question, I forgot to think about this, so, this solution is an addition. I haven’t got a fully prove creation but I was thinking about using some form of timer that will get reset by the programs every time it completes a hardware request. When the timer reaches zero a parachute will set off and all hardware power will be forced turned off by breaking a switch.<br />
An additional solution is to use a relay switch which will switch between RPI controls and standard radio controls.</p>
<h3>It’s not legal!</h3>
<p>First off, calm down dear. Secondly, please say in a question form. Thirdly, No! It’s not illegal as long as I keep my beady eyes on it and have a backup solution if it starts playing up. I’m in the UK, so if you’re doing a similar project please check your with your local authorities.</p>
<h3>Is it a Fly-over-wire (Fly-by-wire) based?</h3>
<p>No, the command center subsection is to create extra features like live stream, live log, updatable way points and so on. The KML files should be placed onto SD card which will be automatically loaded upon startup. After the power on the plane will take off and reach its way point targets. No contact with the command center is required but for safety and curiosity I’ll like to keep to in touch.</p>
<h3>Is the Gyroscope capable of keeping the plane level?</h3>
<p>To my knowledge, yes. But with clever boffins who read this, they seem to disagree. This is really an answer but more “it's what I know” sort of thing. I thought the difference between a Gyroscope and an Accelerometer was that the Accelerometer provided information relative to the plane. IE the plane is now rolling left... And the Gyroscope was relative to gravity. IE the plane is upside down and rolling right. I’d love to hear some comments.</p>
<h3>Now it’s my turn, What programming language do you think would be best for this project and why?</h3>
<p>I talked about programming everything in C++ but because of my lack of knowledge in that area, I’ve switched back to <a href="http://www.php.net/">PHP</a>. Another arguing point is that, more people can read and write in this language. I’m hoping this will increase developement from my peers.</p>
<h2>Development &amp; Programming</h2>
<p>Okay, so now that most the grounds are set we (or I) need to start the development of the software. The programs should be Lightweight, efficient and to the point.</p>
<h3>Call for developers</h3>
<p>I love to program, I’ll admit it. This project is quite large and for it to ever reach completion I’d like to share it with the world. I could just put it on GIT or Google SVN and I will, but I’ll also like to have some great people right by my side, the core team if you like. I’d like to say I’ll pay you but to keep costs down, I won’t. ;) I will however buy you a drink at the pub after a test flight if you like. The code is available for viewing, editing and downloading from <a href="https://github.com/GingerPaul55/autoplane">GitHub</a>.</p>

<h3>Functions that need to be created</h3>

<p>This section has being removed because code can now be seen on <a href="https://github.com/GingerPaul55/autoplane">GitHub</a>. And I’ll prefer it if you get involved on there. But if you don’t use <a href="https://github.com/GingerPaul55/autoplane">GitHub</a>, feel free to make comment here.</p>
	</div>
</div>
</div>
<?php
	include './templates/footer.php';
?>
