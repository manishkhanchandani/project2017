<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Corona se Karo Pyar</title>
<script src="./jquery.min.js"></script>
<script src="./parse_2_11.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
Parse.initialize("myAppId");
Parse.serverURL = "https://hitliaapp.herokuapp.com/parse";

</script>
<style type="text/css">
th {
  background: white;
  position: sticky;
  top: 0;
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
</style>

<meta property="og:title" content="CoronaVirus se karo pyar" /> 
<meta property="og:description" content="coronavirus statistics" /> 
<meta property="og:image" og:image:width="720" og:image:height="405" content="http://corona.mkgalaxy.com/images/corona1.jpg" />
<meta property="og:type" content="information"/>
<meta property="og:url" content="http://corona.mkgalaxy.com/" />
<meta property="og:site_name" content="CoronaVirus" />   
<meta name="title" content="CoronaVirus se karo pyar" />
<meta name="description" content="coronavirus statistics" />
<link rel="image_src" href="http://corona.mkgalaxy.com/images/corona1.jpg" />
<meta name="keywords" content="caronavirus, carona, virus, covid19">
<meta name="robots" content="noarchive">
<script>
var topics = [];
var page = 0;
var currentpage = 0;
var sorting = 'createdAt';
var sortingAsc = false;
$( document ).ready(function() {
  // Handler for .ready() called.
});
</script>
</head>

<body>
<h1>CoronaVirus Cases</h1>

<p>Id: <span id="sid"></span> <a href="javscript:;" onclick="page=page-1; if (page < 0) page = 0; if (currentpage === page) return; nextpage(topics[page]);">Previous Page</a> | <a href="javscript:;" onclick="page=page+1; if (page >= topics.length) page = topics.length - 1; if (currentpage === page) return;  nextpage(topics[page]);">Next Page</a></p>

<table class="table table-striped table-dark">
  <thead class="thead-light">
  <tr>
    <th><strong>Country</strong></th>
    <th><strong>Total Cases</strong></th>
    <th><strong>New Cases</strong></th>
    <th><strong>Total Death</strong></th>
    <th><strong>New Death</strong></th>
    <th><strong>Total Recoverd</strong></th>
    <th><strong>Active Cases</strong></th>
    <th><strong>Serios Critical</strong></th>
    <th><strong>Totalcases 1m pop</strong></th>
    <th><strong>Total Death 1m pop</strong></th>
  </tr></thead>
  <tbody id="coronabody">
  	<?php include('content.php'); ?>
  </tbody>
  
</table>
<script>
function nextpage(sid) {
	currentpage = page;
	$('#sid').html(sid);
	/*const q = new Parse.Query("Coronavirus");
	if (sortingAsc) {
		q.ascending(sorting);
	} else {
		q.descending(sorting);
	}
	q.first().then((results) => {
		console.log('results is ', results);
		const sid = results.get('sid');
		$('#sid').html(sid);*/
		console.log('sid iis ', sid);
		const q2 = new Parse.Query("Coronavirus");
		q2.equalTo("sid", sid);
		q2.ascending("sorting");
		q2.limit(500);
		q2.find().then((results2) => {
			console.log('results2 is ', results2);
			let tr = '';
			for (let i = 0; i < results2.length; i++) {
				let styleTag = '';
				if (results2[i].get('new_cases')) {
					styleTag = 'style="font-weight: bold; text-align:right;background-color:#FFEEAA;color:black;"';
				}
				tr += '<tr>';
				tr += '<td>' + results2[i].get('country') + '</td>';
				tr += '<td>' + results2[i].get('total_cases') + '</td>';
				tr += '<td ' + styleTag + '>' + results2[i].get('new_cases') + '</td>';
				tr += '<td>' + results2[i].get('total_deaths') + '</td>';
				styleTag = '';
				if (results2[i].get('new_deaths')) {
					styleTag = 'style="font-weight: bold; text-align:right;background-color:red; color:white"';
				}
				tr += '<td ' + styleTag + '>' + results2[i].get('new_deaths') + '</td>';
				tr += '<td>' + results2[i].get('total_recovered') + '</td>';
				tr += '<td>' + results2[i].get('active_cases') + '</td>';
				tr += '<td>' + results2[i].get('serious_critical') + '</td>';
				tr += '<td>' + results2[i].get('totalcases_1mpop') + '</td>';
				tr += '<td>' + results2[i].get('totaldeaths_1mpop') + '</td>';
				tr += '</tr>';
			}
			$('#coronabody').html(tr);
			  $.post("save.php", 'data='+encodeURIComponent(tr), function(result){
				  console.log('r is ', result);
			  });
		});
	//});
}


const qD = new Parse.Query("CoronavirusSids");
qD.descending('sidTime');
qD.find().then((res) => {
	for (let i = 0; i < res.length; i++) {
		topics.push(res[i].get('sid'));
	}
	console.log('topics: ', topics);
	nextpage(topics[page]);
});

</script>
</body>
</html>