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
                <div class="radioGroupChar row">
                    <?php if (is_array($characters) || is_object($characters)):
                        foreach ($characters as $char):?>
                    <div class="col-sm">
                        <input type="radio" id="<?= $char->women_img?>" @click="myChar($event)" name="leChar">
                        <label for="<?= $char->women_img?>"><img src="<?=base_url()?>uploads/<?= $char->women_img?>.png"><?=$char->women_name?></label>
                    </div>
                    <?php endforeach;
                    endif; ?>
                </div>
                <button @click="goBack">BACK</button>
                <button @click="playGame">PLAY</button>
            </div>
        </div>

        <!-- GAME START -->
        <div id="in-game" v-if="gameIsPlaying">
            <div class="container ">
                <div class="row">
                    <section id="box-tiles" class="col-9 bg-yellow">
                        <div class="logo">
                            <img src="<?=base_url()?>assets/images/board-name.png" class="board-img">
                        </div>
                        <div class="tb-boardgame">
                            <table>
                                <tr>
                                    <td id="box25"></td>
                                    <td id="box24"></td>
                                    <td id="box23"></td>
                                    <td id="box22"></td>
                                    <td id="box21"></td>
                                    <td id="box20"></td>
                                    <td id="box19-2"></td>
                                </tr>
                                <tr>
                                    <td id="box13-2"></td>
                                    <td id="box14"></td>
                                    <td id="box15"></td>
                                    <td id="box16"></td>
                                    <td id="box17"></td>
                                    <td id="box18"></td>
                                    <td id="box19-1"></td>
                                </tr>
                                 <tr>
                                    <td id="box13-1"></td>
                                    <td id="box12"></td>
                                    <td id="box11"></td>
                                    <td id="box10"></td>
                                    <td id="box9"></td>
                                    <td id="box8"></td>
                                    <td id="box7-2"></td>
                                </tr>
                                 <tr>
                                    <td id="box1"></td>
                                    <td id="box2"></td>
                                    <td id="box3"></td>
                                    <td id="box4"></td>
                                    <td id="box5"></td>
                                    <td id="box6"></td>
                                    <td id="box7-1"></td>
                                </tr>
                            </table>
                        </div>
                    </section>
                    <section id="sidenav" class="col-3">
                        <div class="diceContainer">
                            <span>Roll the dice</span>
                            <img :id="diceNum" :src="diceImg" @click="rollDice($event)" style="cursor: pointer">
                        </div>
                        <div class="chibiContainer">
                            <span>Player</span>
                            <img id="theChibi" :src="myChibi">
                            <p></p>
                            <a href="<?=base_url()?>game/logout" class="btn btn-primary">QUIT</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
    new Vue({
        el: '#app',
        data: {
            isActive: false,
            isNoChibi: true,
            theBoard: "",
            theChar: "",
            myChibi: "",
            myChibiHead: "",
            diceNum: 6,
            diceImg: '<?=base_url()?>assets/images/dice_6.png',
            gameIsRunning: false,
            choseBoard: false,
            choseCharacter: false,
            gameIsPlaying: false,
            currentPosition: 0,
            tempPos: "",
            flag: 0,
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
                this.myChibi = "<?=base_url()?>uploads/" + this.theChar + ".png";
                this.myChibiHead = "<?=base_url()?>uploads/" + this.theChar + "_head.png";
                console.log(this.myChibiHead);
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

                this.moveMyChar(this.diceNum);
            },
            moveMyChar(num) {
                this.currentPosition += num;

                if(this.flag < 1) {
                    document.getElementById(this.currentPosition).innerHTML = '<img src="'+ this.myChibiHead +'">';
                    this.tempPos = this.currentPosition;
                } else if(this.currentPosition == 7 && this.flag > 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box7-1";
                    document.getElementById(this.tempPos).innerHTML = '<img src="'+ this.myChibiHead +'">';
                } else if(this.currentPosition == 13 && this.flag > 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box13-1";
                    document.getElementById("box13-1").innerHTML = '<img src="'+ this.myChibiHead +'">';
                } else if(this.currentPosition == 19 && this.flag > 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box19-1";
                    document.getElementById("box19-1").innerHTML = '<img src="'+ this.myChibiHead +'">';
                } else if (this.flag > 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box" + this.currentPosition;
                    document.getElementById(this.tempPos).innerHTML = '<img src="' + this.myChibiHead + '">';
                }

                console.log(this.currentPosition);
            }
        }
    });
    </script>
</body>
</html>