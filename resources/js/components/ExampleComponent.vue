<template>
  <v-app dark>
      <v-card elevation="16" class="mt-16 mx-4 pa-8" dark>
          <v-row class="mb-4 justify-end">
              <v-progress-circular
                  rotate="-90"
                  size="40"
                  width="10"
                  :value="value"
                  color="red"
              ></v-progress-circular>
          </v-row>
          <v-row class="px-4" align="center">
              <div class="text-h2">{{ question }} = ?</div>
          </v-row>
          <v-row class="d-flex flex-column pt-5">
              <!--<AnswerButton color="green" number=7 isCorrect="true" @click="showAnswer($event, true)"></AnswerButton>-->
              <v-btn
                  v-for="(option, i) in answerOptions"
                  :key="i"
                  class="ma-2 text-h5 font-weight-bold"
                  :color="color"
                  dark
                  large
                  @click="showAnswer($event, option.isCorrect)"
              >{{ option.number }}, {{ option.isCorrect }}</v-btn>
          </v-row>
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
            value: 100,
            color: '#385F73',
            level: 1
        }
    },
    beforeDestroy () {
        clearInterval(this.interval)
    },
    mounted () {
        axios
            .post('/getQuestion')
            .then(response => {
                this.question = response.data.question;
                this.answerOptions= response.data.answerOptions;
                console.log(response.data)
            })
        this.interval = setInterval(() => {
            if (this.value === 0) {
                return (this.value = 100)
            }
            this.value -= 2
        }, 1000)
    },
    methods: {
        showAnswer(event, isAnswerCorrect) {
            if(isAnswerCorrect) {
                this.color   = "blue";
                /*console.log(event.target);*/
            } else {
                this.color = "red";
                /*console.log(event);*/
            }
            axios
                .post('/getQuestion', {
                    level: this.level
                })
                .then(response => {
                    this.question = response.data.question;
                    this.answerOptions= response.data.answerOptions;
                })
        }
    }

};
</script>
