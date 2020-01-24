$(function(){
	var baseurl = $('meta[name=baseurl]').attr("content");

	$(".tab").on("click","button.tablinks",function(){
		var tab_count = $(this).prevAll().length;
		$(".tab .tablinks").removeClass("active");
		$(".button_holder").hide();

		if(tab_count == 0){
			tab_count = 0;
		}else{
			tab_count = tab_count;
		}

		$(".button_holder:eq("+tab_count+")").show();
		$(this).addClass("active");
	});



	$(".main_button").on("click", "button[type='button']", function(){
		var button_clcked = $(this).prevAll().length + 1;
		var section_count = $(this).closest(".button_holder").prevAll().length + 1;
		var count_times = 100;
		var btn_num;

		if(section_count == 1){
			btn_num = button_clcked;
		}else{
			count_times = count_times * (section_count - 1);
			btn_num = count_times + button_clcked;
		}

		// Defining our token parts
		var header = {
			"alg": "HS256",
			"typ": "JWT"
		};

		var data = {
			"btn_number": btn_num
		};

		var secret = "My very confidential secret!!!";

		function base64url(source) {
		  // Encode in classical base64
		  encodedSource = CryptoJS.enc.Base64.stringify(source);
		  
		  // Remove padding equal characters
		  encodedSource = encodedSource.replace(/=+$/, '');
		  
		  // Replace characters according to base64url specifications
		  encodedSource = encodedSource.replace(/\+/g, '-');
		  encodedSource = encodedSource.replace(/\//g, '_');
		  
		  return encodedSource;
		}

		var stringifiedHeader = CryptoJS.enc.Utf8.parse(JSON.stringify(header));
		var encodedHeader = base64url(stringifiedHeader);
		// document.getElementById("header").innerText = encodedHeader;

		var stringifiedData = CryptoJS.enc.Utf8.parse(JSON.stringify(data));
		var encodedData = base64url(stringifiedData);
		// document.getElementById("payload").innerText = encodedData;

		var signature = encodedHeader + "." + encodedData;
		signature = CryptoJS.HmacSHA256(signature, secret);
		signature = base64url(signature);

		var jwt_token = encodedHeader+"."+encodedData+"."+signature;

		$.ajax({
			type: "POST",
			url: baseurl+"validate_button",
		    data: ({token: jwt_token}),
			success: function(response){
				alert(response.message+" - "+response.button_number);
			},
			error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }      
		}); 

	});



});