<template>
  <v-app dark>
      <v-card class="mt-16 mx-4 pa-8" dark elevation="16">
          <div v-if="gameOver">
              <div class="text-h2">Game Over!</div>
          </div>
          <div v-if="!gameRunning">
            <v-btn @click="startNewGame()">Start new game</v-btn>
          </div>
          <div v-else>
              <v-row align="center" class="px-4">
                  <div class="text-h2">{{ question }} = ?</div>
              </v-row>
              <v-row class="d-flex flex-column pt-5">
                  <!--<AnswerButton color="green" number=7 isCorrect="true" @click="showAnswer($event, true)"></AnswerButton>-->
                  <v-btn
                      v-for="(option, i) in answerOptions"
                      :key="i"
                      :color="color"
                      class="ma-2 text-h4 font-weight-bold"
                      dark
                      large
                      @click="selectAnswer($event, option.isCorrect)"
                  >{{ option.number }}</v-btn>
              </v-row>
              <v-row class="mb-3 mt-10 justify-center">
                  <v-progress-circular
                      :value="gameTime"
                      color="red"
                      rotate="-90"
                      size="40"
                      width="10"
                  ></v-progress-circular>
              </v-row>
              <v-row class="mb-3 mt-10 justify-center">
                  <p>
                      {{ gameTime }}
                  </p>
              </v-row>
          </div>
      </v-card>
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
            gameTime: 30,
            color: '#385F73',
            level: 1,
            gameRunning: false,
            gameOver: false
        }
    },
    beforeDestroy () {
        clearInterval(this.interval)
    },
    methods: {
        startNewGame() {
            this.gameOver = false;
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
                if (this.gameTime < 0) {
                    return this.endGame();
                }
                this.gameTime -= 1
            }, 1000)
        },
        selectAnswer(event, isAnswerCorrect) {
            if(isAnswerCorrect) {
                this.color = "green";
                this.getQuestion();
            } else {
                this.color = "red";
                this.gameTime -= 3;
            }
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
                    this.level += 1;
                })
        },
    },
};
</script>
