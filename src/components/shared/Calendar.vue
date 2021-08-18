<template>
  <div>
    <div class="wrapper">
      <div class="currentMonth">
        <div @click="decreaseMonth">«</div>
        <div>{{ getCurrentMonthNameAndYear }}</div>
        <div @click="increaseMonth">»</div>
      </div>
      <div class="weekdays">
        <div v-for="(d, i) in config.days" :key="i">{{ d }}</div>
      </div>
      <div class="days">
        <div v-for="(d, i) in totalDays" :key="i">
          <span
            @click="bindDate(d)"
            :class="{
              active:
                localDate.getMonth() === getRealCurrentDate.getMonth() &&
                localDate.getFullYear() === getRealCurrentDate.getFullYear() &&
                d.value === getRealCurrentDate.getDate(),
              prev: d.type === 'prev',
              next: d.type === 'next',
            }"
            >{{ d.value }}</span
          >
        </div>
      </div>
      <div class="selectedDate" v-if="selectedDate">
        <input type="text" v-model="selectedDate" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      localDate: false,
      selectedDate: false,
    };
  },
  computed: {
    getRealCurrentDate() {
      return new Date();
    },
    getCurrentMonthNameAndYear() {
      return `${
        this.config.month[this.localDate.getMonth()]
      } ${this.localDate.getFullYear()}`;
    },
    countOfDaysInCurrentMonth() {
      return new Date(
        this.localDate.getFullYear(),
        this.localDate.getMonth() + 1,
        0
      ).getDate();
    },
    countOfDaysInPrevMonth() {
      return new Date(
        this.localDate.getFullYear(),
        this.localDate.getMonth(),
        0
      ).getDate();
    },
    firstDayIndexCurrentMonth() {
      return new Date(
        this.localDate.getFullYear(),
        this.localDate.getMonth(),
        1
      ).getDay();
    },
    lastDayIndexCurrentMonth() {
      return new Date(
        this.localDate.getFullYear(),
        this.localDate.getMonth() + 1,
        0
      ).getDay();
    },
    daysInPrevMonth() {
      let arr = [];
      for (let index = this.localDate.getDay(); index > 0; index--) {
        arr.push({
          value: this.countOfDaysInPrevMonth - index + 1,
          type: "prev",
        });
      }
      return arr;
    },
    daysInCurrentMonth() {
      let arr = [];
      for (let index = 1; index <= this.countOfDaysInCurrentMonth; index++) {
        arr.push({
          value: index,
          type: "curr",
        });
      }
      return arr;
    },
    daysInNextMonth() {
      const countOfDayForNextMonth = 7 - this.lastDayIndexCurrentMonth;
      let arr = [];
      for (let index = 1; index <= countOfDayForNextMonth; index++) {
        arr.push({
          value: index,
          type: "next",
        });
      }
      return arr;
    },
    totalDays() {
      return [
        ...this.daysInPrevMonth,
        ...this.daysInCurrentMonth,
        ...this.daysInNextMonth,
      ];
    },
  },
  watch: {
    date: {
      immediate: true,
      handler(v) {
        let proxy = new Date(v);
        proxy.setDate(7);
        this.localDate = proxy;
      },
    },
  },
  methods: {
    decreaseMonth() {
      let proxy = this.localDate;
      proxy.setMonth(proxy.getMonth() - 1);
      this.localDate = new Date(proxy.toJSON().slice(0, 10));
    },
    increaseMonth() {
      console.log("asd");
      let proxy = this.localDate;
      proxy.setMonth(proxy.getMonth() + 1);
      this.localDate = new Date(proxy.toJSON().slice(0, 10));
    },
    bindDate(dayModel) {
      const proxy = new Date(
        this.localDate.getFullYear(),
        this.localDate.getMonth(),
        dayModel.value
      );
      this.selectedDate = `${proxy.getFullYear()}-${(
        "0" +
        (proxy.getMonth() + 1)
      ).slice(-2)}-${("0" + proxy.getDate()).slice(-2)}`;
    },
  },
  props: {
    date: {
      type: [String, Date, Object],
      default() {
        return new Date();
      },
    },
    config: {
      type: Object,
      default() {
        return {
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
        };
      },
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  border: 1px solid #ccc;
  padding: 10px;
  width: 500px;
  margin: 0 auto;
  & > div {
    flex: 1;
    display: flex;
  }
  .currentMonth {
    & > div {
      flex: 1;
    }
  }
  .weekdays {
    & > div {
      flex: 1;
    }
  }
  .days {
    flex-wrap: wrap;
    & > div {
      width: calc(500px / 7);
      & span {
        &.active {
          color: #f00;
        }
        &.prev,
        &.next {
          opacity: 0.5;
        }
      }
    }
  }
  .selectedDate {
    justify-content: center;
    padding-top: 10px;
  }
}
</style>