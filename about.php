<html>
    <title>ITPH  ingelogd welkom </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel = "stylesheet" type = "text/css" href="oes.css">  
    <head>

        <style>
            body
            {
                background-color:#d2d2d2;
            }

            #canvas
            {
                background-color:#000;
                display:block;
                margin:auto;
            }

            #logo {
                text-align: center;
                border: 10px solid black;  
                display:none;
            }



            #welkom {
                text-align: center;
                border: 1px solid blue;                
            }
            #etxt {
                text-align: center;
                border: 1px solid black;                
            }

        </style>

    </head>
    <body onresize="resize_canvas()">
        <!--<body>-->
        <div id="welkom">
        <!--<img   src=https://www.caict.nl/uploads/nieuws/logo-itph-academy.jpg   width="100% ">--> 

            <?php
//                $fh = fopen("./testfile",' r');
//                $fh = fopen("./testfile.txt",' r');
//            $helesource = file_get_contents("testfile.txt");
//                echo $helesource;
            $welkomstext ="";
            for ($i = 0; $i < 50; $i++) {
                $welkomstext .= "--- O E S ";
            }

//            $welkomstext .= $_SESSION['naam'];
//            $welkomstext .= " met wachtwoord :  ";
//            $welkomstext .= $_SESSION['ww'];
            echo "<div id=txt> <h2> About O E S </div>";
            ?>
            <!--<div  id=logo width="400px;" src='pl.png'> aklsdjhfalkjqwerlok</div>-->
            <!--<img   src=pl.png height="90%" >--> 

        </div>

        <canvas id=canvas onclick="resize_canvas()" >
        <!--<canvas id=canvas width="600px" height="400px"></canvas>-->
        </canvas>

        <script>

            function resize_canvas() {
                console.log("In de resize");
                canvas = document.getElementById("canvas");
                if (canvas.width < window.innerWidth)
                {
                    canvas.width = window.innerWidth;
                }

                if (canvas.height < window.innerHeight)
                {
                    canvas.height = window.innerHeight;
                }
                console.log(canvas.width);
                console.log(canvas.height);

            }


            //        speciaal hier omdat i anders te vroeg laad
            var canvas = document.getElementById("canvas");
//            console.log("Na canvas declared ");

            resize_canvas();
            var positieX = 1;

            console.log(canvas.height);
            console.log(window.innerHeight);

//                    alert(canvas);
            var ctx = canvas.getContext("2d");
            var t = text();
//            var logo = document.getElementById('logo');
//            logo.value =  "$welkomstext";
            var lines = [];
            window.setInterval(draw, 10);


            function draw() {
                if (Math.floor(Math.random() * 2) === 0 && lines.length < 600) {
                    lines.push(new textLine());
                }
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                //voor elke regel in de lines arry teken i een img 
                //met plaatje ti.text op de x coordinaat ti.posx en dat is een methode in textline
                //tl.animate is een methode die iedere keer een ofset y meegeeft

                lines.forEach(function (tl) {
//                    ctx.drawImage(tl.text, tl.posX, tl.animate(), 10, 5000);
                    ctx.drawImage(tl.text, tl.posX, tl.animate(), 10, 2000);
                });
//                ctx.drawImage(logo, 100, 155, 400, 70);
//                ctx.fillText($welkomstext, 10, 50);
            }


            function textLine() {
                this.text = t;
//                this.posX = positieX;
//                positieX += 10;
//                if (positieX >= canvas.width) {
//                    positieX = 1;
//                }

                this.posX = (function () {
                    return Math.floor(Math.random() * canvas.width);
                })();
                this.offsetY = -1000;
                this.animate = function () {
                    if (this.offsetY >= 0) {
                        this.offsetY = -1000;
                    }
                    this.offsetY += 1;   // anamatie snelheid
                    return this.offsetY;
                };
            }


            function text() {
                var myFileAsSource = "<?php echo htmlspecialchars($welkomstext); ?>";
                var aantalLettersInmyFileAsSource = myFileAsSource.length;
//                alert(myFileAsSource);
                var offscreenCanvas = document.createElement('canvas');
                offscreenCanvas.width = '100';
                offscreenCanvas.height = '2000';
                offscreenCanvas.style.display = 'none';
                document.body.appendChild(offscreenCanvas);
                var octx = offscreenCanvas.getContext('2d');
//                            octx.textAlign='center';
//                octx.shadowColor = "lightgreen";
//                octx.shadowOffsetX = 2;
//                octx.shadowOffsetY = -5;
//                octx.shadowBlur = 1;
                octx.font = "bold 50px Arial";
//                   octx.font = "30px Courier New'";
                octx.fillStyle = 'lightgreen';
//                octx.fillStyle = 'darkgreen';
                octx.textAlign = "left";
//                octx.textAlign = "center";
                var step = 10;
                for (i = 0; i < aantalLettersInmyFileAsSource; i++) {
//                    var charCode = 0;

//                    alert($helesource);
//                    while (charCode < 60) {
//                        charCode = Math.floor(Math.random() * 100);
//                    }

                    octx.fillText(myFileAsSource.charAt(i), 0, step);
//                    console.log(myFileAsSource.charAt(i));

//                    octx.fillText(String.fromCharCode(charCode), 0, step);

                    step += 50;
                }

                return offscreenCanvas;
            }





        </script>




    </body>
</html>
