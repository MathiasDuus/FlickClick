function getheader() {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200)
            document.getElementById("header").innerHTML = this.responseText;}
        
    xmlhttp.open("GET", "../php/bin/header.php", true);
    xmlhttp.send();
}