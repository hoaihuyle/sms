<html>
<head>
<title>Session View Page</title>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css"> -->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<style type="text/css">
	
	#main{
width:960px;
margin:50px auto;
font-family:raleway;
}
span{
color:red;
}
#note{
position:absolute;
left: 246px;
top: 81px;
}
h2{
background-color: #FEFFED;
text-align:center;
border-radius: 10px 10px 0 0;
margin: -10px -40px;
padding: 30px;
}
#show_form{
width:300px;
float: left;
border-radius: 10px;
font-family:raleway;
border: 2px solid #ccc;
padding: 10px 40px 25px;
margin-top: 70px;
}
input[type=text]{
width:100%;
padding: 10px;
margin-top: 8px;
border: 1px solid #ccc;
padding-left: 5px;
font-size: 16px;
font-family:raleway;
background-color: #FEFFED;
}
input[type=submit]{
width: 100%;
background-color:#FFBC00;
color: white;
border: 2px solid #FFCB00;
padding: 10px;
font-size:20px;
cursor:pointer;
border-radius: 5px;
margin-bottom: 15px;
}
.message{
position: absolute;
font-weight: bold;
font-size: 28px;
top:150px;
left: 862px;
width: 500px;
text-align: center;
}
.error_msg{
color:red;
font-size: 16px;
}

</style>
<body>

<div id="main">
<div id="note"><span><b>Note : </b></span> In this DEMO we gives you functionality to set your own session value. </div>
<div class="message">
<?php
if (isset($read_set_value)) {
echo $read_set_value;
}
if (isset($message_display)) {
echo $message_display;
}
?>
</div>

<div id="show_form">
<h2>CodeIgniter Session Demo</h2>
<?php echo form_open('session_tutorial/set_session_value'); ?>
<div class='error_msg'>
<?php echo validation_errors(); ?>
</div>
<?php echo form_label('Enter a session value :');?>
<input type="text" name="session_value" />
<input type="submit" value="Set Session Value" id='set_button'/>
<?php echo form_close(); ?>

<?php echo form_open('session_tutorial/read_session_value'); ?>
<input type="submit" value="Read Session Value" id="read_button" />
<?php echo form_close(); ?>

<?php echo form_open('session_tutorial/unset_session_value'); ?>
<input type="submit" value="Unset Session Value" id="unset_button" />
<?php echo form_close(); ?>
</div>
</div>
</body>
</html>