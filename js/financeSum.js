window.onload = function() {
	
	document.getElementById("startFeeForm").addEventListener("input",sumStartFee);
    document.getElementById("checkAllStart").addEventListener("input",checkAllStartFunc);
}
   
function sumStartFee(){
    total=0;
    let nodes = document.getElementsByName("startfee[]");
    count = 0
    for (i=0;i<nodes.length;i++)
    {
        if (nodes[i].checked) 
            { total+=parseInt(nodes[i].parentElement.innerText);
                    count++;
            }
        
    }
    document.getElementById("startFeeTotal").innerText=total;
    document.getElementById("startFeeCount").innerText=count + "start";
}

function checkAllStartFunc(){
    checked=document.getElementById("checkAllStart").checked;
    let nodes = document.getElementsByName("startfee[]");
    
    for (i=0;i<nodes.length;i++)
    {
        if (!nodes[i].disabled) nodes[i].checked = checked;
        
    }

}