import { RECEIVED_DATA, RECEIVING_DATA_FAILED } from "../actions";

function sundays(
  state = {
    sundays: null,
    loading: true,
    error: false,
    isTodaySunday: false,
    isNextSunday: false,
    isTodayNt: false
  },
  action
) {
  switch (action.type) {
    case RECEIVED_DATA: {
      return {
        ...state,
        isTodayNt: action.data.todayNT,
        isTodaySunday: action.data.todaySunday,
        isNextSunday: action.data.nextSunday,
        sundays: action.data.sundays,
        loading: false
      };
    }
    case RECEIVING_DATA_FAILED: {
      return {
        ...state,
        error: true
      };
    }
    default:
      return state;
  }
}

export default sundays;
