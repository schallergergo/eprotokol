
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
            var name=generateName(obj);
            document.getElementById("name").innerText=name;

            var result=generateResult(obj);
            document.getElementById("result").innerText=result;


});
           

}


function generateName(json){



    return json.rider+" - "+json.horse+" - "+json.club;

}

function generateResult(json){

   judges=json.judges;
   
   if (judges.length==0) return " ";
	if (json.lastfilled=="") return "";
  if (json.lastfilled==0 && judges[0].lastMark=="") return "";
   output=(json.lastfilled+1)+". feladat ";
   for (i=0;i<judges.length;i++){
    judge=judges[i];
    output+="| "+judge.position+" bíró: "+judge.lastMark+" p ("+ judge.percent +"%) ";
   }
   return output;
}