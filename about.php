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
        <div id="welkom">
            <?php
            $welkomstext = "";
            for ($i = 0; $i < 50; $i++) {
                $welkomstext .= "--- O E S ";
            }
            echo "<div id=txt> <h2> About O E S </div>";
            ?>
        </div>

        <canvas id=canvas onclick="resize_canvas()" >
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
            }
            //        speciaal hier omdat i anders te vroeg laad
            var canvas = document.getElementById("canvas");
            resize_canvas();
            var positieX = 1;
            var ctx = canvas.getContext("2d");
            var t = text();
            var lines = [];
            window.setInterval(draw, 10);

            function draw() {
                if (Math.floor(Math.random() * 2) === 0 && lines.length < 600) {
                    lines.push(new textLine());
                }
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                lines.forEach(function (tl) {
                    ctx.drawImage(tl.text, tl.posX, tl.animate(), 10, 2000);
                });
            }

            function textLine() {
                this.text = t;
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
                var offscreenCanvas = document.createElement('canvas');
                offscreenCanvas.width = '100';
                offscreenCanvas.height = '2000';
                offscreenCanvas.style.display = 'none';
                document.body.appendChild(offscreenCanvas);
                var octx = offscreenCanvas.getContext('2d');
                octx.font = "bold 50px Arial";
                octx.fillStyle = 'lightgreen';
                octx.textAlign = "left";
                var step = 10;
                for (i = 0; i < aantalLettersInmyFileAsSource; i++) {
                    octx.fillText(myFileAsSource.charAt(i), 0, step);
                    step += 50;
                }
                return offscreenCanvas;
            }
        </script>
    </body>
</html>
