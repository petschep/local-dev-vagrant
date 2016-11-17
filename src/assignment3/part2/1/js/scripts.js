wtForm = document.getElementsByTagName('form')[0];
// collecting form Values
	function formValues(formID) {
	    var elements = formID.elements;
	    var obj ={};
	    for(var i = 0 ; i < elements.length ; i++){
	        var item = elements.item(i);
	        obj[item.name] = item.value;
	    }
	    return obj;
	}

document.getElementsByTagName('form')[0].addEventListener("submit", function(e){
	e.preventDefault();
		var results = formValues(document.getElementsByTagName('form')[0]);
		var str = results.number;
		var res = str.replace(",", ".");
		document.getElementById("number").value = res;
		alert(res);
		console.log(res);
});