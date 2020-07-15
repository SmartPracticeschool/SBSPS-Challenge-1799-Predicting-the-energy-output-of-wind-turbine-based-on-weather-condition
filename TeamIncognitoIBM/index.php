<?php
require_once("config.php");



?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admission Form</title>
		<script>
function getdistrict(val) {
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'state_id='+val,
	success: function(data){
		$("#district-list").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<style>
body {
  background-image: url('559015.jpg');
}
</style>	
    </head>
    <body>
	<br><br>
	<center><h1 style="font-family:Lucida Console;color:white;">Team Incognito</h1></center><br><br><br>
        <div id="content">
            <div class="container-fluid decor_bg" id="login-panel">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-primary" >
                            <div class="panel-heading">
                                <center><h4>Wind Energy Prediction</h4></center>
                            </div>
                            <div class="panel-body">
                                <!--<p class="text-warning"><i>Login to make a purchase</i><p>-->
                                <form role="form" action="" method="POST">
									<!--<div class="form-group">
                                        <label for="regular">State</label>
										<select class="form-control" onChange="getdistrict(this.value);"  name="state" id="state">
											<option value="" disabled="disabled" selected="selected">Select State</option>
											<?php $query =mysqli_query($con,"SELECT * FROM state");
											while($row=mysqli_fetch_array($query))
											{ ?>
											<option value="<?php echo $row['StCode'];?>"><?php echo $row['StateName'];?></option>
											<?php
											}
											?>
										</select>
                                    </div>
									
									<div class="form-group">
                                        <label for="previousExam">District</label>
										<select class="form-control" name="district" id="district-list">
											<option value="" disabled="disabled" selected="selected">Select District</option>
											
										</select>
                                    </div>-->
			
									<div class="form-group">
										<label for="windspeed">Wind Speed (m/s)</label>
                                        <input type="text" class="form-control" name="windspeed" id="windspeed" required>
                                    </div>
									<div class="form-group">
										<label for="theoreticalpower">Theoretical_Power_Curve (KWh)</label>
                                        <input type="text" class="form-control" name="theoreticalpower" id="theoreticalpower" required>
                                    </div>
									
									<div class="form-group">
										<label for="winddirection">Wind Direction (°)</label>
                                        <input type="text" class="form-control" name="winddirection" id="winddirection" required>
                                    </div>
                                  
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button><br><br>
                                </form><br/>
                            </div>
                            <div class="panel-footer">
							<div>
										<label>Current Date and Time</label>
										<?php
										// Set the new timezone
											date_default_timezone_set('Asia/Kolkata');
											$date = date('d m Y H:i');
											echo $date;
											if(isset($_POST["submit"]))
											{/*
												$state=$_POST['state'];
												$district=$_POST['district'];
												$sql="SELECT StateName from state WHERE StCode=$state";
												$r=mysqli_query($con,$sql);
												$re=mysqli_fetch_row($r);
												$res=$re[0];
												echo "<br>Selected State : ".$res;
												echo "<br>Selected District : ".$district;*/
												
												$theoreticalpower=$_POST['theoreticalpower'];
												$windspeed=$_POST['windspeed'];
												$winddirection=$_POST['winddirection'];
												$url = 'http://127.0.0.1:5000/WindProject';
												$data = array("date" => $date,"theoreticalpower" => $theoreticalpower,"windspeed" =>$windspeed,"winddirection"=>$winddirection);
												$postdata = json_encode($data);
												#echo $_COOKIE['sess_user'];
												echo $postdata;
												$ch = curl_init($url);
												curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
												curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
												curl_setopt($ch, CURLOPT_POST, 1);
												curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
												curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
												curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
												curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
												$result = curl_exec($ch);
												curl_close($ch);
												$res = json_decode($result);
												print_r ($res);  

											}
										?>
									</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
