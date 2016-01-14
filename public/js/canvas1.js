function generarBadges(){
    var PI_TWO = Math.PI * 2;
    var text_semana = 10;
    var color1 = document.getElementById('color1').value;
    var color2 = document.getElementById('color2').value;
    //// MEDALLA SEMANA 1 /////

    for(var i=1; i<=12; i++){

    var canvas1 = document.getElementById('canvas'+i);
    text_semana = i;
    //gradiente
    var ctx1 = canvas1.getContext('2d');
    var grd = ctx1.createLinearGradient(0,0, 50, 150);


    grd.addColorStop(0.3, color1);
    grd.addColorStop(0.5, color2);
    grd.addColorStop(1, color1);

    ctx1.fillStyle = grd;

    grd = ctx1.createLinearGradient(0, 0, 50, 150);
    grd.addColorStop(0.3, "black");
    grd.addColorStop(0.5, "grey");
    grd.addColorStop(1, "black");

    ctx1.strokeStyle = grd;

    //circulo
    ctx1.beginPath();
    ctx1.arc(70, 70, 60, 0, PI_TWO);
    ctx1.lineWidth = 20;
    ctx1.stroke();
    ctx1.fill();
    ctx1.closePath();

    ctx1.font = '32pt Arial';
    ctx1.fillStyle = 'white';
    ctx1.strokeStyle = 'grey';

    ctx1.lineWidth = 3;
    if(text_semana>=10){
      ctx1.strokeText(""+text_semana, 20, 90);
      ctx1.fillText(""+text_semana, 20, 90);
    }
    else {
      ctx1.strokeText(""+text_semana, 35, 90);
      ctx1.fillText(""+text_semana, 35, 90);
    }

    ctx1.font = '16pt Arial';
    ctx1.fillStyle = 'white';
    ctx1.strokeStyle = 'grey';

    ctx1.strokeText("semana", 30, 50);
    ctx1.fillText("semana", 30, 50);

    grd = ctx1.createLinearGradient(10, 10, 150, 150);
    grd.addColorStop(0.4, "black");
    grd.addColorStop(0.5, "white");
    grd.addColorStop(1, "black");

    ctx1.fillStyle = grd;
    ctx1.strokeStyle = 'grey';
    ctx1.beginPath();
    ctx1.moveTo(90, 53);
    ctx1.lineTo(95, 70);
    ctx1.lineTo(110,70);
    ctx1.lineTo(100,80);
    ctx1.lineTo(105,93);
    ctx1.lineTo(90,85);//centro abajo
    ctx1.lineTo(75,93);
    ctx1.lineTo(80,80);
    ctx1.lineTo(70,70);
    ctx1.lineTo(85,70);
    ctx1.lineTo(90,53);
    ctx1.stroke();
    ctx1.fill();
    ctx1.closePath();

  }


  var canvas1 = document.getElementById('canvas_completo');
  text_semana = i;
  //gradiente
  var ctx1 = canvas1.getContext('2d');
  var grd = ctx1.createLinearGradient(0,0, 50, 150);
  grd.addColorStop(0.3, color1);
  grd.addColorStop(0.5, color2);
  grd.addColorStop(1, color1);

  ctx1.fillStyle = grd;

  grd = ctx1.createLinearGradient(0, 0, 50, 150);
  grd.addColorStop(0.3, "black");
  grd.addColorStop(0.5, "grey");
  grd.addColorStop(1, "black");

  ctx1.strokeStyle = grd;

  //circulo
  ctx1.beginPath();
  ctx1.arc(70, 70, 60, 0, PI_TWO);
  ctx1.lineWidth = 20;
  ctx1.stroke();
  ctx1.fill();
  ctx1.closePath();
  ctx1.lineWidth = 3;

  ctx1.font = '16pt Arial';
  ctx1.fillStyle = 'white';
  ctx1.strokeStyle = 'grey';

  ctx1.strokeText("completo", 25, 100);
  ctx1.fillText("completo", 25, 100);
  //ESTRELLA 1
  grd = ctx1.createLinearGradient(10, 10, 140, 140);
  grd.addColorStop(0.4, "black");
  grd.addColorStop(0.5, "white");
  grd.addColorStop(1, "black");

  ctx1.fillStyle = grd;
  ctx1.strokeStyle = 'grey';
  ctx1.beginPath();
  ctx1.moveTo(90, 43);
  ctx1.lineTo(95, 60);
  ctx1.lineTo(110,60);
  ctx1.lineTo(100,70);
  ctx1.lineTo(105,83);
  ctx1.lineTo(90,75);//centro abajo
  ctx1.lineTo(75,83);
  ctx1.lineTo(80,70);
  ctx1.lineTo(70,60);
  ctx1.lineTo(85,60);
  ctx1.lineTo(90,43);
  ctx1.stroke();
  ctx1.fill();
  ctx1.closePath();
  //ESTRELLA 2
  grd = ctx1.createLinearGradient(10, 10, 80, 80);
  grd.addColorStop(0.4, "black");
  grd.addColorStop(0.5, "white");
  grd.addColorStop(1, "black");

  ctx1.fillStyle = grd;
  ctx1.strokeStyle = 'grey';
  ctx1.beginPath();
  ctx1.moveTo(45, 43);
  ctx1.lineTo(50, 60);
  ctx1.lineTo(65,60);
  ctx1.lineTo(55,70);
  ctx1.lineTo(60,83);
  ctx1.lineTo(45,75);//centro abajo
  ctx1.lineTo(30,83);
  ctx1.lineTo(35,70);
  ctx1.lineTo(25,60);
  ctx1.lineTo(40,60);
  ctx1.lineTo(45,43);
  ctx1.stroke();
  ctx1.fill();
  ctx1.closePath();
  //ESTRELLA 3
  grd = ctx1.createLinearGradient(0, 0, 80, 80);
  grd.addColorStop(0, "black");
  grd.addColorStop(0.5, "white");
  grd.addColorStop(1, "black");

  ctx1.fillStyle = grd;
  ctx1.strokeStyle = 'grey';
  ctx1.beginPath();
  ctx1.moveTo(70,13);
  ctx1.lineTo(75,30);
  ctx1.lineTo(90,30);
  ctx1.lineTo(80,40);
  ctx1.lineTo(85,53);
  ctx1.lineTo(70,45);//centro abajo
  ctx1.lineTo(55,53);
  ctx1.lineTo(60,40);
  ctx1.lineTo(50,30);
  ctx1.lineTo(65,30);
  ctx1.lineTo(70,13);
  ctx1.stroke();
  ctx1.fill();
  ctx1.closePath();
  //FIN MEDALLA COMPLETA ////

}

function makeCanvasSemanal(semana, color1, color2){

    var PI_TWO = Math.PI * 2;

    var text_semana = semana;
    var canvas1 = document.getElementById('canvas');

    //gradiente
    var ctx1 = canvas1.getContext('2d');
    var grd = ctx1.createLinearGradient(0,0, 50, 150);


    grd.addColorStop(0.3, color1);
    grd.addColorStop(0.5, color2);
    grd.addColorStop(1, color1);

    ctx1.fillStyle = grd;

    grd = ctx1.createLinearGradient(0, 0, 50, 150);
    grd.addColorStop(0.3, "black");
    grd.addColorStop(0.5, "grey");
    grd.addColorStop(1, "black");

    ctx1.strokeStyle = grd;

    //circulo
    ctx1.beginPath();
    ctx1.arc(70, 70, 60, 0, PI_TWO);
    ctx1.lineWidth = 20;
    ctx1.stroke();
    ctx1.fill();
    ctx1.closePath();

    ctx1.font = '32pt Arial';
    ctx1.fillStyle = 'white';
    ctx1.strokeStyle = 'grey';

    ctx1.lineWidth = 3;
    if(text_semana>=10){
      ctx1.strokeText(""+text_semana, 20, 90);
      ctx1.fillText(""+text_semana, 20, 90);
    }
    else {
      ctx1.strokeText(""+text_semana, 35, 90);
      ctx1.fillText(""+text_semana, 35, 90);
    }

    ctx1.font = '16pt Arial';
    ctx1.fillStyle = 'white';
    ctx1.strokeStyle = 'grey';

    ctx1.strokeText("semana", 30, 50);
    ctx1.fillText("semana", 30, 50);

    grd = ctx1.createLinearGradient(10, 10, 150, 150);
    grd.addColorStop(0.4, "black");
    grd.addColorStop(0.5, "white");
    grd.addColorStop(1, "black");

    ctx1.fillStyle = grd;
    ctx1.strokeStyle = 'grey';
    ctx1.beginPath();
    ctx1.moveTo(90, 53);
    ctx1.lineTo(95, 70);
    ctx1.lineTo(110,70);
    ctx1.lineTo(100,80);
    ctx1.lineTo(105,93);
    ctx1.lineTo(90,85);//centro abajo
    ctx1.lineTo(75,93);
    ctx1.lineTo(80,80);
    ctx1.lineTo(70,70);
    ctx1.lineTo(85,70);
    ctx1.lineTo(90,53);
    ctx1.stroke();
    ctx1.fill();
    ctx1.closePath();

}


function makeCanvasSemanal2(semana, color1, color2, porcentaje){

    var PI_TWO = Math.PI * 2;

    var text_semana = semana;
    var canvas1 = document.getElementById('canvas'+semana+"-"+color1+"-"+color2);

    //gradiente
    var ctx1 = canvas1.getContext('2d');
    var grd = ctx1.createLinearGradient(0,0, 50, 150);


    grd.addColorStop(0.3, color1);
    grd.addColorStop(0.5, color2);
    grd.addColorStop(1, color1);

    ctx1.fillStyle = grd;

    grd = ctx1.createLinearGradient(0, 0, 50, 150);
    grd.addColorStop(0.3, "black");
    grd.addColorStop(0.5, "grey");
    grd.addColorStop(1, "black");

    ctx1.strokeStyle = grd;

    //circulo
    ctx1.beginPath();
    ctx1.arc(70, 70, 60, 0, PI_TWO);
    ctx1.lineWidth = 20;
    ctx1.stroke();
    ctx1.fill();
    ctx1.closePath();

    ctx1.font = '32pt Arial';
    ctx1.fillStyle = 'white';
    ctx1.strokeStyle = 'grey';

    ctx1.lineWidth = 3;
    if(text_semana>=10){
      ctx1.strokeText(""+text_semana, 20, 90);
      ctx1.fillText(""+text_semana, 20, 90);
    }
    else {
      ctx1.strokeText(""+text_semana, 35, 90);
      ctx1.fillText(""+text_semana, 35, 90);
    }

    ctx1.font = '16pt Arial';
    ctx1.fillStyle = 'white';
    ctx1.strokeStyle = 'grey';

    ctx1.strokeText("semana", 30, 50);
    ctx1.fillText("semana", 30, 50);

    grd = ctx1.createLinearGradient(10, 10, 150, 150);
    grd.addColorStop(0.4, "black");
    grd.addColorStop(0.5, "white");
    grd.addColorStop(1, "black");

    ctx1.fillStyle = grd;
    ctx1.strokeStyle = 'grey';
    ctx1.beginPath();
    ctx1.moveTo(90, 53);
    ctx1.lineTo(95, 70);
    ctx1.lineTo(110,70);
    ctx1.lineTo(100,80);
    ctx1.lineTo(105,93);
    ctx1.lineTo(90,85);//centro abajo
    ctx1.lineTo(75,93);
    ctx1.lineTo(80,80);
    ctx1.lineTo(70,70);
    ctx1.lineTo(85,70);
    ctx1.lineTo(90,53);
    ctx1.stroke();
    ctx1.fill();
    ctx1.closePath();

    if(porcentaje == 100)
    {
        var canvas1 = document.getElementById('canvas'+semana+"-"+color1+"-"+color2+"-100");
        text_semana = semana;
        //gradiente
        var ctx1 = canvas1.getContext('2d');
        var grd = ctx1.createLinearGradient(0,0, 50, 150);
        grd.addColorStop(0.3, color1);
        grd.addColorStop(0.5, color2);
        grd.addColorStop(1, color1);

        ctx1.fillStyle = grd;

        grd = ctx1.createLinearGradient(0, 0, 50, 150);
        grd.addColorStop(0.3, "black");
        grd.addColorStop(0.5, "grey");
        grd.addColorStop(1, "black");

        ctx1.strokeStyle = grd;

        //circulo
        ctx1.beginPath();
        ctx1.arc(70, 70, 60, 0, PI_TWO);
        ctx1.lineWidth = 20;
        ctx1.stroke();
        ctx1.fill();
        ctx1.closePath();
        ctx1.lineWidth = 3;

        ctx1.font = '16pt Arial';
        ctx1.fillStyle = 'white';
        ctx1.strokeStyle = 'grey';

        ctx1.strokeText("completo", 25, 100);
        ctx1.fillText("completo", 25, 100);
        //ESTRELLA 1
        grd = ctx1.createLinearGradient(10, 10, 140, 140);
        grd.addColorStop(0.4, "black");
        grd.addColorStop(0.5, "white");
        grd.addColorStop(1, "black");

        ctx1.fillStyle = grd;
        ctx1.strokeStyle = 'grey';
        ctx1.beginPath();
        ctx1.moveTo(90, 43);
        ctx1.lineTo(95, 60);
        ctx1.lineTo(110,60);
        ctx1.lineTo(100,70);
        ctx1.lineTo(105,83);
        ctx1.lineTo(90,75);//centro abajo
        ctx1.lineTo(75,83);
        ctx1.lineTo(80,70);
        ctx1.lineTo(70,60);
        ctx1.lineTo(85,60);
        ctx1.lineTo(90,43);
        ctx1.stroke();
        ctx1.fill();
        ctx1.closePath();
        //ESTRELLA 2
        grd = ctx1.createLinearGradient(10, 10, 80, 80);
        grd.addColorStop(0.4, "black");
        grd.addColorStop(0.5, "white");
        grd.addColorStop(1, "black");

        ctx1.fillStyle = grd;
        ctx1.strokeStyle = 'grey';
        ctx1.beginPath();
        ctx1.moveTo(45, 43);
        ctx1.lineTo(50, 60);
        ctx1.lineTo(65,60);
        ctx1.lineTo(55,70);
        ctx1.lineTo(60,83);
        ctx1.lineTo(45,75);//centro abajo
        ctx1.lineTo(30,83);
        ctx1.lineTo(35,70);
        ctx1.lineTo(25,60);
        ctx1.lineTo(40,60);
        ctx1.lineTo(45,43);
        ctx1.stroke();
        ctx1.fill();
        ctx1.closePath();
        //ESTRELLA 3
        grd = ctx1.createLinearGradient(0, 0, 80, 80);
        grd.addColorStop(0, "black");
        grd.addColorStop(0.5, "white");
        grd.addColorStop(1, "black");

        ctx1.fillStyle = grd;
        ctx1.strokeStyle = 'grey';
        ctx1.beginPath();
        ctx1.moveTo(70,13);
        ctx1.lineTo(75,30);
        ctx1.lineTo(90,30);
        ctx1.lineTo(80,40);
        ctx1.lineTo(85,53);
        ctx1.lineTo(70,45);//centro abajo
        ctx1.lineTo(55,53);
        ctx1.lineTo(60,40);
        ctx1.lineTo(50,30);
        ctx1.lineTo(65,30);
        ctx1.lineTo(70,13);
        ctx1.stroke();
        ctx1.fill();
        ctx1.closePath();
        //FIN MEDALLA COMPLETA ////
    }
}


function makeCanvasCompleto(semana, color1, color2)
{
          var PI_TWO = Math.PI * 2;

          var canvas1 = document.getElementById('canvas_completo');
          //gradiente
          var ctx1 = canvas1.getContext('2d');
          var grd = ctx1.createLinearGradient(0,0, 50, 150);
          grd.addColorStop(0.3, color1);
          grd.addColorStop(0.5, color2);
          grd.addColorStop(1, color1);

          ctx1.fillStyle = grd;

          grd = ctx1.createLinearGradient(0, 0, 50, 150);
          grd.addColorStop(0.3, "black");
          grd.addColorStop(0.5, "grey");
          grd.addColorStop(1, "black");

          ctx1.strokeStyle = grd;

          //circulo
          ctx1.beginPath();
          ctx1.arc(70, 70, 60, 0, PI_TWO);
          ctx1.lineWidth = 20;
          ctx1.stroke();
          ctx1.fill();
          ctx1.closePath();
          ctx1.lineWidth = 3;

          ctx1.font = '16pt Arial';
          ctx1.fillStyle = 'white';
          ctx1.strokeStyle = 'grey';

          ctx1.strokeText("completo", 25, 100);
          ctx1.fillText("completo", 25, 100);
          //ESTRELLA 1
          grd = ctx1.createLinearGradient(10, 10, 140, 140);
          grd.addColorStop(0.4, "black");
          grd.addColorStop(0.5, "white");
          grd.addColorStop(1, "black");

          ctx1.fillStyle = grd;
          ctx1.strokeStyle = 'grey';
          ctx1.beginPath();
          ctx1.moveTo(90, 43);
          ctx1.lineTo(95, 60);
          ctx1.lineTo(110,60);
          ctx1.lineTo(100,70);
          ctx1.lineTo(105,83);
          ctx1.lineTo(90,75);//centro abajo
          ctx1.lineTo(75,83);
          ctx1.lineTo(80,70);
          ctx1.lineTo(70,60);
          ctx1.lineTo(85,60);
          ctx1.lineTo(90,43);
          ctx1.stroke();
          ctx1.fill();
          ctx1.closePath();
          //ESTRELLA 2
          grd = ctx1.createLinearGradient(10, 10, 80, 80);
          grd.addColorStop(0.4, "black");
          grd.addColorStop(0.5, "white");
          grd.addColorStop(1, "black");

          ctx1.fillStyle = grd;
          ctx1.strokeStyle = 'grey';
          ctx1.beginPath();
          ctx1.moveTo(45, 43);
          ctx1.lineTo(50, 60);
          ctx1.lineTo(65,60);
          ctx1.lineTo(55,70);
          ctx1.lineTo(60,83);
          ctx1.lineTo(45,75);//centro abajo
          ctx1.lineTo(30,83);
          ctx1.lineTo(35,70);
          ctx1.lineTo(25,60);
          ctx1.lineTo(40,60);
          ctx1.lineTo(45,43);
          ctx1.stroke();
          ctx1.fill();
          ctx1.closePath();
          //ESTRELLA 3
          grd = ctx1.createLinearGradient(0, 0, 80, 80);
          grd.addColorStop(0, "black");
          grd.addColorStop(0.5, "white");
          grd.addColorStop(1, "black");

          ctx1.fillStyle = grd;
          ctx1.strokeStyle = 'grey';
          ctx1.beginPath();
          ctx1.moveTo(70,13);
          ctx1.lineTo(75,30);
          ctx1.lineTo(90,30);
          ctx1.lineTo(80,40);
          ctx1.lineTo(85,53);
          ctx1.lineTo(70,45);//centro abajo
          ctx1.lineTo(55,53);
          ctx1.lineTo(60,40);
          ctx1.lineTo(50,30);
          ctx1.lineTo(65,30);
          ctx1.lineTo(70,13);
          ctx1.stroke();
          ctx1.fill();
          ctx1.closePath();
          //FIN MEDALLA COMPLETA ////

}
