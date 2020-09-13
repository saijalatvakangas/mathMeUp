<template>
  <v-btn
      class="ma-2 text-h5 font-weight-bold"
      :color="color"
      dark
      large
  >{{ number }}, {{ isCorrect }}</v-btn>
</template>

<script>
export default {
    props: ['color', 'number', 'isCorrect'],
    data () {
        return {
        }
    },
};
</script>
