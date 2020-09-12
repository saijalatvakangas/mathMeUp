<template>
  <v-app>
      <div class="d-flex">
          <p>{{ question }}</p>
      </div>
      <v-btn v-for="(option, i) in answerOptions" :key="i" class="ma-2" tile color="indigo" dark>{{ option.number }}, {{ option.isCorrect }}</v-btn>
  </v-app>
</template>

<script>
export default {
    data () {
        return {
            question: null,
            answerOptions: []
        }
    },
    mounted () {
        axios
            .post('/getQuestion')
            .then(response => {
                this.question = response.data.question;
                this.answerOptions= response.data.answerOptions;
            })
    }
};
</script>
