
$(document).ready(ajax);
setInterval(ajax, 5000);
count=0;
sponsor_count=0;
events = getEvents();
competition = document.getElementById("competition_id").value;

function ajax(){
    events = getEvents();
    console.log(events);
    ln=events.length;
    console.log(ln);
    if (ln==0)
    {
        notStarted(formatTime(new Date()),"/storage/logo/logo_med.png");
        return;
    }
    id=events[count%ln];
    count++;
    if (id == -1) ajaxSponsor(competition); //the backend gets the c this is a shitty solution but it works, so....
    else ajaxNormal(id);

}

function ajaxSponsor(id){

 events=getEvents();

    var token = $('meta[name="csrf-token"]').attr('content');

           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/broadcast/sponsors/'+id+'/json',
              type: 'get',

           });
           request.done(function(data){
            console.log(data);
            obj=JSON.parse(data);
            sponsors = obj["sponsors"];
            sponsor_ln = sponsors.length;
            sponsor_logo = sponsors[sponsor_count%sponsor_ln];
            sponsor_count++;
            notStarted("Szponsor",sponsor_logo);

});

}

function ajaxNormal(id){
    console.log(id);
    var token = $('meta[name="csrf-token"]').attr('content');

           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/broadcast/'+id+'/json',
              type: 'get',

           });
           request.done(function(data){

            obj=JSON.parse(data);
            console.log(obj.sponsor_logo);
            if (obj.rider=="") notStarted(obj.event_name,obj.sponsor_logo);
            else generateStart(obj);
            
            


});
}

function getEvents(){
    events=document.getElementsByName("events");
    eventsArray=Array();
    for (i=0;i<events.length;i++){
        if (events[i].checked) eventsArray.push(events[i].value);
    }
    return eventsArray;
}
function notStarted(event_name,sponsor_logo){

    document.getElementById("header_name").innerText=event_name;
    document.getElementById("rider_name").innerHTML='<img src="'+sponsor_logo+'" class="img-fluid m-10" alt="Eprotokol logo">';
        document.getElementById("horse_name").innerText="";
    document.getElementById("club_name").innerText="";
    document.getElementById("result").innerHTML="";

}
function generateStart(json){
    console.log(json);
    document.getElementById("header_name").innerText=json.event_name;
    document.getElementById("rider_name").innerText=json.rider;
    document.getElementById("horse_name").innerText=json.horse;
    document.getElementById("club_name").innerText=json.club;
    document.getElementById("result").innerHTML=generateResult(json);
    

}


function generateResult(json){

   judges=json.judges;
   output="";
   if (judges.length==0) return " ";
   if (json.lastfilled==0 && judges[0].lastMark=="") return "";
   if (json.completed==0)output=(json.lastfilled+1)+". feladat: ";
   for (i=0;i<judges.length;i++){
    judge=judges[i];
    console.log(judge);
    if (json.completed!=0) 
    output+='<span class="text-success font-weight-bold "> | '+judge.position+': '+judge.mark+'p ('+ judge.percent +'%) </span>';
    else output+='<span> | '+judge.position+': '+judge.lastMark+'p ('+ judge.percent +'%) </span>';
    
   }
   return output;
}


function formatTime(date) {
    let hours = date.getHours().toString().padStart(2, '0');
    let minutes = date.getMinutes().toString().padStart(2, '0');
    return `${hours}:${minutes}`;
}