<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Team iKARLy</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
    <div id="app">
        <!-- LANDING PAGE -->
        <div id="landing" class="container" v-if="!gameIsRunning">
            <h1>title here</h1>
            <button @click="startGame">START</button>
        </div>

        <!-- CHOOSE A BOARD -->
        <div id="boards" v-if="choseBoard">
            <div class="container">
                <h2>Choose a board</h2>
                <div class="board-row row">
                    <div class="board-box col-sm-3 col-md"></div>
                    <div class="board-box col-sm-3 col-md"></div>
                </div>
                <button @click="boardChosen">NEXT</button>
                <button @click="stopGame">X</button>
            </div>
        </div>

        <!-- CHOOSE A CHARACTER -->
        <div id="characters" v-if="choseCharacter">
            <div class="container">
                <h2>Choose a character</h2>
                <div class="char-row row">
                    <div class="char-box col-sm-2 col-md"></div>
                    <div class="char-box col-sm-2 col-md"></div>
                    <div class="char-box col-sm-2 col-md"></div>
                    <div class="char-box col-sm-2 col-md"></div>
                    <div class="char-box col-sm-2 col-md"></div>
                </div>
                <button @click="goBack">BACK</button>
                <button @click="playGame">PLAY</button>
            </div>
        </div>

        <!-- GAME START -->
        <div id="in-game" v-if="gameIsPlaying">
            <div class="container">
                <section id="box-tiles">
                    <div class="row">
                        <div id="box1" class="col-sm-2"></div>
                        <div id="box2" class="col-sm-2"></div>
                        <div id="box3" class="col-sm-2"></div>
                        <div id="box4" class="col-sm-2"></div>
                        <div id="box5" class="col-sm-2"></div>
                        <div id="box6" class="col-sm-2"></div>
                    </div>
                    <!-- END OF ROW 1 -->
                    <div class="row">
                        <div id="box7" class="col-sm-2"></div>
                        <div id="box8" class="col-sm-2"></div>
                        <div id="box9" class="col-sm-2"></div>
                        <div id="box10" class="col-sm-2"></div>
                        <div id="box11" class="col-sm-2"></div>
                        <div id="box12" class="col-sm-2"></div>
                    </div>
                    <!-- END OF ROW 2 -->
                    <div class="row">
                        <div id="box13" class="col-sm-2"></div>
                        <div id="box14" class="col-sm-2"></div>
                        <div id="box15" class="col-sm-2"></div>
                        <div id="box16" class="col-sm-2"></div>
                        <div id="box17" class="col-sm-2"></div>
                        <div id="box18" class="col-sm-2"></div>
                    </div>
                    <!-- END OF ROW 3 -->
                    <div class="row">
                        <div id="box19" class="col-sm-2"></div>
                        <div id="box20" class="col-sm-2"></div>
                        <div id="box21" class="col-sm-2"></div>
                        <div id="box22" class="col-sm-2"></div>
                        <div id="box23" class="col-sm-2"></div>
                        <div id="box24" class="col-sm-2"></div>
                    </div>
                    <!-- END OF ROW 4 -->
                </section>
                <button @click="stopGame">QUIT</button>
            </div>
        </div>
    </div>

    <script>
    new Vue({
        el: '#app',
        data: {
            gameIsRunning: false,
            choseBoard: false,
            choseCharacter: false,
            gameIsPlaying: false,
            currentPosition: 0,
        },
        methods: {
            startGame() {
                this.gameIsRunning = true;
                this.choseBoard = true;
            },
            stopGame() {
                this.gameIsRunning = false;
                this.choseBoard = false;
                this.choseCharacter = false;
                this.gameIsPlaying = false;
            },
            boardChosen() {
                this.choseBoard = false;
                this.choseCharacter = true;
            },
            goBack() {
                this.choseBoard = true;
                this.choseCharacter = false;
            },
            playGame() {
                this.choseCharacter = false;
                this.gameIsPlaying = true;
            }
        }
    });
    </script>
</body>
</html>