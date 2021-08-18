<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" />
    <Calendar date="2021-08-18" :config="config" />
  </div>
</template>

<script>
import Calendar from "@/components/shared/Calendar.vue";

export default {
  name: "Home",
  data() {
    return {
      config: {
        days: ["пн", "вт", "ср", "чт", "пт", "сб", "вс"],
        month: [
          "Январь",
          "Февраль",
          "Март",
          "Апрель",
          "Май",
          "Июнь",
          "Июль",
          "Август",
          "Сентябрь",
          "Октябрь",
          "Ноябрь",
          "Декабрь",
        ],
      },
    };
  },
  components: {
    Calendar,
  },
};
</script>
