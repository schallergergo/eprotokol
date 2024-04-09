
    function getHorseData(){
    		
    		var token = $('meta[name="csrf-token"]').attr('content');
    		inputText = document.getElementById("horse_name").value;

    		if (inputText=="") return;
    		$.ajax({
            headers: {'X-CSRF-TOKEN': token},
              url: '/ajax/getHorseData/'+document.getElementById("club").value;,
              method: 'get',
				success: function(data) {
        			autocompleteHorse(inputText,JSON.parse(data)) // Store the data
           			},
    			error: function(error) {
        			console.error('Error fetching data:', error);
    			}
});

}

function autocompleteHorse(inputText,startArray) {

    const filteredStarts = startArray.filter(start =>
        start.horse_name.toLowerCase().startsWith(inputText.toLowerCase())
    );
    if (filteredStarts.length>0) 
    {
    	document.getElementById("findHorseName").innerText=filteredStarts[0].horse_name;
    	document.getElementById("findHorseId").innerText=filteredStarts[0].horse_id;
    }


}


function fillHorse(){

	document.getElementById("horse_name").value = document.getElementById("findHorseName").innerText;
	document.getElementById("horse_id").value = document.getElementById("findHorseId").innerText;
  
  }
