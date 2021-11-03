import { RECEIVED_DATA, CHANGE_VISIBLE_SUNDAY } from "../actions";

function view(
  state = {
    selectedSunday: null
  },
  action
) {
  switch (action.type) {
    case RECEIVED_DATA: {
      return {
        ...state,
        selectedSunday: action.data.sundays[0].id
      }
    }
    case CHANGE_VISIBLE_SUNDAY: {
      return {
        ...state,
        selectedSunday: action.id
      }
    }
    default:
      return state;
  }
}

export default view;
