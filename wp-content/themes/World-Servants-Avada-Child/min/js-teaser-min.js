var len=3,es=document.getElementsByClassName("js-teaser"),str="",trunc="";if(es.length>0)for(var i=0;i<es.length;i++){str="",trunc="";var ps=es[i].getElementsByTagName("p");if(ps.length>0)for(var x=0;x<ps.length;x++)str+=ps[x].innerHTML+" ";trunc=str.split(".").splice(0,len).join("."),es[i].innerHTML="<p>"+trunc+".</p>"}
//# sourceMappingURL=js-teaser-min.js.map