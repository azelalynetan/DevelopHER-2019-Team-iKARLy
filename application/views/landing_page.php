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
            <div class="container bg-yellow">
                <!-- <h1>title here</h1> -->
                <img class="board-name" src="<?=base_url()?>assets/images/board-name.png">
                <button @click="startGame">START</button>
            </div>
        </div>

        <!-- CHOOSE A BOARD -->
        <div id="boards" v-if="choseBoard">
            <div class="bg-yellow container">
                <h2>Choose a board</h2>
                <div class="board-row row">
                    <div class="board-box col-sm-3 col-md">
                        <img src="<?=base_url()?>assets/images/select.png" id="board1" @click="myBoard($event)" class="board-img" style="cursor: pointer" :class="{activeBox: isActive}">
                        Tech Board
                    </div>
                    <div class="board-box col-sm-3 col-md">
                        <img src="<?=base_url()?>assets/images/select-locked.png" class="board-img">
                        Finish other boards to unlock
                    </div><div class="board-box col-sm-3 col-md">
                        <img src="<?=base_url()?>assets/images/select-locked.png" class="board-img">
                        Finish other boards to unlock
                    </div>
                </div>
                <button @click="boardChosen">NEXT</button>
                <button @click="stopGame">X</button>
            </div>
        </div>

        <!-- CHOOSE A CHARACTER -->
        <div id="characters" v-if="choseCharacter">
            <div class="container bg-yellow">
                <h2>Choose a character</h2>
                <div class="radioGroupChar">
                    <input type="radio" id="char1" @click="myChar($event)" name="leChar">
                    <label for="char1"><img src="" alt="Char"></label>
                    <input type="radio" id="char2" @click="myChar($event)" name="leChar">
                    <label for="char2"><img src="" alt="Char"></label>
                    <input type="radio" id="char3" @click="myChar($event)" name="leChar">
                    <label for="char3"><img src="" alt="Char"></label>
                    <input type="radio" id="char4" @click="myChar($event)" name="leChar">
                    <label for="char4"><img src="" alt="Char"></label>
                    <input type="radio" id="char5" @click="myChar($event)" name="leChar">
                    <label for="char5"><img src="" alt="Char"></label>
                </div>
                <button @click="goBack">BACK</button>
                <button @click="playGame">PLAY</button>
            </div>
        </div>

        <!-- GAME START -->
        <div id="in-game" v-if="gameIsPlaying">
            <div class="container">
                <div class="row">
                    <section id="box-tiles" class="col-10">
                        <div class="row">
                            <div id="box1" class="col-sm"></div>
                            <div id="box2" class="col-sm"></div>
                            <div id="box3" class="col-sm"></div>
                            <div id="box4" class="col-sm"></div>
                            <div id="box5" class="col-sm"></div>
                            <div id="box6" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 1 -->
                        <div class="row">
                            <div id="box7" class="col-sm"></div>
                            <div id="box8" class="col-sm"></div>
                            <div id="box9" class="col-sm"></div>
                            <div id="box10" class="col-sm"></div>
                            <div id="box11" class="col-sm"></div>
                            <div id="box12" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 2 -->
                        <div class="row">
                            <div id="box13" class="col-sm"></div>
                            <div id="box14" class="col-sm"></div>
                            <div id="box15" class="col-sm"></div>
                            <div id="box16" class="col-sm"></div>
                            <div id="box17" class="col-sm"></div>
                            <div id="box18" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 3 -->
                        <div class="row">
                            <div id="box19" class="col-sm"></div>
                            <div id="box20" class="col-sm"></div>
                            <div id="box21" class="col-sm"></div>
                            <div id="box22" class="col-sm"></div>
                            <div id="box23" class="col-sm"></div>
                            <div id="box24" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 4 -->
                    </section>
                    <section id="sidenav" class="col-2">
                        <img :id="diceNum" :src="diceImg" @click="rollDice($event)" style="cursor: pointer">
                        <img src="" alt="chibi">
                        <button @click="stopGame">QUIT</button>
                    </section>
                </div>
            </div>
        </div>

        <!-- DUPLICATE of GAME START -->
        <div id="in-game" v-if="gameIsPlaying">
            <div class="container">
                <div class="row">
                    <section id="box-tiles" class="col-10">
                        <div class="row">
                            <div id="box1" class="col-sm"></div>
                            <div id="box2" class="col-sm"></div>
                            <div id="box3" class="col-sm"></div>
                            <div id="box4" class="col-sm"></div>
                            <div id="box5" class="col-sm"></div>
                            <div id="box6" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 1 -->
                        <div class="row">
                            <div id="box7" class="col-sm"></div>
                            <div id="box8" class="col-sm"></div>
                            <div id="box9" class="col-sm"></div>
                            <div id="box10" class="col-sm"></div>
                            <div id="box11" class="col-sm"></div>
                            <div id="box12" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 2 -->
                        <div class="row">
                            <div id="box13" class="col-sm"></div>
                            <div id="box14" class="col-sm"></div>
                            <div id="box15" class="col-sm"></div>
                            <div id="box16" class="col-sm"></div>
                            <div id="box17" class="col-sm"></div>
                            <div id="box18" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 3 -->
                        <div class="row">
                            <div id="box19" class="col-sm"></div>
                            <div id="box20" class="col-sm"></div>
                            <div id="box21" class="col-sm"></div>
                            <div id="box22" class="col-sm"></div>
                            <div id="box23" class="col-sm"></div>
                            <div id="box24" class="col-sm"></div>
                        </div>
                        <!-- END OF ROW 4 -->
                    </section>
                    <section id="sidenav" class="col-2">
                        <img :id="diceNum" :src="diceImg" @click="rollDice($event)" style="cursor: pointer">
                        <img src="" alt="chibi">
                        <button @click="stopGame">QUIT</button>
                    </section>
                </div>
            </div>
        </div>
        <!-- end -->
    </div>

    <script>
    new Vue({
        el: '#app',
        data: {
            isActive: false,
            theBoard: "",
            theChar: "",
            diceNum: 6,
            diceImg: '<?=base_url()?>assets/images/dice_6.png',
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
                this.theBoard = "";
                this.isActive = false;
                this.currentPosition = 0;
            },
            boardChosen() {
                if(this.theBoard) {
                    this.choseBoard = false;
                    this.choseCharacter = true;
                }
            },
            goBack() {
                this.choseBoard = true;
                this.choseCharacter = false;
            },
            playGame() {
                if(this.theChar) {
                    this.choseCharacter = false;
                    this.gameIsPlaying = true;
                }
                console.log(this.theChar);
            },
            myBoard(event) {
                if(this.theBoard) {
                    this.theBoard = "";
                } else {
                    this.theBoard = event.currentTarget.id;
                }
                this.isActive = !this.isActive;
            },
            myChar(event) {
                this.theChar = event.currentTarget.id;
            },
            rollDice(event) {
                this.diceNum = Math.floor(Math.random() * 6) + 1;
                this.diceImg = "<?=base_url()?>assets/images/dice_" + this.diceNum + ".png";
            }
        }
    });
    </script>
</body>
</html>