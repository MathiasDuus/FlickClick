function activeNavItem() {
     setTimeout(function () {
    if (document.URL.includes("index")) {
        document.getElementById("frontpage").className += " active";}
    
    else if (document.URL.includes("news")) {
        document.getElementById("news").className += " active";}
    
    else if (document.URL.includes("contact")) {
        document.getElementById("contact").className += " active";}   
    }, 150);
}