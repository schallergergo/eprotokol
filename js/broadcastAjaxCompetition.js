
$(document).ready(ajax);
setInterval(ajax, 5000);
competitionId = document.getElementById("competition_id").value;

function ajax(){


     competitionId = document.getElementById("competition_id").value;

    var token = $('meta[name="csrf-token"]').attr('content');


    var request2= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
            url: '/broadcast/competition/'+competitionId+'/json',
              type: 'get',

           });
           request2.done(function(data2){
            obj=JSON.parse(data2);
            var id=obj["id"];
            console.log(obj);





           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/broadcast/'+id+'/json',
              type: 'get',

           });
           request.done(function(data){
            console.log(data);
            obj=JSON.parse(data);

            var name=generateName(obj);
            document.getElementById("event_h").innerText = obj["event_name"];
            document.getElementById("name").innerText=name;

            var result=generateResult(obj);
            document.getElementById("result").innerText=result;


    });

     

});
           
           

}


function generateName(json){



    return json.rider+" - "+json.horse+" - "+json.club;

}

function generateResult(json){

   judges=json.judges;
   output=""
   if (judges.length==0) return " ";
    if (json.lastfilled=="") return "";
  if (json.lastfilled==0 && judges[0].lastMark=="") return "";
   if (json.completed==0)output=(json.lastfilled+1)+". feladat ";
   for (i=0;i<judges.length;i++){
    judge=judges[i];
    if(json.completed==0) output+="| "+judge.position+" bíró: "+judge.lastMark+" p ("+ judge.percent +"%) ";
    else output+="| "+judge.position+" bíró: "+judge.mark+" p ("+ judge.percent +"%) ";
   }
   return output;
}