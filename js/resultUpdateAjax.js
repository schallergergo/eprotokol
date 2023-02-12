window.onload = function() {
  'use strict';

var marks=document.getElementsByClassName("mark");


  for (let i=0;i<marks.length;i++)
    {
  marks[i].addEventListener("focusout", getAssessment);
}
 
  //getAssessment();
  
};

 function getAssessment() {
            var url = document.URL;
            var resultID=url.substring(url.lastIndexOf('/') + 1);
            var remark = document.getElementsByName("remark[]");
            var mark = document.getElementsByName("mark[]");
            var error= document.getElementById("error");
            error=error.options[error.selectedIndex].value;
            var token = $('meta[name="csrf-token"]').attr('content');
            jsonObj=[];
            
            if (remark.length==mark.length){
              
              for (i=0;i<remark.length;i++){
                data={};
                data["mark"]=mark[i].value;
                data["remark"]=remark[i].value;

                jsonObj.push(data);
              }

            }
             request = $.ajax({

              headers: {'X-CSRF-TOKEN': token},
               type:'POST',
               url:'/result/ajaxUpdate/'+resultID,
               data:{"assessment":jsonObj,"error":error},
               
            });
	request.done(function( msg ) {	
		alerted=false;
		});
	request.fail(function( jqXHR, textStatus ) {
		if (!alerted){
            		alert( "Request failed: no internet" );
			download(resultID+".txt",generateText(jsonObj));
			alerted=true;
		}
          });
         }


function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);

  element.style.display = 'none';
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}

function generateText(jsonObj){


  out="";
  for (i=0;i<jsonObj.length;i++) out+=jsonObj[i].mark+"\t";

  out+="\n";
  for (i=0;i<jsonObj.length;i++) out+=i+1+".: "+jsonObj[i].remark+"\n";
  return out;
}
