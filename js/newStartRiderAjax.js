window.onload = function() {
	
	document.getElementById("rider_name").addEventListener("input",getRiderData);
    document.getElementById("horse_name").addEventListener("input",getHorseData);
}
    function getRiderData(){
    		
    		var token = $('meta[name="csrf-token"]').attr('content');
    		inputText = document.getElementById("rider_name").value;

    		if (inputText=="") return;
    		$.ajax({
            headers: {'X-CSRF-TOKEN': token},
              url: '/ajax/getRiderData',
              method: 'get',
				success: function(data) {
        			autocompleteRider(inputText,JSON.parse(data)) // Store the data
           			},
    			error: function(error) {
        			console.error('Error fetching data:', error);
    			}
});

}

function autocompleteRider(inputText,startArray) {
	
    const filteredStarts = startArray.filter(start =>
        start.rider_name.toLowerCase().startsWith(inputText.toLowerCase())
    );
    if (filteredStarts.length>0) 
    {
    	document.getElementById("findRiderName").innerText=filteredStarts[0].rider_name;
    	document.getElementById("findRiderId").innerText=filteredStarts[0].rider_id;
        document.getElementById("findRiderClub").innerText=filteredStarts[0].club;
    }


}


function fillRider(){

	document.getElementById("rider_name").value = document.getElementById("findRiderName").innerText;
	document.getElementById("rider_id").value = document.getElementById("findRiderId").innerText;
    document.getElementById("club").value = document.getElementById("findRiderClub").innerText;
  
  }
