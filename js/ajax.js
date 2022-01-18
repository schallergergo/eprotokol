window.onload = function() {
  'use strict';

  var ajax = getXHR();
  var url = document.URL;
  var eventID=url.substring(url.lastIndexOf('/') + 1);
  if(ajax) {
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
        if ((ajax.status>=200 && ajax.status<300) 
          || (ajax.status==304) ) {
          console.log(ajax.response)
        } else {
          eredmeny.innerHTML = ajax.statusText;
        }
      }
    };

    document.getElementById("urlap").onsubmit = function() {
      var szam = "szam=" + encodeURIComponent(
        document.getElementById("szam").value);
      ajax.open("GET","event/lastresult/"+eventID, true);
      ajax.setRequestHeader("Content-Type", 
        "application/x-www-form-urlencoded");
      ajax.send(null);
      return false;
    };
  }
};