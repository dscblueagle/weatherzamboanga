<?php
$cache_file = 'data.json';
if(file_exists($cache_file)){
  $data = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
  $data = file_get_contents($api_url);
  file_put_contents($cache_file, $data);
  $data = json_decode($data);
}

$current = $data->results->current[0];
$forecast = $data->results->seven_day_forecast;

?>
<style>
  body{
    background-image: url("bg2.jpg");
    background-repeat: no-repeat;
    background-size: auto;

  }
  .wrapper .single{
    color:#fff;
    width: 75%;
    padding:10px;
    text-align:center;
    margin-bottom:10px;
    margin-left: 100px;
  }
  .aqi-value{
 
    font-family : "Noto Serif","Palatino Linotype","Book Antiqua","URW Palladio L";
    font-size:40px;
    font-weight:bold;
  }
  .aqi-value-top{
    margin-left: 275px;
    font-family : "Noto Serif","Palatino Linotype","Book Antiqua","URW Palladio L";
    font-size:40px;
    font-weight:bold;
  }
  h1{
    text-align: center;
    font-size:3em;
  }
h3{
    font-family : "Noto Serif","Palatino Linotype","Book Antiqua","URW Palladio L";
    font-size:40px;
    font-weight:bold;
}
  .forecast-block{
  	background-color: #2243d6!important;
  	width:20% !important;
  }
  .title{
  	background-color:EDFF6C;
  	width: 75%;
  	color:#000;
  	margin-bottom:0px;
  	padding-top:10px;
  	padding-bottom: 10px;
    margin-left: 100px;
  }
  .bordered{
  	border:1px solid #fff;
  }
  .weather-icon{
    margin-left: 220px;
  	width:50%;
  	font-weight: bold;
  	background-color: #034f1c;
  	padding:10px;
  	border: 2px solid #fff;
    
  }
</style>

<?php
  function convert2cen($value,$unit){
    if($unit=='C'){
      return $value;
    }else if($unit=='F'){
      $cen = ($value - 32) / 1.8;
      	return round($cen,2);
      }
  }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />

<div class="container wrapper">
  <br>
  
  <div class="row">
    <h3 class="title text-center bordered">Weather Report for <?php echo $current->city.' ('.$current->country.')';?></h3>
    <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
      <div class="single bordered" style="padding-bottom:25px;background:url('back.jpg') no-repeat ;border-top:0px;background-size: cover;">
        <div class="row">
          <div class="col-sm-9" style="font-size:20px;text-align:left;padding-left:70px;">
            <p class="aqi-value-top"><?php echo convert2cen($current->temp,$current->temp_unit);?> °C</p>
            <p class="weather-icon">
              <img style="margin-left:-10px;" src="<?php echo $current->image;?>">
              <?php echo $current->description;?>
            </p>
            <div class="weather-icon">
              <p><strong>Wind Speed : </strong><?php echo $current->windspeed;?> <?php echo $current->windspeed_unit;?></p>
              <p><strong>Pressure : </strong><?php echo $current->pressure;?> <?php echo $current->pressure_unit;?></p>
              <p><strong>Visibility : </strong><?php echo $current->visibility;?> <?php echo $current->visibility_unit;?></p>
            </div>
          </div>
        </div>
          </div>
    </div>
  </div>
  <br><br>
  
  