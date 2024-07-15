var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");

function genPic() {
	var bg_img = new Image();
	bg_img.onload=function(){
        ctx.drawImage(bg_img, 0, 0);
		drawAllImg();
    }
	bg_img.src = "img/bg_"+Math.floor((Math.random() * 9) + 1)+".jpg"
}

function drawAllImg() {
	drawImg(Math.floor(Math.random() * 75),Math.floor(Math.random() * 75),"fig")
	if (Math.random()<0.2) drawImg(Math.floor(Math.random() * 75)+75,Math.floor(Math.random() * 40)+20,"fig")
	drawImg(240,0,"txt")
	if (Math.random()<0.01) drawImg(Math.floor(Math.random() * 200),Math.floor(Math.random() * 200),"pingu")
	ctx.fillStyle = 'white'
	ctx.fillText("andi.grasserisen.de",380,350)
	ctx.fillText("4000+ kostenlose Silvestergrüße",10,350)
}

function drawImg(x,y,type) {
	var max = 1;
	if (type == "fig") max = 8;
	if (type == "txt") max = 7;
	
	var num = Math.floor((Math.random() * max) + 1);
	if (type == "txt" && Math.random()<0.2) num = 7;
	
	var img = new Image();
	img.onload=function(){
        ctx.drawImage(img, x, y, img.width*2, img.height*2);
    }
	img.src = "img/"+type+"_"+num+".png"
}

genPic();

function downloadCanvas(){  
    // get canvas data  
    var image = c.toDataURL();  
  
    // create temporary link  
    var tmpLink = document.createElement( 'a' );  
    tmpLink.download = 'silvesterGruss.png'; // set the name of the download file 
    tmpLink.href = image;  
  
    // temporarily add link to body and initiate the download  
    document.body.appendChild( tmpLink );  
    tmpLink.click();  
    document.body.removeChild( tmpLink );  
}