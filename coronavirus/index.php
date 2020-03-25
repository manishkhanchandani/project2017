<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="./jquery.min.js"></script>
<script src="./parse-latest.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
Parse.initialize("myAppId");
Parse.serverURL = "https://hitliaapp.herokuapp.com/parse";

</script>
</head>

<body>
<h1>Corona <span id="sid"></span></h1>
<p><a href="1.php" target="_blank">Refresh</a></p>

<table class="table table-striped table-dark">
  <thead class="thead-dark">
  <tr>
    <td><strong>Country</strong></td>
    <td><strong>Total Cases</strong></td>
    <td><strong>New Cases</strong></td>
    <td><strong>Total Death</strong></td>
    <td><strong>New Death</strong></td>
    <td><strong>Total Recoverd</strong></td>
    <td><strong>Active Cases</strong></td>
    <td><strong>Serios Critical</strong></td>
    <td><strong>Totalcases 1m pop</strong></td>
    <td><strong>Total Death 1m pop</strong></td>
  </tr></thead>
  <tbody id="coronabody">
  </tbody>
  
</table>
<script>
const q = new Parse.Query("Coronavirus");
q.descending("createdAt");
q.first().then((results) => {
	console.log('results is ', results);
	const sid = results.get('sid');
	$('#sid').html(sid);
	console.log('sid iis ', sid);
	const q2 = new Parse.Query("Coronavirus");
	q2.equalTo("sid", sid);
	q2.ascending("sorting");
	q2.limit(500);
	q2.find().then((results2) => {
		console.log('results2 is ', results2);
		let tr = '';
		for (let i = 0; i < results2.length; i++) {
			tr += '<tr>';
    		tr += '<td>' + results2[i].get('country') + '</td>';
    		tr += '<td>' + results2[i].get('total_cases') + '</td>';
    		tr += '<td>' + results2[i].get('new_cases') + '</td>';
    		tr += '<td>' + results2[i].get('total_deaths') + '</td>';
    		tr += '<td>' + results2[i].get('new_deaths') + '</td>';
    		tr += '<td>' + results2[i].get('total_recovered') + '</td>';
    		tr += '<td>' + results2[i].get('active_cases') + '</td>';
    		tr += '<td>' + results2[i].get('serious_critical') + '</td>';
    		tr += '<td>' + results2[i].get('totalcases_1mpop') + '</td>';
    		tr += '<td>' + results2[i].get('totaldeaths_1mpop') + '</td>';
			tr += '</tr>';
			console.log('result2: ', results2[i]);
		}
		$('#coronabody').html(tr);
	});
});
</script>
</body>
</html>