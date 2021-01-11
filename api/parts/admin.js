    var loadFile1 = function(event) {
		document.getElementById('output1').hidden = false;
    	var output1 = document.getElementById('output1');
    	output1.src = URL.createObjectURL(event.target.files[0]);
    };

    var loadFile2 = function(event) {
		document.getElementById('output2').hidden = false;
    	var output2 = document.getElementById('output2');
    	output2.src = URL.createObjectURL(event.target.files[0]);
    };

	$(".bttn-delete").click(function(){
		document.getElementById('output1').hidden = true;
		document.getElementById('output2').hidden = true;
		$('#user_form')[0].reset();
    });

	$(".bttn-success").click(function(){
		document.getElementById('output1').hidden = true;
		document.getElementById('output2').hidden = true;
    });

    $('#content').on('input', function(e) {
	    this.style.height = '100px';
	    this.style.height = (this.scrollHeight + 5) + 'px'; 
	});
