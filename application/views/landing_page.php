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
                <button @click="startGame" class="btn btn-primary">START</button>
            </div>
        </div>

        <!-- CHOOSE A BOARD -->
        <div id="boards" v-if="choseBoard">
            <div class="bg-yellow container">
                <div class="logo">
                    <img src="<?=base_url()?>assets/images/board-name.png" class="board-img">
                </div>
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
                <button @click="stopGame" class="btn btn-secondary">BACK</button>
                <button @click="boardChosen" class="btn btn-primary">NEXT</button>
            </div>
        </div>

        <!-- CHOOSE A CHARACTER -->
        <div id="characters" v-if="choseCharacter">
            <div class="container bg-yellow">
                <div class="logo">
                    <img src="<?=base_url()?>assets/images/board-name.png" class="board-img">
                </div>
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
                <button @click="goBack" class="btn btn-secondary">BACK</button>
                <button @click="playGame" class="btn btn-primary">PLAY</button>
            </div>
        </div>

        <!-- Pop Quiz Correct -->
        <div class="modal fade" id="popQuiz1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pop Quiz</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Philippines is most gender-equal country in Asia.
                        <button onclick="myFunc()">True</button>
                        <button>False</button>
                    </div>
                </div>
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
                            <img :id="diceNum" :src="diceImg" @click="rollDice" style="cursor: pointer">
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
    function myFunc() {
        document.getElementsByClassName("modal-body")[0].innerHTML = '<h3>Correct!</h3><p>The World Economic Forum (WEF)\'s Global Gender Gap Report for 2018 also ranked the Philippines eighth among 149 countries in achieving gender equality. It said the Philippines got its record-high score of 0.799, which means it has closed almost 80 percent of its overall gender gap.</p>';
        vm.moveMyChar(vm.diceNum);
    }

    var vm = new Vue({
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
            popQuiz: false,
            theAnswer: 0,
        },
        methods: {
            startGame() {
                this.gameIsRunning = true;
                this.choseBoard = true;
            },
            showModal() {
                this.popQuiz = true;
                console.log(this.popQuiz);
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
                    this.tutModal = true;
                }
                this.myChibi = "<?=base_url()?>uploads/" + this.theChar + ".png";
                this.myChibiHead = "<?=base_url()?>uploads/" + this.theChar + "_head.png";
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
            rollDice() {
                this.diceNum = Math.floor(Math.random() * 6) + 1;
                this.diceImg = "<?=base_url()?>assets/images/dice_" + this.diceNum + ".png";

                $("#popQuiz1").modal();
                console.log(this.theAnswer);
                console.log(this.diceNum);
            },
            moveMyChar(num) {
                this.currentPosition += num;

                if(this.flag == 0) {
                    document.getElementById("box" + this.currentPosition).innerHTML = '<img src="' + this.myChibiHead + '">';
                    this.tempPos = "box" + this.currentPosition;
                    this.flag = 1;
                } else if (this.flag == 1 && (this.currentPosition != 7 || this.currentPosition != 13 || this.currentPosition != 19)) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box" + this.currentPosition;
                    document.getElementById(this.tempPos).innerHTML = '<img src="' + this.myChibiHead + '">';
                } else if(this.currentPosition == 7 && this.flag == 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box7-1";
                    document.getElementById(this.tempPos).innerHTML = '<img src="'+ this.myChibiHead +'">';
                } else if(this.currentPosition == 13 && this.flag == 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box13-1";
                    document.getElementById("box13-1").innerHTML = '<img src="'+ this.myChibiHead +'">';
                } else if(this.currentPosition == 19 && this.flag == 1) {
                    document.getElementById(this.tempPos).innerHTML = '';
                    this.tempPos = "box19-1";
                    document.getElementById("box19-1").innerHTML = '<img src="'+ this.myChibiHead +'">';
                }
            }
        }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>