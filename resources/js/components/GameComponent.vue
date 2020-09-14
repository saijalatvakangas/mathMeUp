<template>
    <v-app>
        <v-container class="grey darken-4 d-flex align-start" fill-height fluid>
            <v-row>
                <v-col cols="12" md="8" class="mx-auto" align="center">
                    <div class="my-4 text-h2 white--text">Math me up</div>
                </v-col>
                <v-col cols="12" md="8" class="mx-auto">
                    <div class="pa-1 red rounded">
                        <v-card class="mx-auto pa-4 py-8" align="center" dark elevation="16">
                            <div v-if="gameOver">
                                <div class="text-h2">Game Over!</div>
                                <div class="mt-4 text-h4"> You reached the level {{ level }}</div>
                            </div>
                            <div v-if="!gameRunning">
                                <v-btn class="my-10 red--text" @click="startNewGame()">Start new game</v-btn>
                            </div>
                            <div v-else>
                                <div class="mb-4 text-h5">Lives:
                                    {{lives}}
                                </div>
                                <div class="text-h2">{{ question }} = ?</div>
                                <v-row class="d-flex flex-column pt-5">
                                    <v-btn
                                        v-for="(option, i) in answerOptions"
                                        :key="i"
                                        :color="color"
                                        class="ma-2 text-h4 font-weight-bold"
                                        dark
                                        large
                                        @click="selectAnswer($event, option.isCorrect)"
                                    >{{ option.number }}
                                    </v-btn>
                                </v-row>
                                <v-row class="mb-3 mt-10 justify-center">
                                    <p>
                                        Level: {{ level }}
                                    </p>
                                </v-row>
                                <v-row class="mb-3 mt-10 justify-center">
                                    <v-progress-circular
                                        :value="gameTime"
                                        color="red"
                                        rotate="-90"
                                        size="60"
                                        width="10"
                                    >
                                        {{ gameTime }}
                                    </v-progress-circular>
                                </v-row>
                            </div>
                        </v-card>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
import AnswerButton from "./AnswerButton";

export default {
    components: {
        AnswerButton
    },
    data () {
        return {
            question: null,
            answerOptions: [],
            interval: {},
            gameTime: 0,
            color: '#385F73',
            level: 1,
            gameRunning: false,
            gameOver: false,
            lives: 3
        }
    },
    beforeDestroy () {
        clearInterval(this.interval)
    },
    methods: {
        startNewGame() {
            this.gameOver = false;
            this.level = 1;
            this.lives = 3;
            this.getQuestion();
            this.setGameTime();
            this.gameRunning = true;
        },
        endGame() {
            this.gameOver = true;
            this.gameRunning = false;
            clearInterval(this.interval)
        },
        setGameTime() {
            this.gameTime = 30;
            this.interval = setInterval(() => {
                if (this.gameTime < 1) {
                    return this.endGame();
                }
                this.gameTime -= 1
            }, 1000)
        },
        selectAnswer(event, isAnswerCorrect) {
            if(isAnswerCorrect) {
                this.color = "green";
                this.level += 1;
            } else {
                this.color = "red";
                this.lives -= 1;
                if (this.lives < 1) {
                    return this.endGame();
                }
            }
            this.getQuestion();
        },
        getQuestion() {
            axios
                .post('/getQuestion', {
                    level: this.level
                })
                .then(response => {
                    this.question = response.data.question;
                    this.answerOptions = response.data.answerOptions;
                    this.color = '#385F73';
                })
        },
    },
};
</script>
