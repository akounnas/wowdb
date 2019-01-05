<?php

// Initialize the session
session_start();

require_once "authedication.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: Profile.php");
	exit;
	}



require_once "config.php";

//Define variables and initialize with empty values
$username = $password = $confirm_password = $admin = "";
$username_err = $password_err = $confirm_password_err = "";

	if(isset($_POST["submit"])){
		
		if(empty(trim($_POST['username']))){
			$username_err = "Please enter a username.";
		}else{
			//Prepare a select statement
			$sql = "SELECT id FROM users WHERE username = ?";
			
			if($stmt = mysqli_prepare($link, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				//Attemt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
				
					//Store results
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1){
						$username_err = "This username is already taken.";
					}else{
						$username = trim($_POST['username']);
					}
				}else{
				echo "Oops! Something went wrong. Please try again later.";
				}
			}
			//Close statement
			mysqli_stmt_close($stmt);
		}
		
		
		//Validate password
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter a password.";
		}elseif(strlen(trim($_POST["password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
		}else{
			$password = trim($_POST['password']);
		}
		
		//Validate confirm password
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please confirm password.";
		
		}else{
			$confirm_password = trim($_POST["confirm_password"]);
				if(empty($password_err) && ($password != $confirm_password)){
					$confirm_password_err = "Password did not match.";
				}
			}
			
		if($_POST["admin"] == "YykM0F14Rtm"){
				$admin = 1;
		}else{
				$admin = 0;
		}
		
		// Check input errors before inserting in database
			if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
					
					//Prepare an insert statement
					$sql = "INSERT INTO users (username, password, image, admin) VALUES (?, ?, ?, ?)";
					
					if($stmt = mysqli_prepare($link, $sql)){
						// Bind variables to the prepared statement as parameters
						mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_image, $param_admin);
						
						//Set parameters
						$param_username = $username;
						$param_password = password_hash($password, PASSWORD_DEFAULT); //Creates a password hash
						$param_image = "IMG/login_icon.png";
						$param_admin = $admin;
						
						//Attemt to execute the prepared statement
						
						if(mysqli_stmt_execute($stmt)){
							//Redirect to Login page
							$_SESSION["account_created"] = true;
							header("location: Login.php");
						}else{
							echo "Something went wrong. Please try again later.";
						}
					}
					
					//Close statement
					mysqli_stmt_close($stmt);
				}
				
				//Close connection
				mysqli_close($link);
	}
		
		
	

?>


<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
	
	<script src="assets/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="assets/jquery-ui.css">
	<script src="assets/jquery-ui.min.js"></script>
	<script src="assets/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="icon" href="IMG/icon.ico">
<!--	<link rel="stylesheet" type="text/css" href="style.css?version=51"/> -->
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );   //This JS script allow to clear the saved data and block submit data in database after Refresh.
    }
</script>
<title>WoW Database Armory</title>
</head>

<body>
	
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-between" >
		<ul class="navbar-nav">
			<li>
				<a class="navbar-brand" href="index.php">
					<img src="IMG/system.png" alt="" style="width: 50px;">
				</a>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Classes.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Classes</a>
			<div class="dropdown-menu">
				<div class='form-inline'>
					<img src="IMG/Death Knight.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Death Knight" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Demon Hunter.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Demon Hunter" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Druid.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Druid" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Hunter.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Hunter" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Mage.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Mage" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Monk.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Monk" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Paladin.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Paladin" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Priest.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Priest" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Rogue.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Rogue" style="margin-top: -24px; cursor: pointer;" >
				</div>
				<div class='form-inline'>
					<img src="IMG/Shaman.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Shaman" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Warlock.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Warlock" style="margin-top: -24px; cursor: pointer;">
				</div>
				<div class='form-inline'>
					<img src="IMG/Warrior.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
					<input type="submit" class="dropdown-item" name="nav_apply" value="Warrior" style="margin-top: -24px; cursor: pointer;">
				</div>
			</form>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Races.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Races</a>
			<div class="dropdown-menu">
						<p class="dropdown-item mb-1" style="color: blue;"><strong>Alliance</strong></p>
						<div class='form-inline'>
							<img src="IMG/darkirondwarf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Dark Iron Dwarf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/draenei_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Draenei" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/dwarf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Dwarf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/gnome_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Gnome" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/human_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Human" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/default.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Kul Tiran" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/lightforgeddraenei_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="LightForged Draenei" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/nightelf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Night Elf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/voidelf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Void Elf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/worgen_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Worgen" style="margin-top: -24px; cursor: pointer;">
						</div>
	
						<p class="dropdown-item mb-1" style="color: red;"><strong>Horde</strong></p>
						<div class='form-inline'>
							<img src="IMG/bloodelf_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Blood Elf" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/goblin_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Goblin" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/highmountaintauren_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Highmountain Tauren" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/magharorc_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Maghar Orc" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/nightborne_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Nightborne" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/orc_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Orc" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/tauren_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Tauren" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/troll_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Troll" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/scourge_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Undead" style="margin-top: -24px; cursor: pointer;">
						</div>
						<div class='form-inline'>
							<img src="IMG/default.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Zandalari Troll" style="margin-top: -24px; cursor: pointer;">
						</div>
					
						<p class="dropdown-item mb-1" style="color: green;"><strong>Neutral</strong></p>
						<div class='form-inline'>
							<img src="IMG/pandaren_male.jpg" style="width: 20px; height: 20px; margin-left: 2px; z-index: 1;"/>
							<input type="submit" class="dropdown-item" name="nav_apply" value="Pandaren" style="margin-top: -24px; cursor: pointer;">
						</div>
				
						
			</div>
			</form>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Armor.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Armor Slot
			</a>
			
			<div class="dropdown-menu">
			
			
			<input type="submit" class="dropdown-item" name="nav_apply" value="Head"  style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply" value="Shoulders" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Chest" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Tabard" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Waist" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Wrist" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Hands" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Legs" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Feet" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Ring" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Trinket" style="cursor: pointer;">
			</div>
			
			
			
			</form>
			</li>
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Armor.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Armor Class
			</a>
			<div class="dropdown-menu">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Cloth"  style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Leather" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Mail" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Plate" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Jewelry" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Miscellaneous" style="cursor: pointer;">
			</div>
			</form>
			</li>
			<li class="nav-item dropdown">
			
			<form class="mb-1 mr-sm-1" method="post" action="Weapon.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Weapons Slot
			</a>
			<div class="dropdown-menu">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Main Hand" style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply" value="Off Hand" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="One Hand" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Range" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Thrown" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply" value="Two Hand" style="cursor: pointer;">
			</div>
			</form>
			</li>
			
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Weapon.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Weapons Class
			</a>
			
			<div class="dropdown-menu">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="1h Sword" style="cursor: pointer;"/>
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="2h Sword" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="1h Axe" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="2h Axe" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="1h Mace" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="2h Mace" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Staff" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Dagger" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Warglaive" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Fist" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Wand" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Bow" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Crossbow" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Thrown" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Gun" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Miscellaneous" style="cursor: pointer;">
			</div>
			</form>
			</li>
			
			
			<li class="nav-item dropdown">
			<form class="mb-1 mr-sm-1" method="post" action="Raids.php">
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				Raids
			</a>
			<div class="dropdown-menu">
				<p class="dropdown-item mb-1"><strong>Battle For Azeroth</strong></p>
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Crucible Of Storms" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Battle Of Dazaralor" style="cursor: pointer;">
				<input type="submit" class="dropdown-item" name="nav_apply_type" value="Uldir" style="cursor: pointer;">
			</div>
			</form>
			</li>
			<li class="nav-item ">
			<a class="nav-link " href="World.php">The World</a>
			</li>
			<?php
			if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
				echo"<li class='nav-item '>
				<a class='nav-link ' href='Profile.php'> <img src='".$_SESSION["image"] ."' style='width: 10%;' class='rounded-circle'> "; echo htmlspecialchars($_SESSION["username"]); echo"</a>
				</li>";
			}else{
			echo "<li class='nav-item dropdown'>
			
			<a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>Log In</a>
			<div class='dropdown-menu' style='min-width: 450px; padding: 15px 25px;'>
				
						<form class='form-horizontal' method='post' action='Login.php'  >
							<h4>Sign In</h4>
							<div class='form-group'>
								<label for='username'>Username:</label>
								<input type='text' class='form-control ' name='username' id='username' >
							</div>
							<div class='form-group'>
								<label for='pwd'>Username:</label>
								<input type='password' class='form-control' name='password' id='pwd'>
							</div>
							<div class='form-group form-check'>
								<label class='form-check-label'>
								<input class='form-check-input ' name='remember' type='checkbox'> Remember me
								</label>
							</div>
							<input type='submit' name='submit' class='btn btn-primary'>
						</form>
				<p>If you don't have an account <a href='Register.php'>Register</a></p>
				<p>If you forget your password <a href='Reset-Password.php'>Resset Password</a></p>
		</div>
			
			</li>";
			}
			?>
		</ul>
		<form class="form-inline mb-1 mr-sm-1">
			<input class="form-control mr-sm-2" type="search" placeholder="Search by item name" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
		</form>
	</nav>
	
	<div class="main_conteiner" id="cont_margin"> <!--Main Conteiner of the page -->
	  
	  
		<div class="container-fluid">
    <div class="row">
      <div class="col bg-dark text-center" style=" color: white;">
	  <h2>Register Form</h2>
        <form style="margin: 0 40% 0 40%;" method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label for="username">Username:</label><span data-toggle="tooltip" data-placement="top" title="Required Field" style = "color: red;">*<?php echo $username_err; ?></span>
				<input type="text" class="form-control" id="username" name="username">
			  </div>
			  <div class="form-group">
				<label for="password">Password: (At least 6 characters)</label><span data-toggle="tooltip"  data-placement="top" title="Required Field" style = "color: red;">*<?php echo $password_err; ?></span>
				<input type="password" class="form-control" id="password" name= "password">
			  </div>
			  <div class="form-group">
				<label for="confirm_password">Confirm Password:</label><span data-toggle="tooltip" data-placement="top" title="Required Field" style = "color: red;">* </span><span id= "error"></span>
				<input type="password" class="form-control" id="confirm_password" name= "confirm_password">
			  </div>
			  <div class="form-group">
				<label for="admin" data-toggle="tooltip" data-placement="top" title="Administration Code given by administrators to premium users.">Administration Code:</label>
				<input type="text" class="form-control" id="admin" name = "admin">
			  </div>
			  <input type="submit" class="btn btn-primary" value="Register" id="submit_btn" name="submit">
		</form>
		<p>If you have an account <a href="login.php">Log In</a></p>
      </div>
    </div>
  </div>
		
				
	  
	  
	  <div class="jumbotron text-center jumbotron-fluid" style="margin-bottom:0; width:100%; background-color: #3d3b3b;">
			<p>Copyright &copy 2018-<?php echo date("Y");?></p>
	  </div>

</div>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});

 $(document).ready(function(){
        var $submitBtn = $("#submit_btn");
        var $passwordBox = $("#password");
        var $confirmBox = $("#confirm_password");
        var $errorMsg =  $('<span id="error_msg">Passwords do not match.</span>');

        // This is incase the user hits refresh - some browsers will maintain the disabled state of the button.
        $submitBtn.removeAttr("disabled");

        function checkMatchingPasswords(){
            if($confirmBox.val() != "" && $passwordBox.val != ""){
                if( $confirmBox.val() != $passwordBox.val() ){
                    $submitBtn.attr("disabled", "disabled");
                    $errorMsg.insertAfter($confirmBox);
                }
            }
        }

        function resetPasswordError(){
            $submitBtn.removeAttr("disabled");
            var $errorCont = $("#error_msg");
            if($errorCont.length > 0){
                $errorCont.remove();
            }  
        }


        $("#confirm_password, #password")
             .on("keydown", function(e){
                /* only check when the tab or enter keys are pressed
                 * to prevent the method from being called needlessly  */
                if(e.keyCode == 13 || e.keyCode == 9) {
                    checkMatchingPasswords();
                }
             })
             .on("blur", function(){                    
                // also check when the element looses focus (clicks somewhere else)
                checkMatchingPasswords();
            })
            .on("focus", function(){
                // reset the error message when they go to make a change
                resetPasswordError();
            })

    });
</script>

</body>

</html>