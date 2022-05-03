
$(document).ready(ajax);
setInterval(ajax, 5000);



function ajax(){
    var url= window.location.href;
    var index = url.lastIndexOf("/");
    var id=url.substring(index+1);


    var token = $('meta[name="csrf-token"]').attr('content');

           var request= $.ajax({

            headers: {'X-CSRF-TOKEN': token},
              url: '/broadcast/'+id+'/json',
              type: 'get',

           });
           request.done(function(data){
            obj=JSON.parse(data);
            generateStart(obj);
            
            


});
        
}


function valami(){


    
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
   if (json.lastfilled==-1) return "-";
   if (json.completed=0)output=(json.lastfilled+1)+". feladat: ";
   for (i=0;i<judges.length;i++){
    judge=judges[i];

    if (json.completed==1) 
    output+="| <span class='text-success font-weight-bold '>"+judge.position+": "+judge.mark+"p ("+ judge.percent +"%)" +"</span>";
    else output+="| <span>"+judge.position+": "+judge.lastMark+"p ("+ judge.percent +"%)" +"</span>";
    
   }
   return output;
}