function validateForm()
    {
        var max_temp=document.forms["stmt"]["max_temp"].value;
		var min_temp=document.forms["stmt"]["min_temp"].value;
		var max_humi=document.forms["stmt"]["max_humi"].value;
		var min_humi=document.forms["stmt"]["min_humi"].value;
		var max_ammonia=document.forms["stmt"]["max_ammonia"].value;
		var min_ammonia=document.forms["stmt"]["min_ammonia"].value;
		var max_carbon=document.forms["stmt"]["max_carbon"].value;
		var min_carbon=document.forms["stmt"]["min_carbon"].value;
		var max_sound=document.forms["stmt"]["max_sound"].value;
	//	var min_sound=document.forms["stmt"]["min_sound"].value;
		var max_motion=document.forms["stmt"]["max_motion"].value;
	//	var min_motion=document.forms["stmt"]["min_motion"].value;
		
       /* if (max_temp=='' || min_temp=='')
        {
			if (max_temp!='' || min_temp!='')
			{
            alert("Please Fill All Required Field");
            return false;
			}
        } */
		
		if (isNaN(max_temp) || isNaN(min_temp) || isNaN(max_humi) || isNaN(min_humi) || isNaN(max_ammonia) || isNaN(max_ammonia) || isNaN(max_carbon) || isNaN(min_carbon) || isNaN(max_sound) || isNaN(max_motion)  ){
			alert("All the values must be some Number");
			return false; }
	
		
		
		if (parseFloat(max_temp*1) >= parseFloat(min_temp*1)){
			alert("'Temperature Goes Below' Field must be lesser than 'Fan Turn Off field'");
			return false; }

		if (parseFloat(max_humi*1) <= parseFloat(min_humi*1)){
			alert("'Humidity Exceeds' Field must be greater than 'Fan Turn Off field'");
			return false; }
			
		if (parseFloat(max_ammonia*1) <= parseFloat(min_ammonia*1)){
			alert("'Ammonia Exceeds' Field must be greater 'Fan Turn Off field'");
			return false; }
			
		if (parseFloat(max_carbon*1) <= parseFloat(min_carbon*1)){
			alert("'Carbon Exceeds' Field must be greater 'Fan Turn Off field'");
			return false; }
						
    }