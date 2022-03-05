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
            var request = $.ajax({

              headers: {'X-CSRF-TOKEN': token},
               type:'POST',
               url:'/result/ajaxUpdate/'+resultID,
               data:{"assessment":jsonObj,"error":error},

                });
            request.done(function( msg ) {
            console.log("hello");
          });
 
          request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
          });
         }