    var competitionSelect;

    window.onload = function() {
    competitionSelect = document.getElementById("competition");

    competitionSelect.addEventListener("change",getEvents);
}; 


    function getEvents(){
      var id=competitionSelect.value;

    var token = $('meta[name="csrf-token"]').attr('content');

           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/competition/getEvents/'+id,
              type: 'get',

           });
           request.done(function(data){
            obj=JSON.parse(data);
            console.log(obj);
            fillSelect(obj);
            


});

}


function fillSelect(events){

  console.log(events.length);
  var eventSelect=document.getElementById("event");

  eventSelect.innerHTML="<option value=''>-----x-x-x-----</option>";
  for (i=0;i<events.length;i++){
    eventSelect.innerHTML+="<option value='"+events[i].event_id+"'>"+events[i].event_name+"</option>"
  }
}