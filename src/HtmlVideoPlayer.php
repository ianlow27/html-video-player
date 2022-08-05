<?php

namespace Ianl28\HtmlVideoPlayer;

class HtmlVideoPlayer{

  public function __construct(){

  }


  public function gethtml(){
   
    //--------------------------------
    //--------------------------------
    return '
<script>
const cgfchhunaniaethap="videoplayer"; 
const cgfchenwap       ="Video Player"; 
const cgfchtroadigaeth ="1.0.0"; 
const cgfchdiweddarwyd ="220802";
const cgfchblaenddodiad="fch"; 
//------------------
let afideoedd = new Array();
</script>

<h2 style="float:left;width:50%;">VideoPlayer</h2>
<button onclick="mewnforio();" style="float:left:width:20%;" >Import</button>
<button onclick="allforio();" style="float:left:width:20%;" >Export</button>

<input id="txfideo" style="width:60%;float:left;" placeholder="paste video URL here!" type="text" />
<button onclick="mewnosod();"  style="width:25%;float:left;" >input</button>

<video style="float:left; width:50%;" id="fideochwaraewr" controls autoplay>
  <source src="" id="fideodarddiad" type="video/mp4" />
</video>
<div style="float:left; margin-left:10px; width:45%;overflow-y:scroll;height:100px;" id="dvrhestr">
</div>

<div id="dvmanylion" style="word-break:break-all;width:70%;float:left;" ></div>
<button  onclick="dileu();" style="width:25%; float:left;" >delete</button>

<input type="file" id="inputfile1" style="display:none;" onchange="dialogfileread2locstorage();"/>

<script>
//======================================
let lmynegai=0;
let lmynegaiolaf=0; 
let lchwaraewr = document.getElementById(\'fideochwaraewr\');
let lfideo = document.getElementById(\'fideodarddiad\');
lchwaraewr.addEventListener(\'ended\', ymdriniwr, false);
window.addEventListener(\'resize\', ailfeintioli, false);
lfideo.src = afideoedd[lmynegai];
main();
//------------------------------
function main(){
  let lfch_rhestr = String(localStorage.getItem("fch_rhestr"));
  if(lfch_rhestr=="null") lfch_rhestr="";
  afideoedd = lfch_rhestr.split(/_```_/); 
  let ldvrhestr = document.getElementById("dvrhestr");
  ldvrhestr.style.whiteSpace="nowrap";
  let lrhestr="";
  for(let i=0; i<afideoedd.length; i++){
    if(afideoedd[i] == "") continue;
    lrhestr+= "<span onclick=\'chwarae("+i+");\' id=\'sprhestr"+i+"\' >" + (i+1)+". "+afideoedd[i] + "</span><br/>";
  }//endfor

  ldvrhestr.innerHTML = lrhestr;

  chwarae(0); 
}//endfunc
//------------------------------
function ymdriniwr(e){
  lmynegai++;
  if(lmynegai >= afideoedd.length) lmynegai=0;
  chwarae(lmynegai);
}//endfunc
//------------------------------
function chwarae(pmynegai){
setTimeout(function(){

  lmynegai = pmynegai;
  lfideo.src = afideoedd[lmynegai];
  document.getElementById("dvmanylion").innerHTML = lfideo.src;

  let lsprhestr0 = document.getElementById("sprhestr"+lmynegaiolaf);

  if(lsprhestr0 == null){ 
    lmynegaiolaf--;
    if(lmynegaiolaf < 0) lmynegaiolaf=0;
    lsprhestr0 = document.getElementById("sprhestr"+lmynegaiolaf);
  }

  lsprhestr0.style.fontWeight = "normal";

  let lsprhestr = document.getElementById("sprhestr"+lmynegai);
  lsprhestr.style.fontWeight = "bold";
  lchwaraewr.load(); 
  lchwaraewr.play(); 

  lmynegaiolaf = lmynegai;
},200);
}
//------------------------------
function ailfeintioli(){
  document.getElementById("dvrhestr")
   .style.height =
   document.getElementById("fideochwaraewr")
   .getBoundingClientRect().height
    + "px";
}//endfun
//------------------------------
function mewnosod(){
  console.log("mewnosod");
  let txfideo=document.getElementById("txfideo");
  let lfch_rhestr = String(localStorage.getItem("fch_rhestr"));
  if(lfch_rhestr == "null") lfch_rhestr="";
  lfch_rhestr+=txfideo.value+"_```_";
  console.log(txfideo.value);
  localStorage.setItem("fch_rhestr", lfch_rhestr);
  txfideo.value="";
  main();
}//endfunc
//------------------------------
function dileu(){
  console.log("dileu_" + lmynegai);
  let lfch_rhestr = "";
  for(let i=0; i<afideoedd.length; i++){
    if(i == lmynegai) continue;
    if(afideoedd[i] == "") continue;
    lfch_rhestr+=afideoedd[i] + "_```_";
  }//endfor
  localStorage.setItem("fch_rhestr", lfch_rhestr);
  lmynegai--;
  if(lmynegai < 0) lmynegai = 0;
  main();

}//endfunc
//------------------------------
function mewnforio(){
  console.log("mewnforio");
  let elem = document.getElementById("inputfile1");
  if(elem && document.createEvent){
    let evt = document.createEvent("MouseEvents");
    evt.initEvent("click", true, false);
    elem.dispatchEvent(evt);
  }
}//endfunc
//------------------------------
function allforio(){
  console.log("allforio");
  let text2save = String(localStorage.getItem("fch_rhestr"));
  if((text2save == "null")||(text2save =="")){
    return;
  }else {
    text2save = text2save.replace(/_```_/g, "\r\n\r\n");
  }
  console.log(text2save);

  let text2saveasblob = new Blob([text2save], { type:" text/plain"});
  let text2saveasurl = window.URL.createObjectURL(text2saveasblob);
  let downloadlink = document.createElement("a");
  downloadlink.download = "chwaraerestr.txt";
  downloadlink.href = text2saveasurl;
  downloadlink.onclick = function(){
    document.body.removeChild(event.target);
  }
  downloadlink.style.display = "none";
  document.body.appendChild(downloadlink);
  downloadlink.click();

}//endfunc
//------------------------------
function dialogfileread2locstorage(){
let e = window.event;
  let file = e.target.files[0];
  let reader = new FileReader();
  reader.readAsText(file);
  reader.onload = readerEvent => {
    let content = readerEvent.target.result;
    let atmpa1=content.split(/\n/);
    let lstr="";
    for(let i=0; i<atmpa1.length; i++){
      atmpa1[i] = atmpa1[i].trim();
      if(atmpa1[i] == "") continue;
      if(lstr.trim() != "") lstr+="_```_";
      lstr+=atmpa1[i];
    }
    let ltmp1 = String(localStorage.getItem("fch_rhestr") );
    if((ltmp1=="null")||(ltmp1=="")) ltmp1=lstr;
    else  ltmp1+= "_```_" + lstr;

    ltmp1 = ltmp1.replace(/_```__```_/g, "_```_"); 
    localStorage.setItem("fch_rhestr", ltmp1 );
    lmynegai=0;
    main();
  }//end readerEvent
}//endfunc
//------------------------------
if (!String.prototype.trim) {
   (function() {
      // Make sure we trim BOM and NBSP
      var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
      String.prototype.trim = function() {
        return this.replace(rtrim, "");
      };
   })();
}//endfunc
//------------------------------
//------------------------------
//------------------------------
//------------------------------
//------------------------------
</script>
    ';
    //--------------------------------
    //--------------------------------

  }


}//endclass



?>
