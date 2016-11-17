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

	wtForm = document.getElementById('wtForm');
	wtForm.addEventListener("submit", sumissionScript);

	function sumissionScript(e){
		e.preventDefault();

		var results = formValues(wtForm);

		 var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
		var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

		var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		var l = ((width / 2) - (results.posx / 2)) + dualScreenLeft;
		var t = ((height / 2) - (results.posy / 2)) + dualScreenTop;
		var options = {
	        height: 400, // sets the height in pixels of the window.
	        width: 400, // sets the width in pixels of the window.
	        toolbar: 0, // determines whether a toolbar (includes the forward and back buttons) is displayed {1 (YES) or 0 (NO)}.
	        scrollbars: 0, // determines whether scrollbars appear on the window {1 (YES) or 0 (NO)}.
	        status: 0, // whether a status line appears at the bottom of the window {1 (YES) or 0 (NO)}.
	        resizable: 0, // whether the window can be resized {1 (YES) or 0 (NO)}. Can also be overloaded using resizable.
	        left: l, // left position when the window appears.
	        top: t, // top position when the window appears.
	        center: 0, // should we center the window? {1 (YES) or 0 (NO)}. overrides top and left
	        createnew: 0, // should we create a new window for each occurance {1 (YES) or 0 (NO)}.
	        location: 0, // determines whether the address bar is displayed {1 (YES) or 0 (NO)}.
	        menubar: 0 // determines whether the menu bar is displayed {1 (YES) or 0 (NO)}.
	    };
		
		window.open(results.url, results.title, options);
		console.log(results);
	};