var t1=new Array();
var t2=new Array();
t1[0]="Ordinateur";
t1[1]="Ecran";
t1[2]="Voiture";
t1[3]="Arbre";
t1[4]="Collaborateur";
t1[5]="Architecte";
t1[6]="Pigmentation";
t1[7]="Commande";

t2[0]="Computer";
t2[1]="Screen";
t2[2]="Car";
t2[3]="Tree";
t2[4]="Colaborator";
t2[5]="Designer";
t2[6]="Pigmentation";
t2[7]="Order";

var t3=new Array();
var cpt=1;
for(var i=0;i<=7;i++)
    {
        var c=Math.random()*10;
        c=Math.floor(c);
        if(c>=0 && c<8 && t3.indexOf(c)==-1)
            {
                t3[i]=c;
               var x=document.getElementById("btn"+cpt);
                x.value=t1[c];
                cpt++;
            }else
                {
                    i--;
                }
    }

t3=new Array();
for(var i=0;i<=7;i++)
    {
        var c=Math.random()*10;
        c=Math.floor(c);
        if(c>=0 && c<8 && t3.indexOf(c)==-1)
            {
                t3[i]=c;
               var x=document.getElementById("btn"+cpt);
                x.value=t2[c];
                cpt++;
            }else
                {
                    i--;
                }
    }
var p=0;
var containers = document.getElementsByClassName('box')
    for(const container of containers) 
    {
        container.addEventListener("dragover", dragover)
        container.addEventListener("dragenter", dragenter)
        container.addEventListener("drop", drop)
       
        p++;
    }
var cpt=0; 

function dragover(e) 
{
    e.preventDefault()  
}
var t6=new Array();
var t7=new Array();

function dragenter(e) 
{
    e.preventDefault();
    t6[cpt]=e.target.value;
    t7[cpt]=e.target.id;
    cpt++; 
}

var cptt=0;
var note=0;
let score = document.getElementById("score");
function drop(e) 
{   
    cpt=0;
    var text1=t6[0];
    var text2=t6[t6.length-1];
    var id1=t7[0];
    var id2=t7[t7.length-1];
 
    var x = document.getElementById(id1);
    var y = document.getElementById(id2);
    
    if(t1.indexOf(text1)==t2.indexOf(text2))
        {
            y.style.backgroundColor="lightgreen";
            x.style.backgroundColor="lightgreen";
            x.removeAttribute("draggable");
            y.removeEventListener("dragover", dragover)
            y.removeEventListener("dragenter", dragenter)
            y.removeEventListener("drop", drop)
                cptt++;
                note+=12.5;
                if(cptt==8)
                {
                    alert("Bravo ! vérifiez votre score en bas");
                    cptt=0;
                    clearInterval(cron);
                }    
        }else
            {
                y.style.backgroundColor="darkred";
                x.style.backgroundColor="darkred";
                note-=2.5;
            }
        
    t6=new Array();
    t7=new Array();
    score.value="votre score est : " +note;
}

/* chrono */

let hour = 0;
let minute = 0;
let second = 0;
let millisecond = 0;

let cron;

document.form_main.start.onclick = () => start();
document.form_main.reset.onclick = () => reset();

function start() {
  pause();
  cron = setInterval(() => { timer(); }, 10);
}

function pause() {
  clearInterval(cron);
}

function reset() {
  hour = 0;
  minute = 0;
  second = 0;
  millisecond = 0;
  document.getElementById('hour').innerText = '00';
  document.getElementById('minute').innerText = '00';
  document.getElementById('second').innerText = '00';
  document.getElementById('millisecond').innerText = '000';
  location.reload();
}

function timer() {
  if ((millisecond += 10) == 1000) {
    millisecond = 0;
    second++;
  }
  if (second == 60) {
    second = 0;
    minute++;
  }
  if (minute == 60) {
    minute = 0;
    hour++;
  }
  document.getElementById('hour').innerText = returnData(hour);
  document.getElementById('minute').innerText = returnData(minute);
  document.getElementById('second').innerText = returnData(second);
  document.getElementById('millisecond').innerText = returnData(millisecond);
}

function returnData(input) {
  return input > 10 ? input : `0${input}`
}

/* data en localstorage */

function saveFunction(){
    localStorage.setItem("score",score.value);
    location.reload();
}