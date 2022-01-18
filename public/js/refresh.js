var blurred=false;
 window.onload = function(e) {
    setInterval(refresh,1000*180);
};
window.onblur = function () {blurred=true;};
window.onfocus = function () {blurred && location.reload();};
function refresh() {
  location.reload();
  }