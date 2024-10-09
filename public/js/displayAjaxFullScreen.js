
$(document).ready(ajax);
setInterval(ajax, 5000);
count=0;



function ajax(){
      var url= window.location.href;
      var index = url.lastIndexOf("/");
      var id=url.substring(index+1);


    var token = $('meta[name="csrf-token"]').attr('content');
            var output;
           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/competition/activeEvents/'+id,
              type: 'get',

           });
           request.done(function(data){
            console.log("data"+data);
            var obj=JSON.parse(data);
            console.log("node "+obj.length);
            


    events=obj;

    console.log("events"+events);

    ln=events.length;
    if (ln==0)
    {
notStarted("","/storage/logo/logo_med.png");
        return;
    }
    id=events[count%ln];
    count++;
    var token = $('meta[name="csrf-token"]').attr('content');

           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/broadcast/'+id+'/json',
              type: 'get',

           });
           request.done(function(data){
            obj=JSON.parse(data);
            if (obj.rider=="" || !hasAnyPoints(obj)) notStarted(obj.event_name,obj.sponsor_logo);
            else generateStart(obj);
            
            


});


});

}
function hasAnyPoints(json){
    judges=json.judges;
    if (judges.length==0) return false;
   if (json.lastfilled==0 && judges[0].lastMark=="") return false;
   return true;
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