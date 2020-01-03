<?PHP
// I have brazenly stolen much of the javascript for this calculator from the following URL
// http://anisimoff.org/eng/lte_throughput_calculator.html
// Just making modifications to calculate for Carrier Aggregation
$bandwidth = array(
	'0'=>'',
	'6'=>'1.4 Mhz',
	'15'=>'3 Mhz',
	'25'=>'5 Mhz',
	'50'=>'10 Mhz',
	'75'=>'15 Mhz',
	'100'=>'20 Mhz',
);
$mcs = array(
	'0'=>'',
	'9'=>'QPSK',
	'15'=>'16QAM',
	'26'=>'64QAM',
	'33'=>'256QAM',
);
$mimo = array(
	'0'=>'',
	'1'=>'1x1',
	'2'=>'2x2',
	'4'=>'4x4',
);

function makeDropdown($id="", $values=""){
	echo "<select id='$id'>\n";	
	foreach($values as $val=>$option){
		echo "<option value='$val'>$option</option>\n";
	}	
	echo "</select>\n";
}

 
?>
<html>
<head>
<link rel="SHORTCUT ICON" href="/CIQ/calculator-icon.png">
<title>LTE Throughput Calculator</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script>

function calc(){
	var d = document;
	var caTotal = 0;
	var total, bandwidth, mcs, mimo, rate;

	for(var i=1; i <= 4; i++){
		total = 0;
        	bandwidth = +d.getElementById("bandwidth"+String(i)).value;
        	mcs = +d.getElementById("mcs"+String(i)).value;
                mimo = +d.getElementById("mimo"+String(i)).value;
       		rate = d.getElementById("rate"+String(i));

		if (bandwidth == 6) {
			if (mcs == 9) { total = 0.936 * mimo; }
			if (mcs == 15) { total = 1.8 * mimo; }
			if (mcs == 26) { total = 4.392 * mimo; }
			if (mcs == 33) { total = 5.992 * mimo; }
		}
        	if (bandwidth == 15) {
                	if (mcs == 9) { total = 2.344 * mimo; }
	                if (mcs == 15) { total = 4.584 * mimo; }
        	        if (mcs == 26) { total = 11.064 * mimo; }
                	if (mcs == 33) { total = 14.688 * mimo; }
	        }
        	if (bandwidth == 25) {
                	if (mcs == 9) { total = 4.008 * mimo; }
	                if (mcs == 15) { total = 7.736 * mimo; }
        	        if (mcs == 26) { total = 18.336 * mimo; }
                	if (mcs == 33) { total = 24.496 * mimo; }
	        }
        	if (bandwidth == 50) {
                	if (mcs == 9) { total = 7.992 * mimo; }
	                if (mcs == 15) { total = 15.264 * mimo; }
        	        if (mcs == 26) { total = 36.696 * mimo; }
                	if (mcs == 33) { total = 48.936 * mimo; }
	        }
        	if (bandwidth == 75) {
                	if (mcs == 9) { total = 11.832 * mimo; }
	                if (mcs == 15) { total = 22.920 * mimo; }
        	        if (mcs == 26) { total = 55.056 * mimo; }
                	if (mcs == 33) { total = 75.376 * mimo; }
	        }
        	if (bandwidth == 100) {
                	if (mcs == 9) { total = 15.840 * mimo; }
	                if (mcs == 15) { total = 30.576 * mimo; }
        	        if (mcs == 26) { total = 75.376 * mimo; }
                	if (mcs == 33) { total = 97.896 * mimo; }
	        }
		if(total > 0){
			rate.innerHTML = total.toFixed(2) + ' Mbps';
		}else{
			rate.innerHTML = '&nbsp;';
		}
		caTotal += total;
	}

	var rateTotal = d.getElementById("rateTotal");

	if(caTotal > 0){
		rateTotal.innerHTML = caTotal.toFixed(2) + ' Mbps';
	}else{
		rateTotal.innerHTML = 'Results...';
	}



}


</script>



<style>

	select{ width:70px; margin:2px; padding:3px; font-size:10px;font-weight:bold;text-align:center;border-radius:6px;}
        select{ border-radius:6px;}

	tr{border:none;}
	td{width:100px; border-right:1px dotted #000;}
	th{text-align:right;}
	.tableheader > td { font:20px; font-weight:bold;}
        #form{margin:auto; font-size:14px;font-weight:bold;text-align:center; color:#6C7A89;}
	.total{ font-size: 24px; font-weight:bold; color:#6C7A89; border:4px solid #6C7A89; border-radius:10px; background-color:#ddd; padding:10px;margin:15px 60px;}
	.subtotals {font-size:18px; color:#6C7A89;font-weight:bold; }
	h3{ font-size:24px; padding:0px;margin:3px;}

        .container{border:5px solid #6C7A89; vertical-align:middle; padding:10px;background-color:#DADFE1; border-radius:10px; width:600px;margin:15px auto;}
        .container h3{color:#6C7A89; text-align:center;}
        .container > div{text-align:left;vertical-align:top;border:2px dashed #6C7A89; padding:5px 10px;background-color:#ecf0f1; border-radius:10px;}

	.center_me {text-align:center !important;}


</style>

</head>

<body>


<div class='container'>
<h3>LTE Maximum Throughput Calculator</h3>
<div>
<form id="form" name="form" onchange="calc()">
<table>
<tr class='tableheader'>
	<td>Primary Cell</td>
	<td>1st CA Cell</td>
	<td>2nd CA Cell</td>
	<td>3rd CA Cell</td>
</tr>
<tr>
	<td><?PHP makeDropdown('bandwidth1', $bandwidth); ?></td>
	<td><?PHP makeDropdown('bandwidth2', $bandwidth); ?></td>
	<td><?PHP makeDropdown('bandwidth3', $bandwidth); ?></td>
	<td><?PHP makeDropdown('bandwidth4', $bandwidth); ?></td>
	<th>Bandwidth</th>
</tr>
<tr>
	<td><?PHP makeDropdown('mcs1', $mcs); ?></td>
	<td><?PHP makeDropdown('mcs2', $mcs); ?></td>
	<td><?PHP makeDropdown('mcs3', $mcs); ?></td>
	<td><?PHP makeDropdown('mcs4', $mcs); ?></td>
	<th>Modulation</th>
</tr>
<tr>
	<td><?PHP makeDropdown('mimo1', $mimo); ?></td>
	<td><?PHP makeDropdown('mimo2', $mimo); ?></td>
	<td><?PHP makeDropdown('mimo3', $mimo); ?></td>
	<td><?PHP makeDropdown('mimo4', $mimo); ?></td>
	<th>MIMO</th>
</tr>

<tr class='subtotals'>
    	<td><span id="rate1">&nbsp;</span></td>
    	<td><span id="rate2">&nbsp;</span></td>
    	<td><span id="rate3">&nbsp;</span></td>
    	<td><span id="rate4">&nbsp;</span></td>
</tr>
</table>
</form>

	<div class='total center_me' id='rateTotal'>Results...</div>
</div>
</div>


<div class='container'>
        <div>
        The javascript & formulas used here is a modified version of <a href='http://anisimoff.org/eng/lte_throughput_calculator.html' target='blank'>this</a> online calculator.
        Most of the credit goes to it's original creator, Alexey Anisimov. I simply expanded upon that source code to add Carrier Aggregation into his calculations.<br><br>
        I highly encourage you to read the source website for a good tutorial on how this throughput is calculated. <br><br>
        <li><a href='http://anisimoff.org/eng/lte_throughput.html' target='_blank'>How to calculate LTE throughput</a></li><br>

        </div>
</div>

</body>
</html>
