const cafeList = document.querySelector('#cafe-list');
const form1 = document.querySelector('#form1');

form1.addEventListener('submit', (e) => {
	e.preventDefault();
	let obj = {name: form1.name.value, city: form1.city.value};
	db.collection('cafes').add(obj);
	
	form1.name.value = '';
	form1.city.value = '';
});
function renderCafe(doc) {
	let li = document.createElement('li');
	let name = document.createElement('span');
	let city = document.createElement('span');
	
	li.setAttribute('data-id', doc.id);
	name.textContent = doc.data().name;
	city.textContent = doc.data().city;
	
	li.appendChild(name);
	li.appendChild(city);
	cafeList.appendChild(li);
}

db.collection('cafes').get().then((snapshot) => {
	snapshot.docs.forEach((doc) => {
		renderCafe(doc);					   
	});
});